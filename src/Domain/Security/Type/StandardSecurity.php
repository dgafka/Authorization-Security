<?php

namespace Dgafka\AuthorizationSecurity\Domain\Security\Type;

use Dgafka\AuthorizationSecurity\Domain\Expression\Expression;
use Dgafka\AuthorizationSecurity\Domain\Resource\Resource;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityAccessDenied;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityPolicy;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityType;
use Dgafka\AuthorizationSecurity\Domain\User\User;

/**
 * Class RoleBasedSecurity - Role Based Security control - Check, if user contains given role
 *
 * @package Dgafka\AuthorizationSecurity\Domain\Security\Type
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class StandardSecurity extends SecurityType
{

	/**
	 * @inheritdoc
	 */
	public function execute(Expression $expression, User $user, Resource $resource = null, array $policies = array())
	{
		if(!$this->expressionReader->evaluate($expression, ['user' => $user, 'resource' => $resource])) {
			throw new SecurityAccessDenied("User: {$user->id()} have no access to this resource.");
		};

		/** @var SecurityPolicy $securityPolicy */
		foreach($policies as $securityPolicy) {
			if(!$securityPolicy->execute($user, $resource)) {
				throw new SecurityAccessDenied("User: {$user->id()} have no access to this resource.");
			};
		}
	}

}