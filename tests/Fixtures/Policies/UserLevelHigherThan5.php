<?php

namespace Dgafka\Fixtures\Policies;

use Dgafka\Security\Domain\Resource\BaseResource;
use Dgafka\Security\Domain\Security\SecurityPolicy;
use Dgafka\Security\Domain\User\Lattice\LatticeUser;
use Dgafka\Security\Domain\User\User;

/**
 * Class UserLevelHigherThan5
 *
 * @package Dgafka\Fixtures\Policies
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class UserLevelHigherThan5 implements SecurityPolicy
{

	/**
	 * Executes policy, which should return true if user is authorized in context of policy,
	 * otherwise false
	 *
	 * @param User              $user
	 * @param BaseResource|null $resource
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function execute(User $user, BaseResource $resource = null)
	{
		if(!($user instanceof LatticeUser)) {
			throw new \Exception("User should be of lattice type");
		}

		return $user->permission()->level() > 5;
	}

}