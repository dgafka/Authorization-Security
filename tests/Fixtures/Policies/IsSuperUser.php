<?php

namespace Dgafka\Fixtures\Policies;

use Dgafka\AuthorizationSecurity\Domain\Resource\Resource;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityPolicy;
use Dgafka\AuthorizationSecurity\Domain\User\User;

/**
 * Class IsSuperUser
 *
 * @package Dgafka\Fixtures\Policies
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class IsSuperUser implements SecurityPolicy
{

	/**
	 * @inheritdoc
	 */
	public function execute(User $user, Resource $resource = null)
	{
		return $user->id() == 1;
	}

}