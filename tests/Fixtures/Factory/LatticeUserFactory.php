<?php

namespace Dgafka\Fixtures\Factory;


use Dgafka\AuthorizationSecurity\Application\Helper\UserFactory;
use Dgafka\AuthorizationSecurity\Domain\User\Lattice\LatticeUser;
use Dgafka\AuthorizationSecurity\Domain\User\Lattice\Permission;
use Dgafka\AuthorizationSecurity\Domain\User\User;

/**
 * Class LatticeUserFactory
 *
 * @package Dgafka\Fixtures\Factory
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class LatticeUserFactory implements UserFactory
{

	private $id;
	private $level;

	public function __construct($id, $level)
	{
		$this->id    = $id;
		$this->level = $level;
	}

	/**
	 * Creates new user object
	 *
	 * @return User
	 */
	public function create()
	{
		return new LatticeUser($this->id, new Permission($this->level));
	}

}