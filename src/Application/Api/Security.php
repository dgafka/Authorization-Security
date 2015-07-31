<?php

namespace Dgafka\AuthorizationSecurity\Application\Api;

use Dgafka\AuthorizationSecurity\Application\Helper\DIContainer;
use Dgafka\AuthorizationSecurity\Application\Helper\UserFactory;
use Dgafka\AuthorizationSecurity\Application\Helper\ResourceFactory;
use Dgafka\AuthorizationSecurity\Domain\Expression\EmptyExpression;
use Dgafka\AuthorizationSecurity\Domain\Expression\Expression;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityType;

/**
 * Class AnnotationSecurity - describes API for security
 *
 * @package Dgafka\AuthorizationSecurity\Domain\Application\Api
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class Security
{

	/** @var DIContainer */
	private $container;

	/**
	 * @param DIContainer $container
	 */
	public function __construct(DIContainer $container)
	{
		$this->container = $container;
	}

	/**
	 * Runs security to check, if user is authorized correctly
	 *
	 * @param SecurityCommand $securityCommand
	 *
	 */
	public function authorize(SecurityCommand $securityCommand)
	{
		/** @var UserFactory $userFactory */
		$userFactory = $this->container->getUserFactory($securityCommand->userFactory());
		$user = $userFactory->create();

		/** @var ResourceFactory $resourceFactory */
		if (!is_null($securityCommand->resourceFactory())) {
			$resourceFactory = $this->container->getResourceFactory($securityCommand->resourceFactory());
			$resource = $resourceFactory->create();
		}

		/** @var SecurityType $securityType */
		$securityType = $this->container->getSecurityType($securityCommand->securityType());

		$policiesList = array();
		foreach ($securityCommand->policies() as $policy) {
			$policiesList[] = $this->container->getSecurityPolicy($policy);
		}

		$expression = $securityCommand->expression() ? new Expression($securityCommand->expression()) : new EmptyExpression();
		$securityType->execute($expression, $user, (isset($resource) ? $resource : null), $policiesList);

	}

}