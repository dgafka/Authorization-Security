<?php

namespace Dgafka\Fixtures\Application;


class DIContainer extends \Dgafka\AuthorizationSecurity\Infrastructure\DIContainer
{

	public static function getInstance()
	{
		return new self();
	}

}