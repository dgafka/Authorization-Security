<?php

namespace Dgafka\Fixtures\IBAC;

use Dgafka\AuthorizationSecurity\Domain\Resource\StandardResource;
use Dgafka\AuthorizationSecurity\Domain\User\Identity\IdentityUser;

class SimpleACL
{

	private $permissions;

	public function __construct(array $permissions)
	{
		$this->permissions = $permissions;
	}

	/**
	 * Check, if user has access to resource
	 *
	 * @param IdentityUser     $user
	 * @param StandardResource $resource
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function userHasPermission(IdentityUser $user, StandardResource $resource)
	{

		if(!array_key_exists($user->id(), $this->permissions)) {
			throw new \Exception("Can't find user");
		}

		return in_array($resource->id(), $this->permissions[$user->id()]);
	}

}