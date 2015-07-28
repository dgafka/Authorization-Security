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
	 * @param string $securityType
	 * @param string $expression
	 * @param string $userFactory
	 * @param null   $resourceFactory
	 * @param array  $policies
	 */
	public function authorize($securityType, $expression, $userFactory, $resourceFactory = null, array $policies = array())
	{
		/** @var UserFactory $userFactory */
		$userFactory = $this->container->getUserFactory($userFactory);
		$user = $userFactory->create();

		/** @var ResourceFactory $resourceFactory */
		if (!is_null($resourceFactory)) {
			$resourceFactory = $this->container->getResourceFactory($resourceFactory);
			$resource = $resourceFactory->create();
		}

		/** @var SecurityType $securityType */
		$securityType = $this->container->getSecurityType($securityType);

		$policiesList = array();
		foreach ($policies as $policy) {
			$policiesList[] = $this->container->getSecurityPolicy($policy);
		}

		$expression = $expression ? new Expression($expression) : new EmptyExpression();
		$securityType->execute($expression, $user, (isset($resource) ? $resource : null), $policiesList);

	}

}