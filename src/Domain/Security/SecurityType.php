<?php

namespace Dgafka\Security\Domain\Security;

use Dgafka\Security\Domain\Expression\Expression;
use Dgafka\Security\Domain\Expression\ExpressionReader;
use Dgafka\Security\Domain\Resource\Resource;
use Dgafka\Security\Domain\User\User;

/**
 * Class Security - Base security type of all access controls.
 * It should throw exception of SecurityAccessDenied type, if user is not authorized correctly
 *
 * @package Dgafka\Security\Domain\Security
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
	 * @param \Dgafka\Security\Domain\Resource\Resource|null         $resource
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