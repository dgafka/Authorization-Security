<?php

/**
 * Class ResourceTest
 *
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class ResourceTest extends PHPUnit_Framework_TestCase
{

	/** @var  \Dgafka\AuthorizationSecurity\Domain\Resource\Resource */
	private $resource;

	public function setUp()
	{
		$this->resource = new \Dgafka\AuthorizationSecurity\Domain\Resource\StandardResource('identity', 'comment');
	}

	public function testTypeOfBaseResource()
	{
		$this->assertInstanceOf('Dgafka\AuthorizationSecurity\Domain\Resource\Resource', $this->resource);
	}

	public function testParametersItWasCreatedWith()
	{
		$this->assertEquals('identity', $this->resource->id());
		$this->assertEquals('comment', $this->resource->type());
	}

}