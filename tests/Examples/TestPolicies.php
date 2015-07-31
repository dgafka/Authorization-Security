<?php

namespace Dgafka\Examples;

use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationSecurity;
use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationPolicy;

/**
 * Class TestPolicies
 *
 * @package Dgafka\Examples
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class TestPolicies
{

	/**
	 * @AuthorizationSecurity(type="standard", userFactory="roleUserFactory")
 	 * @AuthorizationPolicy("isLocalHost")
	 */
	public function test()
	{
		echo "Shouldn't be called!";
	}

	/**
	 * @AuthorizationSecurity(type="standard", userFactory="roleUserFactory")
	 * @AuthorizationPolicy("isMonday")
	 */
	public function test2()
	{
		echo "Youhuuhu!";
	}

}