<?php

namespace Dgafka\AnnotationSecurity\Domain\User\Role;

/**
 * Class Roles - Describes user roles
 *
 * @package Dgafka\AnnotationSecurity\Domain\User\Role
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
final class Roles
{

	/** @var array|Role[]  */
	private $roles;

	public function __construct(array $roles = array())
	{
		$this->roles = $roles;
	}

	/**
	 * Check Roles contains passed role names
	 *
	 * @param array $roleNames - array of role names as strings
	 *
	 * @return bool
	 */
	public function containsRole(array $roleNames)
	{
		foreach($roleNames as $name) {
			foreach($this->roles as $role) {
				if($role->name() === $name) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Check if contain passed role name
	 *
	 * @param string $roleName
	 *
	 * @return bool
	 */
	public function hasRole($roleName)
	{
		foreach($this->roles as $role) {
			if($role->name() === $roleName) {
				return true;
			}
		}

		return false;
	}

}