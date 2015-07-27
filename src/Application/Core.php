<?php

namespace Dgafka\Security\Application;

use Dgafka\Security\Application\Helper\DIContainer;
use Dgafka\Security\Domain\Expression\ExpressionFunction;
use Dgafka\Security\Domain\Expression\ExpressionReader;
use SebastianBergmann\GlobalState\RuntimeException;

/**
 * Class Core - The core of application
 *
 * @package Dgafka\Security\Application
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
final class Core
{

	/** @var  CoreConfig */
	private $config;

	/** @var array  */
	private $expressionFunctions = array();

	/** @var array  */
	private $securityTypes = array();

	/** @var array  */
	private $securityPolicies = array();

	/** @var array  */
	private $userFactories = array();

	/** @var array  */
	private $resourceFactories = array();

	/**
	 * @param CoreConfig $coreConfig
	 */
	public function __construct(CoreConfig $coreConfig)
	{
		$this->config = $coreConfig;
	}

	/**
	 * @return CoreConfig
	 */
	public function config()
	{
		return $this->config;
	}

	/**
	 * Registers new function in expression language
	 *
	 * @param ExpressionFunction $expressionFunction
	 */
	public function registerExpressionFunction(ExpressionFunction $expressionFunction)
	{
		$this->expressionFunctions[] = $expressionFunction;
	}

	/**
	 * Registers new security type
	 *
	 * @param string   $name
	 * @param callable $securityTypeClosure
	 */
	public function registerSecurityType($name, \Closure $securityTypeClosure)
	{
		$this->securityTypes[] = array('name' => $name, 'closure' => $securityTypeClosure);
	}

	/**
	 * Registers security policy
	 *
	 * @param string   $name
	 * @param callable $securityPolicyClosure
	 */
	public function registerSecurityPolicy($name, \Closure $securityPolicyClosure)
	{
		$this->securityPolicies[] = array('name' => $name, 'closure' => $securityPolicyClosure);
	}

	/**
	 * Registers new user factory
	 *
	 * @param string   $name
	 * @param callable $userFactoryClosure
	 */
	public function registerUserFactory($name, \Closure $userFactoryClosure)
	{
		$this->userFactories[] = array('name' => $name, 'closure' => $userFactoryClosure);
	}

	/**
	 * Registers new resource factory
	 *
	 * @param string   $name
	 * @param callable $resourceFactoryClosure
	 */
	public function registerResourceFactory($name, \Closure $resourceFactoryClosure)
	{
		$this->resourceFactories[] = array('name' => $name, 'closure' => $resourceFactoryClosure);
	}

	/**
	 * Initialize application, should not be called directly.
	 *
	 * @param DIContainer      $container
	 * @param ExpressionReader $expressionReader
	 * @param \Closure         $standardSecurity
	 *
	 * @internal
	 */
	public function initialize(DIContainer $container, ExpressionReader $expressionReader, \Closure $standardSecurity)
	{

		if(!isset($this->config)) {
			throw new RuntimeException("CoreConfig must be passed to Core, in order to finish initialization.");
		}

		$container->register('expressionReader', $expressionReader);
		$container->registerSecurityType('standard', $standardSecurity);

		foreach($this->expressionFunctions as $expressionFunction) {
			$expressionReader->registerFunction($expressionFunction);
		}

		foreach($this->securityTypes as $type) {
			$container->registerSecurityType($type['name'], $type['closure']);
		}

		foreach($this->securityPolicies as $policy) {
			$container->registerSecurityPolicy($policy['name'], $policy['closure']);
		}

		foreach($this->userFactories as $userFactory) {
			$container->registerUserFactory($userFactory['name'], $userFactory['closure']);
		}

		foreach($this->resourceFactories as $resourceFactory) {
			$container->registerResourceFactory($resourceFactory['name'], $resourceFactory['closure']);
		}

	}

}
