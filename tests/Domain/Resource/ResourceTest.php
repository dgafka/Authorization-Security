<?php

/**
 * Class ResourceTest
 *
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class ResourceTest extends PHPUnit_Framework_TestCase
{

	/** @var  \Dgafka\Security\Domain\Resource\Resource */
	private $resource;

	public function setUp()
	{
		$this->resource = new \Dgafka\Security\Domain\Resource\Resource('identity', 'comment');
	}

	public function testTypeOfBaseResource()
	{
		$this->assertInstanceOf('Dgafka\Security\Domain\Resource\BaseResource', $this->resource);
	}

	public function testParametersItWasCreatedWith()
	{
		$this->assertEquals('identity', $this->resource->id());
		$this->assertEquals('comment', $this->resource->type());
	}

}