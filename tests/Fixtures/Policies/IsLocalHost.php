<?php

namespace Dgafka\Fixtures\Policies;

use Dgafka\Security\Domain\Resource\BaseResource;
use Dgafka\Security\Domain\Security\SecurityPolicy;
use Dgafka\Security\Domain\User\User;

/**
 * Class IsLocalHost
 *
 * @package Dgafka\Fixtures\Policies
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class IsLocalHost implements SecurityPolicy
{

	/**
	 * Executes policy, which should return true if user is authorized in context of policy,
	 * otherwise false
	 *
	 * @param User              $user
	 * @param BaseResource|null $resource
	 *
	 * @return bool
	 */
	public function execute(User $user, BaseResource $resource = null)
	{
		return false;
	}

}