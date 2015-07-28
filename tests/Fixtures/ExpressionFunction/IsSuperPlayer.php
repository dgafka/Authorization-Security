<?php

namespace Dgafka\Fixtures\ExpressionFunction;


use Dgafka\AuthorizationSecurity\Domain\Expression\ExpressionFunction;

class IsSuperPlayer implements ExpressionFunction
{

	/**
	 * Returns function name, which will be used to initialize function in expression language
	 *
	 * @return string
	 */
	public function name()
	{
		return 'isSuperPlayer';
	}

	/**
	 * Returns Expression function implementation as closure
	 *
	 * @return \Closure
	 */
	public function expressionFunction()
	{
		return function($arguments) {
			$user = $arguments[0];
			return $user->id === 3;
		};
	}


}