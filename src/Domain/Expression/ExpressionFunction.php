<?php

namespace Dgafka\AuthorizationSecurity\Domain\Expression;

/**
 * Interface ExpressionFunction - Own function added to expression language
 *
 * @package Dgafka\AuthorizationSecurity\Domain\Expression
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface ExpressionFunction
{

	/**
	 * Returns function name, which will be used to initialize function in expression language
	 *
	 * @return string
	 */
	public function name();

	/**
	 * Returns Expression function implementation as closure
	 *
	 * @return \Closure
	 */
	public function expressionFunction();

}