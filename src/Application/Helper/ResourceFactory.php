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

	/** @var  array Arguments passed from outside function to help with building new resource */
	protected $arguments;

	/** @var  mixed parameters passed by annotation */
	protected $additionalParameters;

	/**
	 * Creates new Resource object
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
	final public function setArguments(array $arguments = array())
	{
		$this->arguments = $arguments;
	}

	/**
	 * @param mixed $additionalParameters
	 * @internal
	 */
	final public function setAdditionalParameters($additionalParameters)
	{
		$this->additionalParameters = $additionalParameters;
	}

}