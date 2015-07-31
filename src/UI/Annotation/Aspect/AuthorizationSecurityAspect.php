<?php

namespace Dgafka\AuthorizationSecurity\UI\Annotation\Aspect;

use Dgafka\AuthorizationSecurity\Application\Api\Security;
use Dgafka\AuthorizationSecurity\Infrastructure\DIContainer;
use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationSecurity;
use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationExpression;
use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Around;
use Go\Lang\Annotation\Pointcut;

/**
 * Class AuthorizationSecurity - Main authorization security. Marks method for authorization checking.
 *
 * @package Dgafka\AuthorizationSecurity\UI\Annotation
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class AuthorizationSecurityAspect implements Aspect
{

	/**
     * @Pointcut("@annotation(Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationSecurity)")
     */
	protected function authorizePointcut() {}

	/**
	 * This method will check, if user is authorized
	 *
	 * @param MethodInvocation $invocation
	 * @Around("$this->authorizePointcut")
	 */
	public function authorize(MethodInvocation $invocation)
	{
        $rflMethod = $invocation->getMethod();
        $security  = new \stdClass();
        $security->type        = null;
        $security->userFactory = null;
        $security->expression  = null;
        $security->resourceFactory = null;
        $security->policies    = array();

        foreach($rflMethod->getAnnotations() as $annotation) {

            switch($annotation) {

                case ($annotation instanceof AuthorizationSecurity):
                    $security->type = $annotation->securityTypeName();
                    $security->userFactory = $annotation->userFactoryName();
                    break;
                case ($annotation instanceof AuthorizationExpression):
                    $security->expression = $annotation->expression();
                    break;
            }

        }

        /** @var Security $securityAPI */
        $securityAPI = DIContainer::getInstance()->get('security');

        $securityAPI->authorize($security->type, $security->expression, $security->userFactory, $security->resourceFactory, $security->policies);

    }

}