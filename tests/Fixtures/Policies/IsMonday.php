<?php

namespace Dgafka\Fixtures\Policies;


use Dgafka\Security\Domain\Resource\BaseResource;
use Dgafka\Security\Domain\Security\SecurityPolicy;
use Dgafka\Security\Domain\User\User;

/**
 * Class IsMonday
 *
 * @package Dgafka\Fixtures\Policies
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class IsMonday implements SecurityPolicy
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
		return true;
	}

}