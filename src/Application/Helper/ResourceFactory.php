<?php

namespace Dgafka\AuthorizationSecurity\Application\Helper;

use Dgafka\AuthorizationSecurity\Domain\Resource\Resource;

/**
 * Interface ResourceFactory - Responsible for creating Resources
 *
 * @package Dgafka\AuthorizationSecurity\Domain\Application\Helper
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
abstract class ResourceFactory
{

	/** @var  array Arguments passed from outside to help with building new resource */
	private $arguments;

	/**
	 * Create new BaseResource object
	 *
	 * @return \Dgafka\AuthorizationSecurity\Domain\Resource\Resource
	 */
	public abstract function create();

	/**
	 * setParameters is called automatically and should'nt be called directly.
	 * It sets parameters, which can be used to build new resource
	 *
	 * @param array $arguments
	 * @internal
	 */
	final public function setParameters(array $arguments = array())
	{
		$this->arguments = $arguments;
	}

}