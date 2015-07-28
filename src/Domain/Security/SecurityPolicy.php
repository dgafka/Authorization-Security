<?php

namespace Dgafka\AuthorizationSecurity\Domain\Security;

use Dgafka\AuthorizationSecurity\Domain\Resource\Resource;
use Dgafka\AuthorizationSecurity\Domain\User\User;

/**
 * Interface Policy - Class that describes extra combinations, that need to evaluated true to authorize user
 *
 * @package Dgafka\AuthorizationSecurity\Domain\Security
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface SecurityPolicy
{

	/**
	 * Executes policy, which should return true if user is authorized in context of policy,
	 * otherwise false
	 *
	 * @param User              $user
	 * @param \Dgafka\AuthorizationSecurity\Domain\Resource\Resource|null     $resource
	 *
	 * @return bool
	 */
	public function execute(User $user, Resource $resource = null);

}