<?php

namespace Dgafka\AuthorizationSecurity\Application\Helper;

use Dgafka\AuthorizationSecurity\Domain\User\User;

/**
 * Interface UserFactory - Responsible for creating new user objects
 *
 * @package Dgafka\AuthorizationSecurity\Domain\Application\Helper
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface UserFactory
{

	/**
	 * Creates new user object
	 *
	 * @return User
	 */
	public function create();

}