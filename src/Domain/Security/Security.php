<?php

namespace Dgafka\AnnotationSecurity\Domain\Security;

use Dgafka\AnnotationSecurity\Domain\Expression\Expression;
use Dgafka\AnnotationSecurity\Domain\Resource\BaseResource;
use Dgafka\AnnotationSecurity\Domain\User\User;

/**
 * Class Security - Base security type of all access controls.
 * It should throw exception of SecurityAccessDenied type, if user is not authorized correctly
 *
 * @package Dgafka\AnnotationSecurity\Domain\Security
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface Security
{

	/**
	 * Executes security check, which should evaluate, if user is authorized
	 * otherwise it should throw SecurityAccessDenied Exception
	 *
	 * @param Expression                $expression
	 * @param User                      $user
	 * @param BaseResource|null         $resource
	 * @param array|SecurityPolicy[]    $policies
	 *
	 * @return bool
	 * @throws SecurityAccessDenied
	 */
	public function execute(Expression $expression, User $user, BaseResource $resource = null, array $policies = array());

}