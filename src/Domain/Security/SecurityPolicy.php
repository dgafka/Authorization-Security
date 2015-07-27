<?php

namespace Dgafka\Security\Domain\Security;

use Dgafka\Security\Domain\Resource\Resource;
use Dgafka\Security\Domain\User\User;

/**
 * Interface Policy - Class that describes extra combinations, that need to evaluated true to authorize user
 *
 * @package Dgafka\Security\Domain\Security
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface SecurityPolicy
{

	/**
	 * Executes policy, which should return true if user is authorized in context of policy,
	 * otherwise false
	 *
	 * @param User              $user
	 * @param \Dgafka\Security\Domain\Resource\Resource|null     $resource
	 *
	 * @return bool
	 */
	public function execute(User $user, Resource $resource = null);

}