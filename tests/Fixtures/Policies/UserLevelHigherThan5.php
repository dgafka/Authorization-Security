<?php

namespace Dgafka\Fixtures\Policies;

use Dgafka\AuthorizationSecurity\Domain\Resource\Resource;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityPolicy;
use Dgafka\AuthorizationSecurity\Domain\User\Lattice\LatticeUser;
use Dgafka\AuthorizationSecurity\Domain\User\User;

/**
 * Class UserLevelHigherThan5
 *
 * @package Dgafka\Fixtures\Policies
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class UserLevelHigherThan5 implements SecurityPolicy
{

	/**
	 * @inheritdoc
	 */
	public function execute(User $user, Resource $resource = null)
	{
		if(!($user instanceof LatticeUser)) {
			throw new \Exception("User should be of lattice type");
		}

		return $user->permission()->level() > 5;
	}

}