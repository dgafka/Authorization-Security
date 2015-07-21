<?php

namespace Dgafka\Security\Domain\Expression;


/**
 * Class ExpressionReader
 *
 * @package Dgafka\Security\Domain\Expression
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

}