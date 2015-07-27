<?php

namespace spec\Dgafka\Security\Domain\Security\Type;

use Dgafka\Security\Domain\Expression\Expression;
use Dgafka\Security\Domain\Expression\ExpressionReader;
use Dgafka\Security\Domain\Resource\BaseResource;
use Dgafka\Security\Domain\Security\SecurityPolicy;
use Dgafka\Security\Domain\Security\Type\StandardSecurity;
use Dgafka\Security\Domain\User\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RoleBasedSecuritySpec
 *
 * @package spec\Dgafka\Security\Domain\Security\Type
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
        $this->shouldHaveType('Dgafka\Security\Domain\Security\SecurityType');
    }

    public function it_should_evaluate_true(Expression $expression, User $user, BaseResource $resource, SecurityPolicy $securityPolicy)
    {
        $this->expressionReader->evaluate($expression, [ 'user' => $user, 'resource' => $resource ])->shouldBeCalledTimes(2)->willReturn(true);
        $this->execute($expression, $user, $resource, []);

        $this->expressionReader->evaluate($expression, [ 'user' => $user, 'resource' => null ])->shouldBeCalledTimes(1)->willReturn(true);
        $this->execute($expression, $user, null, []);

        $securityPolicy->execute($user, $resource)->shouldBeCalled()->willReturn(true);
        $this->execute($expression, $user, $resource, [$securityPolicy]);
    }

    public function it_should_throw_exception_if_evaluated_false(Expression $expression, User $user, BaseResource $resource, SecurityPolicy $securityPolicy)
    {
        $this->expressionReader->evaluate($expression, [ 'user' => $user, 'resource' => $resource ])->shouldBeCalled()->willReturn(false);
        $this->shouldThrow('Dgafka\Security\Domain\Security\SecurityAccessDenied')->during('execute', [$expression, $user, $resource, []]);

        $this->expressionReader->evaluate($expression, [ 'user' => $user, 'resource' => $resource ])->shouldBeCalled()->willReturn(true);
        $securityPolicy->execute($user, $resource)->willReturn(false);
        $this->shouldThrow('Dgafka\Security\Domain\Security\SecurityAccessDenied')->during('execute', [$expression, $user, $resource, [$securityPolicy]]);
    }

}
