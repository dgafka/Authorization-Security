<?php

namespace Dgafka\Security\Domain\Expression;

/**
 * Class EmptyExpression - Empty expression, that always evaluate true
 *
 * @package Dgafka\Security\Domain\Expression
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class EmptyExpression extends Expression
{

	public function __construct()
	{}

	/**
	 * @return string
	 */
	public function expression()
	{
		return 'true';
	}

}