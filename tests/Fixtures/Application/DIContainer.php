<?php

namespace Dgafka\Fixtures\Application;


class DIContainer extends \Dgafka\Security\Infrastructure\DIContainer
{

	public static function getInstance()
	{
		return new self();
	}

}