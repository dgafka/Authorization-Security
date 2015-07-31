<?php

namespace Dgafka\AuthorizationSecurity\UI\Annotation\Aspect;

use Dgafka\AuthorizationSecurity\Application\Api\Security;
use Dgafka\AuthorizationSecurity\Application\Api\SecurityCommand;
use Dgafka\AuthorizationSecurity\Application\Helper\ResourceFactory;
use Dgafka\AuthorizationSecurity\Application\Helper\UserFactory;
use Dgafka\AuthorizationSecurity\Infrastructure\DIContainer;
use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationResourceFactory;
use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationSecurity;
use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationExpression;
use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationPolicy;
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
        $type        = null;
        $userFactory = null;
        $expression  = null;
        $resourceFactory = null;
        $policies    = array();

        foreach($rflMethod->getAnnotations() as $annotation) {

            switch($annotation) {

                case ($annotation instanceof AuthorizationSecurity):
                    $type = $annotation->securityTypeName();
                    $userFactory = $annotation->userFactoryName();
                    break;
                case ($annotation instanceof AuthorizationExpression):
                    $expression = $annotation->expression();
                    break;
                case ($annotation instanceof AuthorizationResourceFactory):
                    $resourceFactory = $annotation->resourceFactoryName();
                    break;
                case ($annotation instanceof AuthorizationPolicy):
                    $policies[] = $annotation->policyName();
                    break;
            }

        }

        /** @var Security $securityAPI */
        $securityAPI = DIContainer::getInstance()->get('security');

        if(!is_null($resourceFactory)) {
            /** @var ResourceFactory $userFactory */
            $resourceFactoryForArguments = DIContainer::getInstance()->getResourceFactory($resourceFactory);
            $resourceFactoryForArguments->setParameters($invocation->getArguments());
        }

        $securityCommand = new SecurityCommand($type, $expression, $userFactory, $resourceFactory, $policies);
        $securityAPI->authorize($securityCommand);
        $invocation->proceed();
    }

}