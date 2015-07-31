<?php

namespace Dgafka\Fixtures\IBAC;


use Dgafka\AuthorizationSecurity\Application\Helper\ResourceFactory;
use Dgafka\AuthorizationSecurity\Domain\Resource\StandardResource;

/**
 * Class ExampleResourceFactory
 *
 * @package Dgafka\Fixtures\IBAC
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class ExampleResourceFactory extends ResourceFactory
{

	/**
	 * Create new BaseResource object
	 *
	 * @return \Dgafka\AuthorizationSecurity\Domain\Resource\Resource
	 */
	public function create()
	{
		return new StandardResource($this->arguments[0]->resourceId, 'StandardResource');
	}

}