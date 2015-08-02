<?php

namespace Dgafka\Examples;

use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationSecurity;
use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationResourceFactory;

/**
 * Class TestSecurityType
 *
 * @package Dgafka\Examples
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class TestSecurityType
{

	/**
	 * @AuthorizationSecurity(type="ibac", userFactory="identityUserFactory")
	 * @AuthorizationResourceFactory("resourceFactory", parameters={"test"})
	 *
	 */
	public function test($command)
	{
		echo 'Command for test2 has been called';
	}

}