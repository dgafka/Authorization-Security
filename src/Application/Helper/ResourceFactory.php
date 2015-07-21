<?php

namespace Dgafka\Security\Application\Helper;

use Dgafka\Security\Domain\Resource\BaseResource;

/**
 * Interface ResourceFactory - Responsible for creating Resources
 *
 * @package Dgafka\Security\Domain\Application\Helper
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface ResourceFactory
{

	/**
	 * Create new BaseResource object
	 *
	 * @return BaseResource
	 */
	public function create();

}