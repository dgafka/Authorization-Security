<?php

namespace Dgafka\AuthorizationSecurity\Domain\Security;

use Dgafka\AuthorizationSecurity\Domain\Expression\Expression;
use Dgafka\AuthorizationSecurity\Domain\Expression\ExpressionReader;
use Dgafka\AuthorizationSecurity\Domain\Resource\Resource;
use Dgafka\AuthorizationSecurity\Domain\User\User;

/**
 * Class Security - Base security type of all access controls.
 * It should throw exception of SecurityAccessDenied type, if user is not authorized correctly
 *
 * @package Dgafka\AuthorizationSecurity\Domain\Security
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
abstract class SecurityType
{

	/** @var  ExpressionReader */
	protected $expressionReader;

	/**
	 * Executes security check, which should evaluate, if user is authorized
	 * if not it should throw SecurityAccessDenied Exception
	 *
	 * @param Expression                $expression
	 * @param User                      $user
	 * @param \Dgafka\AuthorizationSecurity\Domain\Resource\Resource|null         $resource
	 * @param array|SecurityPolicy[]    $policies
	 *
	 * @return void
	 * @throws SecurityAccessDenied
	 */
	public abstract function execute(Expression $expression, User $user, Resource $resource = null, array $policies = array());

	final public function setExpressionReader(ExpressionReader $expressionReader) {
		$this->expressionReader = $expressionReader;
	}

}