<?php

namespace Dgafka\Security\Domain\User\Lattice;

use Dgafka\Security\Domain\User\User;

/**
 * Class LatticeUser - Identity based access control user
 *
 * @package Dgafka\Security\Domain\User
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
final class LatticeUser extends User
{

	/** @var  Permission */
	public $permission;

	/**
	 * @param string     $id
	 * @param Permission $permission
	 */
	public function __construct($id, Permission $permission)
	{
		parent::__construct($id);
		$this->permission = $permission;
	}

	/**
	 * @return Permission
	 */
	public function permission()
	{
		return $this->permission;
	}

}