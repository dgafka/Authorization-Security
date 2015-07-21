<?php

namespace Dgafka\Security\Application\Helper;

use Dgafka\Security\Domain\Security\SecurityPolicy;
use Dgafka\Security\Domain\Security\SecurityType;
use \Closure;

/**
 * Interface DIContainer - Application internal DI container
 *
 * @package Dgafka\Security\Domain\Application\Helper
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface DIContainer
{

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