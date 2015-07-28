<?php

namespace Dgafka\Fixtures\Policies;

use Dgafka\AuthorizationSecurity\Domain\Resource\BaseResource;
use Dgafka\AuthorizationSecurity\Domain\Resource\Resource;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityPolicy;
use Dgafka\AuthorizationSecurity\Domain\User\User;

/**
 * Class IsLocalHost
 *
 * @package Dgafka\Fixtures\Policies
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class IsLocalHost implements SecurityPolicy
{

	/**
	 * @inheritdoc
	 */
	public function execute(User $user, Resource $resource = null)
	{
		return false;
	}

}