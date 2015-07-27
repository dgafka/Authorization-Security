<?php

namespace Dgafka\Fixtures\ExpressionFunction;


use Dgafka\Security\Domain\Expression\ExpressionFunction;

class IsEqualTo implements ExpressionFunction
{

	/**
	 * Returns function name, which will be used to initialize function in expression language
	 *
	 * @return string
	 */
	public function name()
	{
		return 'isEqualTo10';
	}

	/**
	 * Returns Expression function implementation as closure
	 *
	 * @return \Closure
	 */
	public function expressionFunction()
	{
		return function($arguments) {

			return ($arguments[0] * $arguments[1]) === 10;

		};
	}

}