<?php

namespace spec\Dgafka\AuthorizationSecurity\Application;

use Dgafka\AuthorizationSecurity\Application\Core;
use Dgafka\AuthorizationSecurity\Application\CoreConfig;
use Dgafka\AuthorizationSecurity\Application\Helper\DIContainer;
use Dgafka\AuthorizationSecurity\Domain\Expression\ExpressionFunction;
use Dgafka\AuthorizationSecurity\Domain\Expression\ExpressionReader;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class CoreSpec
 *
 * @package spec\Dgafka\AuthorizationSecurity\Application
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @mixin Core
 */
class CoreSpec extends ObjectBehavior
{

    private $config;

    public function let(CoreConfig $config)
    {
        $this->config = $config;
        $this->beConstructedWith($config);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Dgafka\AuthorizationSecurity\Application\Core');
    }

    public function it_should_return_config_object()
    {
        $this->config()->shouldReturn($this->config);
    }

    public function it_should_register_new_options(DIContainer $container, ExpressionReader $expressionReader, ExpressionFunction $expressionFunction)
    {

        $closure = function(){};

        $this->registerExpressionFunction($expressionFunction);
        $this->registerExpressionFunction($expressionFunction);

        $this->registerSecurityType('security1', $closure);
        $this->registerSecurityType('security2', $closure);

        $this->registerSecurityPolicy('policy1', $closure);
        $this->registerSecurityPolicy('policy2', $closure);

        $this->registerUserFactory('user1', $closure);
        $this->registerUserFactory('user2', $closure);

        $this->registerResourceFactory('resource1', $closure);
        $this->registerResourceFactory('resource2', $closure);

        $container->register('expressionReader', $expressionReader)->shouldBeCalled();
        $container->registerSecurityType('standard', $closure)->shouldBeCalled();

        $container->registerSecurityType('security1', $closure)->shouldBeCalled();
        $container->registerSecurityType('security2', $closure)->shouldBeCalled();

        $container->registerSecurityPolicy('policy1', $closure)->shouldBeCalled();
        $container->registerSecurityPolicy('policy2', $closure)->shouldBeCalled();

        $container->registerUserFactory('user1', $closure)->shouldBeCalled();
        $container->registerUserFactory('user2', $closure)->shouldBeCalled();

        $container->registerResourceFactory('resource1', $closure)->shouldBeCalled();
        $container->registerResourceFactory('resource2', $closure)->shouldBeCalled();

        $expressionReader->registerFunction($expressionFunction)->shouldBeCalledTimes(2);

        $this->initialize($container, $expressionReader, $closure);
    }

}
