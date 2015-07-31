<?php

namespace spec\Dgafka\AuthorizationSecurity\Application\Api;

use Dgafka\AuthorizationSecurity\Application\Api\Security;
use Dgafka\AuthorizationSecurity\Application\Api\SecurityCommand;
use Dgafka\AuthorizationSecurity\Application\Helper\DIContainer;
use Dgafka\AuthorizationSecurity\Application\Helper\ResourceFactory;
use Dgafka\AuthorizationSecurity\Application\Helper\UserFactory;
use Dgafka\AuthorizationSecurity\Domain\Expression\ExpressionFunction;
use Dgafka\AuthorizationSecurity\Domain\Expression\ExpressionReader;
use Dgafka\AuthorizationSecurity\Domain\Resource\BaseResource;
use Dgafka\AuthorizationSecurity\Domain\Resource\Resource;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityPolicy;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityType;
use Dgafka\AuthorizationSecurity\Domain\User\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class SecuritySpec
 *
 * @package spec\Dgafka\AuthorizationSecurity\Application\Api
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @mixin Security
 */
class SecuritySpec extends ObjectBehavior
{

    /** @var  DIContainer */
    private $container;

    function let(DIContainer $container)
    {
        $this->container = $container;
        $this->beConstructedWith($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Dgafka\AuthorizationSecurity\Application\Api\Security');
    }

    public function it_should_run_security_without_policies(SecurityType $security, UserFactory $userFactory, User $user, Resource $resource, ResourceFactory $resourceFactory, SecurityCommand $securityCommand)
    {
        $this->container->getUserFactory('simple_user_factory')->willReturn($userFactory);
        $this->container->getResourceFactory('simple_resource_factory')->willReturn($resourceFactory);
        $this->container->getSecurityType('standard_security')->willReturn($security);

        $userFactory->create()->willReturn($user);
        $resourceFactory->create()->willReturn($resource);

        $security->execute(Argument::type('Dgafka\AuthorizationSecurity\Domain\Expression\Expression'),  $user, $resource, array())->shouldBeCalledTimes(1);

        $securityCommand->securityType()->willReturn('standard_security');
        $securityCommand->expression()->willReturn('user.id > 5');
        $securityCommand->userFactory()->willReturn('simple_user_factory');
        $securityCommand->resourceFactory()->willReturn('simple_resource_factory');
        $securityCommand->policies()->willReturn(array());

        $this->authorize($securityCommand);
    }

    public function it_should_run_security_with_policies(SecurityType $security, UserFactory $userFactory, User $user, Resource $resource, ResourceFactory $resourceFactory, SecurityPolicy $securityPolicy, SecurityCommand $securityCommand)
    {
        $this->container->getUserFactory('simple_user_factory')->willReturn($userFactory);
        $this->container->getResourceFactory('simple_resource_factory')->willReturn($resourceFactory);
        $this->container->getSecurityType('standard_security')->willReturn($security);
        $this->container->getSecurityPolicy('isLocalPolicy')->willReturn($securityPolicy);

        $userFactory->create()->willReturn($user);
        $resourceFactory->create()->willReturn($resource);

        $security->execute(Argument::type('Dgafka\AuthorizationSecurity\Domain\Expression\Expression'),  $user, $resource, array($securityPolicy))->shouldBeCalledTimes(1);

        $securityCommand->securityType()->willReturn('standard_security');
        $securityCommand->expression()->willReturn('user.id > 5');
        $securityCommand->userFactory()->willReturn('simple_user_factory');
        $securityCommand->resourceFactory()->willReturn('simple_resource_factory');
        $securityCommand->policies()->willReturn(array('isLocalPolicy'));

        $this->authorize($securityCommand);
    }

    public function it_should_run_security_when_resource_is_null(SecurityType $security, UserFactory $userFactory, User $user, SecurityPolicy $securityPolicy, SecurityCommand $securityCommand)
    {
        $this->container->getUserFactory('simple_user_factory')->willReturn($userFactory);
        $this->container->getSecurityType('standard_security')->willReturn($security);
        $this->container->getSecurityPolicy('isLocalPolicy')->willReturn($securityPolicy);

        $userFactory->create()->willReturn($user);

        $security->execute(Argument::type('Dgafka\AuthorizationSecurity\Domain\Expression\Expression'),  $user, null, array($securityPolicy))->shouldBeCalledTimes(1);

        $securityCommand->securityType()->willReturn('standard_security');
        $securityCommand->expression()->willReturn('user.id > 5');
        $securityCommand->userFactory()->willReturn('simple_user_factory');
        $securityCommand->resourceFactory()->willReturn(null);
        $securityCommand->policies()->willReturn(array('isLocalPolicy'));

        $this->authorize($securityCommand);
    }

    function it_should_create_empty_expression_when_no_expression_passed(SecurityType $security, UserFactory $userFactory, User $user, SecurityCommand $securityCommand)
    {
        $this->container->getUserFactory('simple_user_factory')->willReturn($userFactory);
        $this->container->getSecurityType('standard_security')->willReturn($security);

        $userFactory->create()->willReturn($user);

        $security->execute(Argument::type('Dgafka\AuthorizationSecurity\Domain\Expression\EmptyExpression'),  $user, null, array())->shouldBeCalledTimes(1);

        $securityCommand->securityType()->willReturn('standard_security');
        $securityCommand->expression()->willReturn(null);
        $securityCommand->userFactory()->willReturn('simple_user_factory');
        $securityCommand->resourceFactory()->willReturn(null);
        $securityCommand->policies()->willReturn([]);

        $this->authorize($securityCommand);
    }

}
