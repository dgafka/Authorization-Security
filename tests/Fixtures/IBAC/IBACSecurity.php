<?php

namespace Dgafka\Fixtures\IBAC;

use Dgafka\AuthorizationSecurity\Domain\Expression\Expression;
use Dgafka\AuthorizationSecurity\Domain\Resource\Resource;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityAccessDenied;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityPolicy;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityType;
use Dgafka\AuthorizationSecurity\Domain\User\User;

/**
 * Class IBACSecurity
 *
 * @package Dgafka\Fixtures
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class IBACSecurity extends SecurityType
{

	/** @var  SimpleACL */
	private $simpleACL;

	/**
	 * @param SimpleACL $simpleACL
	 */
	public function __construct(SimpleACL $simpleACL)
	{
		$this->simpleACL = $simpleACL;
	}

	/**
	 * Executes security check, which should evaluate, if user is authorized
	 * if not it should throw SecurityAccessDenied Exception
	 *
	 * @param Expression             $expression
	 * @param User                   $user
	 * @param \Dgafka\AuthorizationSecurity\Domain\Resource\Resource|null      $resource
	 * @param array|SecurityPolicy[] $policies
	 *
	 * @return void
	 * @throws SecurityAccessDenied
	 */
	public function execute(Expression $expression, User $user, Resource $resource = null, array $policies = array())
	{
		$authorizedByExpression = $this->expressionReader->evaluate($expression, ['user' => $user, 'resource' => $resource]);
		$authorizedByACL        = $this->simpleACL->userHasPermission($user, $resource);

		if(!$authorizedByACL || !$authorizedByExpression) {
			throw new SecurityAccessDenied();
		}

	}

}