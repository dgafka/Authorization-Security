<?php

namespace Dgafka\Fixtures\Policies;


use Dgafka\Security\Domain\Resource\BaseResource;
use Dgafka\Security\Domain\Resource\Resource;
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
	 * @inheritdoc
	 */
	public function execute(User $user, Resource $resource = null)
	{
		return true;
	}

}