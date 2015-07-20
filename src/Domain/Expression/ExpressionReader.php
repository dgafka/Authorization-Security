<?php

namespace Dgafka\AnnotationSecurity\Domain\Expression;


/**
 * Class ExpressionReader
 *
 * @package Dgafka\AnnotationSecurity\Domain\Expression
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
abstract class ExpressionReader
{

	/**
	 * Check, if given expression evaluates true or false
	 *
	 * @param Expression $expression
	 * @param array      $data
	 *
	 * @return bool
	 */
	public abstract function evaluate(Expression $expression, array $data = array());

}