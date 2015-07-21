<?php

namespace Dgafka\Security\Domain\Resource;

/**
 * Class Resource - Basic resource class.
 *
 * @package Dgafka\Security\Domain\Resource
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class Resource implements BaseResource
{

	/** @var  string */
	public $id;

	/** @var  string */
	public $type;

	public function __construct($id, $type)
	{
		$this->id   = $id;
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function type()
	{
		return $this->type;
	}

}