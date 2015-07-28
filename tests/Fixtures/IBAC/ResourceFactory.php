<?php

namespace Dgafka\Fixtures\IBAC;


use Dgafka\AuthorizationSecurity\Domain\Resource\StandardResource;

class ResourceFactory extends \Dgafka\AuthorizationSecurity\Application\Helper\ResourceFactory
{

	private $id;

	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * Create new BaseResource object
	 *
	 * @return \Dgafka\AuthorizationSecurity\Domain\Resource\Resource
	 */
	public function create()
	{
		return new StandardResource($this->id, 'resource');
	}

}