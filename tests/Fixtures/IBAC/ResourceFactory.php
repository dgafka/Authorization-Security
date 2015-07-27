<?php

namespace Dgafka\Fixtures\IBAC;


use Dgafka\Security\Domain\Resource\StandardResource;

class ResourceFactory extends \Dgafka\Security\Application\Helper\ResourceFactory
{

	private $id;

	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * Create new BaseResource object
	 *
	 * @return \Dgafka\Security\Domain\Resource\Resource
	 */
	public function create()
	{
		return new StandardResource($this->id, 'resource');
	}

}