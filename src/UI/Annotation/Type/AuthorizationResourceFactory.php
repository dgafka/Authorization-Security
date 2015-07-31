<?php

namespace Dgafka\AuthorizationSecurity\UI\Annotation\Type;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class AuthorizationResourceFactory
 *
 * @package Dgafka\AuthorizationSecurity\UI\Annotation\Type
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @Annotation
 * @Target({"METHOD"})
 */
class AuthorizationResourceFactory
{

	/** @var  string */
	private $resourceFactoryName;

	/**
	 * @param array $values
	 */
	public function __construct(array $values)
	{
		if(!isset($values['value'])) {
			throw new \RuntimeException("Pass expression to AuthorizationExpression annotation. Example usage: @AuthorizationResourceFactory(\"resourceFactory\") ");
		}

		$this->resourceFactoryName = trim($values['value']);
	}

	/**
	 * @return string
	 */
	public function resourceFactoryName()
	{
		return $this->resourceFactoryName;
	}

}