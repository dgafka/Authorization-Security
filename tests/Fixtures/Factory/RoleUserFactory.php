<?php

namespace Dgafka\Fixtures\Factory;


use Dgafka\AuthorizationSecurity\Application\Helper\UserFactory;
use Dgafka\AuthorizationSecurity\Domain\User\Role\Role;
use Dgafka\AuthorizationSecurity\Domain\User\Role\Roles;
use Dgafka\AuthorizationSecurity\Domain\User\Role\RoleUser;
use Dgafka\AuthorizationSecurity\Domain\User\User;

/**
 * Class StandardUserFactory - test class
 *
 * @package Dgafka\Fixtures
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class RoleUserFactory implements UserFactory
{

	/** @var  string */
	private $id;

	/** @var  array */
	private $roleNames;

	/**
	 * @param $id
	 * @param $roleNames
	 */
	public function __construct($id, $roleNames)
	{
		$this->id           = $id;
		$this->roleNames    = $roleNames;
	}

	/**
	 * Creates new user object
	 *
	 * @return User
	 */
	public function create()
	{
		$userRoles = [];
		foreach($this->roleNames as $roleName) {
			$userRoles[] = new Role($roleName);
		}

		return new RoleUser($this->id, new Roles($userRoles));
	}

}