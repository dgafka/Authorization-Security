<?php

namespace Dgafka\AuthorizationSecurity\Domain\Expression;


/**
 * Class ExpressionReader
 *
 * @package Dgafka\AuthorizationSecurity\Domain\Expression
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface ExpressionReader
{

	/**
	 * Check, if given expression evaluates true or false
	 *
	 * @param Expression $expression
	 * @param array      $data
	 *
	 * @return bool
	 */
	public function evaluate(Expression $expression, array $data = array());

	/**
	 * Registers new function to expression language
	 *
	 * @param ExpressionFunction $expressionFunction
	 *
	 * @return void
	 */
	public function registerFunction(ExpressionFunction $expressionFunction);

}