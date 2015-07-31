<?php

namespace Dgafka\AuthorizationSecurity\Application\Helper;

use Dgafka\AuthorizationSecurity\Domain\Security\SecurityPolicy;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityType;
use \Closure;

/**
 * Interface DIContainer - Application internal DI container
 *
 * @package Dgafka\AuthorizationSecurity\Domain\Application\Helper
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface DIContainer
{

	/**
	 * @param $name
	 *
	 * @return object
	 * @throws DependencyException
	 */
	public function get($name);

	/**
	 * @param $name
	 *
	 * @return SecurityType
	 * @throws DependencyException
	 */
	public function getSecurityType($name);

	/**
	 * @param $name
	 *
	 * @return SecurityPolicy
	 * @throws DependencyException
	 */
	public function getSecurityPolicy($name);

	/**
	 * @param $name
	 *
	 * @return UserFactory
	 * @throws DependencyException
	 */
	public function getUserFactory($name);

	/**
	 * @param $name
	 *
	 * @return ResourceFactory
	 * @throws DependencyException
	 */
	public function getResourceFactory($name);

	/**
	 * @param string $name
	 * @param mixed  $object
	 *
	 * @return void
	 */
	public function register($name, $object);

	/**
	 * Registers new security concern
	 *
	 * @param string  $name
	 * @param Closure $security
	 *
	 * @return void
	 * @throws DependencyException
	 */
	public function registerSecurityType($name, Closure $security);

	/**
	 * Registers new policy
	 *
	 * @param string  $name
	 * @param Closure $securityPolicy
	 *
	 * @return void
	 * @throws DependencyException
	 */
	public function registerSecurityPolicy($name, Closure $securityPolicy);

	/**
	 * Register new user creator object
	 *
	 * @param string  $name
	 * @param Closure $userFactory
	 *
	 * @return void
	 * @throws DependencyException
	 */
	public function registerUserFactory($name, Closure $userFactory);

	/**
	 * Registers new resource creator object
	 *
	 * @param string  $name
	 * @param Closure $resourceFactory
	 *
	 * @return void
	 * @throws DependencyException
	 */
	public function registerResourceFactory($name, Closure $resourceFactory);

}