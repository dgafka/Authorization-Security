<?php

namespace spec\Dgafka\Security\Application\Api;

use Dgafka\Security\Application\Api\Security;
use Dgafka\Security\Application\Helper\DIContainer;
use Dgafka\Security\Application\Helper\ResourceFactory;
use Dgafka\Security\Application\Helper\UserFactory;
use Dgafka\Security\Domain\Expression\ExpressionFunction;
use Dgafka\Security\Domain\Expression\ExpressionReader;
use Dgafka\Security\Domain\Resource\BaseResource;
use Dgafka\Security\Domain\Resource\Resource;
use Dgafka\Security\Domain\Security\SecurityPolicy;
use Dgafka\Security\Domain\Security\SecurityType;
use Dgafka\Security\Domain\User\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class SecuritySpec
 *
 * @package spec\Dgafka\Security\Application\Api
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
        $this->shouldHaveType('Dgafka\Security\Application\Api\Security');
    }

    public function it_should_run_security_without_policies(SecurityType $security, UserFactory $userFactory, User $user, Resource $resource, ResourceFactory $resourceFactory)
    {
        $this->container->getUserFactory('simple_user_factory')->willReturn($userFactory);
        $this->container->getResourceFactory('simple_resource_factory')->willReturn($resourceFactory);
        $this->container->getSecurityType('standard_security')->willReturn($security);

        $userFactory->create()->willReturn($user);
        $resourceFactory->create()->willReturn($resource);

        $security->execute(Argument::type('Dgafka\Security\Domain\Expression\Expression'),  $user, $resource, array())->shouldBeCalledTimes(1);

        $this->authorize('standard_security', 'user.id > 5', 'simple_user_factory', 'simple_resource_factory');
    }

    public function it_should_run_security_with_policies(SecurityType $security, UserFactory $userFactory, User $user, Resource $resource, ResourceFactory $resourceFactory, SecurityPolicy $securityPolicy)
    {
        $this->container->getUserFactory('simple_user_factory')->willReturn($userFactory);
        $this->container->getResourceFactory('simple_resource_factory')->willReturn($resourceFactory);
        $this->container->getSecurityType('standard_security')->willReturn($security);
        $this->container->getSecurityPolicy('isLocalPolicy')->willReturn($securityPolicy);

        $userFactory->create()->willReturn($user);
        $resourceFactory->create()->willReturn($resource);

        $security->execute(Argument::type('Dgafka\Security\Domain\Expression\Expression'),  $user, $resource, array($securityPolicy))->shouldBeCalledTimes(1);

        $this->authorize('standard_security', 'user.id > 5', 'simple_user_factory', 'simple_resource_factory', array('isLocalPolicy'));
    }

    public function it_should_run_security_when_resource_is_null(SecurityType $security, UserFactory $userFactory, User $user, SecurityPolicy $securityPolicy)
    {
        $this->container->getUserFactory('simple_user_factory')->willReturn($userFactory);
        $this->container->getSecurityType('standard_security')->willReturn($security);
        $this->container->getSecurityPolicy('isLocalPolicy')->willReturn($securityPolicy);

        $userFactory->create()->willReturn($user);

        $security->execute(Argument::type('Dgafka\Security\Domain\Expression\Expression'),  $user, null, array($securityPolicy))->shouldBeCalledTimes(1);

        $this->authorize('standard_security', 'user.id > 5', 'simple_user_factory', null, array('isLocalPolicy'));
    }

    function it_should_create_empty_expression_when_no_expression_passed(SecurityType $security, UserFactory $userFactory, User $user)
    {
        $this->container->getUserFactory('simple_user_factory')->willReturn($userFactory);
        $this->container->getSecurityType('standard_security')->willReturn($security);

        $userFactory->create()->willReturn($user);

        $security->execute(Argument::type('Dgafka\Security\Domain\Expression\EmptyExpression'),  $user, null, array())->shouldBeCalledTimes(1);

        $this->authorize('standard_security', null, 'simple_user_factory', null);
    }

}
