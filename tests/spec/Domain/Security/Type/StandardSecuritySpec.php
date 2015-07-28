<?php

namespace spec\Dgafka\AuthorizationSecurity\Domain\Security\Type;

use Dgafka\AuthorizationSecurity\Domain\Expression\Expression;
use Dgafka\AuthorizationSecurity\Domain\Expression\ExpressionReader;
use Dgafka\AuthorizationSecurity\Domain\Resource\Resource;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityPolicy;
use Dgafka\AuthorizationSecurity\Domain\Security\Type\StandardSecurity;
use Dgafka\AuthorizationSecurity\Domain\User\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RoleBasedSecuritySpec
 *
 * @package spec\Dgafka\AuthorizationSecurity\Domain\Security\Type
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @mixin StandardSecurity
 */
class StandardSecuritySpec extends ObjectBehavior
{

    /** @var  ExpressionReader */
    private $expressionReader;

    public function let(ExpressionReader $expressionReader)
    {
        $this->expressionReader = $expressionReader;
        $this->setExpressionReader($expressionReader);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Dgafka\AuthorizationSecurity\Domain\Security\SecurityType');
    }

    public function it_should_evaluate_true(Expression $expression, User $user, Resource $resource, SecurityPolicy $securityPolicy)
    {
        $this->expressionReader->evaluate($expression, [ 'user' => $user, 'resource' => $resource ])->shouldBeCalledTimes(2)->willReturn(true);
        $this->execute($expression, $user, $resource, []);

        $this->expressionReader->evaluate($expression, [ 'user' => $user, 'resource' => null ])->shouldBeCalledTimes(1)->willReturn(true);
        $this->execute($expression, $user, null, []);

        $securityPolicy->execute($user, $resource)->shouldBeCalled()->willReturn(true);
        $this->execute($expression, $user, $resource, [$securityPolicy]);
    }

    public function it_should_throw_exception_if_evaluated_false(Expression $expression, User $user, Resource $resource, SecurityPolicy $securityPolicy)
    {
        $this->expressionReader->evaluate($expression, [ 'user' => $user, 'resource' => $resource ])->shouldBeCalled()->willReturn(false);
        $this->shouldThrow('Dgafka\AuthorizationSecurity\Domain\Security\SecurityAccessDenied')->during('execute', [$expression, $user, $resource, []]);

        $this->expressionReader->evaluate($expression, [ 'user' => $user, 'resource' => $resource ])->shouldBeCalled()->willReturn(true);
        $securityPolicy->execute($user, $resource)->willReturn(false);
        $this->shouldThrow('Dgafka\AuthorizationSecurity\Domain\Security\SecurityAccessDenied')->during('execute', [$expression, $user, $resource, [$securityPolicy]]);
    }

}
