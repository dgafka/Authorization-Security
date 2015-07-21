<?php

namespace Dgafka\Security\Application\Helper;

use Dgafka\Security\Domain\User\User;

/**
 * Interface UserFactory - Responsible for creating new user objects
 *
 * @package Dgafka\Security\Domain\Application\Helper
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