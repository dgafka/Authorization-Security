<?php

namespace Dgafka\Fixtures\IBAC;

use Dgafka\Security\Application\Helper\UserFactory;
use Dgafka\Security\Domain\User\Identity\IdentityUser;
use Dgafka\Security\Domain\User\User;

class IdentityUserFactory implements UserFactory
{

	/** @var  string */
	private $id;

	/**
	 * @param string $id
	 */
	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * Creates new user object
	 *
	 * @return User
	 */
	public function create()
	{
		return new IdentityUser($this->id);
	}

}