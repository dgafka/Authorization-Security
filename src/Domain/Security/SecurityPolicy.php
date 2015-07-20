<?php

namespace Dgafka\AnnotationSecurity\Domain\Security;

use Dgafka\AnnotationSecurity\Domain\Resource\BaseResource;
use Dgafka\AnnotationSecurity\Domain\User\User;

/**
 * Interface Policy - Class that describes extra combinations, that need to evaluated true to authorize user
 *
 * @package Dgafka\AnnotationSecurity\Domain\Security
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface SecurityPolicy
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
	public function execute(User $user, BaseResource $resource = null);

}