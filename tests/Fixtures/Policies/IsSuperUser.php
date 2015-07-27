<?php

namespace Dgafka\Fixtures\Policies;

use Dgafka\Security\Domain\Resource\Resource;
use Dgafka\Security\Domain\Security\SecurityPolicy;
use Dgafka\Security\Domain\User\User;

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