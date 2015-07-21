<?php

namespace Dgafka\Security\Infrastructure;

use Dgafka\Security\Domain\Expression\Expression;
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

	public function __construct()
	{
		$this->expressionReader = new ExpressionLanguage();
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


}