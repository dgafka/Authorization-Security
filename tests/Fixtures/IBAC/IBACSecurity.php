<?php

namespace Dgafka\Fixtures\IBAC;

use Dgafka\Security\Domain\Expression\Expression;
use Dgafka\Security\Domain\Resource\Resource;
use Dgafka\Security\Domain\Security\SecurityAccessDenied;
use Dgafka\Security\Domain\Security\SecurityPolicy;
use Dgafka\Security\Domain\Security\SecurityType;
use Dgafka\Security\Domain\User\User;

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
	 * @param \Dgafka\Security\Domain\Resource\Resource|null      $resource
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