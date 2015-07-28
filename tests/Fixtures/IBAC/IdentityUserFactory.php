<?php

namespace Dgafka\Fixtures\IBAC;

use Dgafka\AuthorizationSecurity\Application\Helper\UserFactory;
use Dgafka\AuthorizationSecurity\Domain\User\Identity\IdentityUser;
use Dgafka\AuthorizationSecurity\Domain\User\User;

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