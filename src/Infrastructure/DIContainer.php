<?php

namespace Dgafka\Security\Infrastructure;

use Closure;
use Dgafka\Security\Application\Helper\DependencyException;
use Dgafka\Security\Application\Helper\ResourceFactory;
use Dgafka\Security\Application\Helper\UserFactory;
use Dgafka\Security\Domain\Security\SecurityPolicy;
use Dgafka\Security\Domain\Security\SecurityType;
use Pimple\Container;

/**
 * Class DIContainer
 *
 * @package Dgafka\Security\Infrastructure
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class DIContainer implements \Dgafka\Security\Application\Helper\DIContainer
{

	/** @var  Container */
	private $container;

	/** @var  self */
	private static $instance;

	/** @var array  */
	private $diKeys =
		array(
			'security'   => 'security_type_',
			'policy'     => 'security_policy_',
			'user'       => 'user_factory_',
			'resource'   => 'resource_factory_'
		);

	protected function __construct()
	{
		$this->container = new Container();
	}

	/**
	 * @return self
	 */
	public static function getInstance()
	{
		if(!isset(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @param string $name
	 *
	 * @return object
	 * @throws DependencyException
	 */
	public function get($name)
	{
		if(!$this->container->offsetExists($name)) {
			throw new DependencyException("Can't retrieve object with given {$name} key, because it doesn't exists");
		}

		return $this->container[$name];
	}

	/**
	 * @param $name
	 *
	 * @return SecurityType
	 * @throws DependencyException
	 */
	public function getSecurityType($name)
	{
		$key = $this->diKeys['security'] . $name;

		if(!$this->container->offsetExists($key)) {
			throw new DependencyException("Can't retrieve security type {$name}, because it doesn't exists");
		}

		/** @var SecurityType $securityType */
		$securityType = $this->container[$key];
		$securityType->setExpressionReader($this->get('expressionReader'));

		return $securityType;
	}

	/**
	 * @param $name
	 *
	 * @return SecurityPolicy
	 * @throws DependencyException
	 */
	public function getSecurityPolicy($name)
	{
		$key = $this->diKeys['policy'] . $name;

		if(!$this->container->offsetExists($key)) {
			throw new DependencyException("Can't retrieve security policy {$name}, because it doesn't exists");
		}

		return $this->container[$key];
	}

	/**
	 * @param $name
	 *
	 * @return UserFactory
	 * @throws DependencyException
	 */
	public function getUserFactory($name)
	{
		$key = $this->diKeys['user'] . $name;

		if(!$this->container->offsetExists($key)) {
			throw new DependencyException("Can't retrieve user factory {$name}, because it doesn't exists");
		}

		return $this->container[$key];
	}

	/**
	 * @param $name
	 *
	 * @return ResourceFactory
	 * @throws DependencyException
	 */
	public function getResourceFactory($name)
	{
		$key = $this->diKeys['resource'] . $name;

		if(!$this->container->offsetExists($key)) {
			throw new DependencyException("Can't retrieve resource factory {$name}, because it doesn't exists");
		}

		return $this->container[$key];
	}

	/**
	 * @param string $name
	 * @param object $object
	 *
	 * @throws DependencyException
	 */
	public function register($name, $object)
	{
		if($this->container->offsetExists($name)) {
			throw new DependencyException("Can't set object under {$name} key, because it's already taken");
		}

		$this->container[$name] = $object;
	}

	/**
	 * Registers new security concern
	 *
	 * @param string  $name
	 * @param Closure $security
	 *
	 * @return void
	 * @throws DependencyException
	 */
	public function registerSecurityType($name, Closure $security)
	{
		$key = $this->diKeys['security'] . $name;

		if($this->container->offsetExists($key)) {
			throw new DependencyException("Can't register security type with {$name}, because it's already exists");
		}

		$this->container[$key] = $security;
	}

	/**
	 * Registers new policy
	 *
	 * @param string  $name
	 * @param Closure $securityPolicy
	 *
	 * @return void
	 * @throws DependencyException
	 */
	public function registerSecurityPolicy($name, Closure $securityPolicy)
	{
		$key = $this->diKeys['policy'] . $name;

		if($this->container->offsetExists($key)) {
			throw new DependencyException("Can't register security policy with {$name}, because it's already exists");
		}

		$this->container[$key] = $securityPolicy;
	}

	/**
	 * Register new user creator object
	 *
	 * @param string  $name
	 * @param Closure $userFactory
	 *
	 * @return void
	 * @throws DependencyException
	 */
	public function registerUserFactory($name, Closure $userFactory)
	{
		$key = $this->diKeys['user'] . $name;

		if($this->container->offsetExists($key)) {
			throw new DependencyException("Can't register user factory with {$name}, because it's already exists");
		}

		$this->container[$key] = $userFactory;
	}

	/**
	 * Registers new resource creator object
	 *
	 * @param string  $name
	 * @param Closure $resourceFactory
	 *
	 * @return void
	 * @throws DependencyException
	 */
	public function registerResourceFactory($name, Closure $resourceFactory)
	{
		$key = $this->diKeys['resource'] . $name;

		if($this->container->offsetExists($key)) {
			throw new DependencyException("Can't register resource factory with {$name}, because it's already exists");
		}

		$this->container[$key] = $resourceFactory;
	}


}