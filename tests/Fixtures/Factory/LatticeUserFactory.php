<?php

namespace Dgafka\Fixtures\Factory;


use Dgafka\Security\Application\Helper\UserFactory;
use Dgafka\Security\Domain\User\Lattice\LatticeUser;
use Dgafka\Security\Domain\User\Lattice\Permission;
use Dgafka\Security\Domain\User\User;

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