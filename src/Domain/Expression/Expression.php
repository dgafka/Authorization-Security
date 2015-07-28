<?php

namespace Dgafka\AuthorizationSecurity\Domain\Expression;

/**
 * Class Expression
 *
 * @package Dgafka\AuthorizationSecurity\Domain\Expression
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class Expression
{

	/** @var string  */
	private $expression;

	/**
	 * @param string $expression
	 */
	public function __construct($expression)
	{
		$this->expression = $expression;
	}

	/**
	 * @return string
	 */
	public function expression()
	{
		return $this->expression;
	}

}