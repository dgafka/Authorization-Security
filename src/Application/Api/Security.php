<?php

namespace Dgafka\Security\Application\Api;

use Dgafka\Security\Application\Helper\DIContainer;
use Dgafka\Security\Application\Helper\UserFactory;
use Dgafka\Security\Application\Helper\ResourceFactory;
use Dgafka\Security\Domain\Expression\EmptyExpression;
use Dgafka\Security\Domain\Expression\Expression;
use Dgafka\Security\Domain\Expression\ExpressionFunction;
use Dgafka\Security\Domain\Expression\ExpressionReader;
use Dgafka\Security\Domain\Security\SecurityType;

/**
 * Class AnnotationSecurity - describes API for security
 *
 * @package Dgafka\Security\Domain\Application\Api
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