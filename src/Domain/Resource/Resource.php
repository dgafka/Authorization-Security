<?php

namespace Dgafka\AnnotationSecurity\Domain\Resource;

/**
 * Class Resource - Class
 *
 * @package Dgafka\AnnotationSecurity\Domain\Resource
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
final class Resource
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