<?php

namespace Dgafka\Security\Infrastructure;

use Dgafka\Security\Domain\Expression\Expression;
use Dgafka\Security\Domain\Expression\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * Class ExpressionReader
 *
 * @package Dgafka\Security\Infrastructure
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class ExpressionReader implements \Dgafka\Security\Domain\Expression\ExpressionReader
{

	/** @var  ExpressionLanguage */
	private $expressionReader;

	public function __construct(ExpressionLanguage $expressionLanguage)
	{
		$this->expressionReader = $expressionLanguage;
	}

	/**
	 * Check, if given expression evaluates true or false
	 *
	 * @param Expression $expression
	 * @param array      $data
	 *
	 * @return bool
	 */
	public function evaluate(Expression $expression, array $data = array())
	{
		return $this->expressionReader->evaluate($expression->expression(), $data);
	}

	/**
	 * Registers new function to expression language
	 *
	 * @param ExpressionFunction $expressionFunction
	 *
	 * @return void
	 */
	public function registerFunction(ExpressionFunction $expressionFunction)
	{
		$functionToCall = $expressionFunction->expressionFunction();

		$this->expressionReader->register($expressionFunction->name(), null, function() use($functionToCall) {
			$arguments = func_get_args();
			array_shift($arguments);

			return $functionToCall($arguments);
		});
	}

}