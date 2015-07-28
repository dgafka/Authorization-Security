<?php

namespace Dgafka\Fixtures\ExpressionFunction;


use Dgafka\AuthorizationSecurity\Domain\Expression\ExpressionFunction;

class IsStringLower implements ExpressionFunction
{

	/**
	 * Returns function name, which will be used to initialize function in expression language
	 *
	 * @return string
	 */
	public function name()
	{
		return 'isStringLower';
	}

	/**
	 * Returns Expression function implementation as closure
	 *
	 * @return \Closure
	 */
	public function expressionFunction()
	{
		return function($arguments) {

			$string = $arguments[0];
			return ctype_lower($string);
		};
	}

}