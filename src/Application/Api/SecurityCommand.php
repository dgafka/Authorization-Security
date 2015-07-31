<?php

namespace Dgafka\AuthorizationSecurity\Application\Api;

/**
 * Class SecurityCommand
 *
 * @package Dgafka\AuthorizationSecurity\Application\Api
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class SecurityCommand
{

	/** @var  string */
	private $securityType;

	/** @var  string */
	private $expression;

	/** @var  string */
	private $userFactory;

	/** @var  string */
	private $resourceFactory;

	/** @var  array */
	private $policies;

	/**
	 * @param string $securityType
	 * @param string|null $expression
	 * @param string $userFactory
	 * @param string|null   $resourceFactory
	 * @param array  $policies
	 */
	public function __construct($securityType, $expression, $userFactory, $resourceFactory = null, array $policies = array())
	{
		$this->securityType = $securityType;
		$this->expression   = $expression;
		$this->userFactory  = $userFactory;
		$this->resourceFactory = $resourceFactory;
		$this->policies     = $policies;
	}

	/**
	 * @return string
	 */
	public function securityType()
	{
		return $this->securityType;
	}

	/**
	 * @return null|string
	 */
	public function expression()
	{
		return $this->expression;
	}

	/**
	 * @return string
	 */
	public function userFactory()
	{
		return $this->userFactory;
	}

	/**
	 * @return null|string
	 */
	public function resourceFactory()
	{
		return $this->resourceFactory;
	}

	/**
	 * @return array
	 */
	public function policies()
	{
		return $this->policies;
	}

}