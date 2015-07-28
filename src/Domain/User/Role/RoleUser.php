<?php

namespace Dgafka\AuthorizationSecurity\Domain\User\Role;
use Dgafka\AuthorizationSecurity\Domain\User\User;

/**
 * Class RoleUser - Role Based Access Control User
 *
 * @package Dgafka\AuthorizationSecurity\Domain\User\Role
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
final class RoleUser extends User
{

	/** @var Roles  */
	private $roles;

	/**
	 * @param string $id
	 * @param Roles $roles
	 */
	public function __construct($id, Roles $roles)
	{
		parent::__construct($id);
		$this->roles = $roles;
	}

	/**
	 * @param $roleName
	 *
	 * @return bool
	 */
	public function hasRole($roleName)
	{
		return $this->roles->hasRole($roleName);
	}

	/**
	 * @param array $roleNames
	 *
	 * @return bool
	 */
	public function containsRole(array $roleNames = array())
	{
		return $this->roles->containsRole($roleNames);
	}

}