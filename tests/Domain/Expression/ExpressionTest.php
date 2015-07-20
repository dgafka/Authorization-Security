<?php

/**
 * Class ExpressionTest
 *
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class ExpressionTest extends PHPUnit_Framework_TestCase
{

	/** @var  \Dgafka\AnnotationSecurity\Domain\Expression\Expression */
	private $expression;

	public function setUp()
	{
		$this->expression = new \Dgafka\AnnotationSecurity\Domain\Expression\Expression('true or false');
	}

	public function testReturnedExpression()
	{
		$this->assertEquals('true or false', $this->expression->expression());
	}

}