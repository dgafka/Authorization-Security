<?php

namespace Dgafka\AuthorizationSecurity\UI\Annotation\Type;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class AuthorizationPolicy - Adds policy security to your method
 *
 * @package Dgafka\AuthorizationSecurity\UI\Annotation\Type
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @Annotation
 * @Target({"METHOD"})
 */
class AuthorizationPolicy
{

	/** @var  string */
	private $policyName;

	/**
	 * @param array $values
	 */
	public function __construct(array $values)
	{
		if(!isset($values['value'])) {
			throw new \RuntimeException("You need to pass name of policy for AuthorizationPolicy annotation. Example usage: @AuthorizationPolicy(\"isLocalHost\") ");
		}

		$this->policyName = $values['value'];
	}

	/**
	 * @return string
	 */
	public function policyName()
	{
		return $this->policyName;
	}

}