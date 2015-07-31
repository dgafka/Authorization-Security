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

    /** @var  CoreConfig */
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
        $this->config->debugMode()->willReturn(false);
        $this->config->includePaths()->willReturn(array());
        $this->config->cachePath()->willReturn('/home/cache');

        $closure = function(){ return 1; };

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

        $container->register('expressionReader', $expressionReader)->shouldBeCalledTimes(1);
        $container->registerSecurityType('standard', Argument::type('callable'))->shouldBeCalledTimes(1);
        $container->register('security', Argument::type('Dgafka\AuthorizationSecurity\Application\Api\Security'))->shouldBeCalledTimes(1);

        $container->register('cachePath', '/home/cache')->shouldBeCalledTimes(1);
        $container->register('includePaths', array())->shouldBeCalledTimes(1);
        $container->register('debugMode', false)->shouldBeCalledTimes(1);

        $container->registerSecurityType('security1', Argument::type('callable'))->shouldBeCalledTimes(1);
        $container->registerSecurityType('security2', Argument::type('callable'))->shouldBeCalledTimes(1);

        $container->registerSecurityPolicy('policy1', Argument::type('callable'))->shouldBeCalledTimes(1);
        $container->registerSecurityPolicy('policy2', Argument::type('callable'))->shouldBeCalledTimes(1);

        $container->registerUserFactory('user1', Argument::type('callable'))->shouldBeCalledTimes(1);
        $container->registerUserFactory('user2', Argument::type('callable'))->shouldBeCalledTimes(1);

        $container->registerResourceFactory('resource1', Argument::type('callable'))->shouldBeCalledTimes(1);
        $container->registerResourceFactory('resource2', Argument::type('callable'))->shouldBeCalledTimes(1);

        $expressionReader->registerFunction($expressionFunction)->shouldBeCalledTimes(2);

        $this->initialize($container, $expressionReader, $closure);
        $this->initialize($container, $expressionReader, $closure);
    }

}
