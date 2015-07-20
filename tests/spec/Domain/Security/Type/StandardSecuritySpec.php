<?php

namespace spec\Dgafka\AnnotationSecurity\Domain\Security\Type;

use Dgafka\AnnotationSecurity\Domain\Expression\Expression;
use Dgafka\AnnotationSecurity\Domain\Expression\ExpressionReader;
use Dgafka\AnnotationSecurity\Domain\Resource\BaseResource;
use Dgafka\AnnotationSecurity\Domain\Security\SecurityPolicy;
use Dgafka\AnnotationSecurity\Domain\Security\Type\RoleBasedSecurity;
use Dgafka\AnnotationSecurity\Domain\Security\Type\StandardSecurity;
use Dgafka\AnnotationSecurity\Domain\User\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class RoleBasedSecuritySpec
 *
 * @package spec\Dgafka\AnnotationSecurity\Domain\Security\Type
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
        $this->beConstructedWith($expressionReader);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Dgafka\AnnotationSecurity\Domain\Security\Security');
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
        $this->shouldThrow('Dgafka\AnnotationSecurity\Domain\Security\SecurityAccessDenied')->during('execute', [$expression, $user, $resource, []]);

        $this->expressionReader->evaluate($expression, [ 'user' => $user, 'resource' => $resource ])->shouldBeCalled()->willReturn(true);
        $securityPolicy->execute($user, $resource)->willReturn(false);
        $this->shouldThrow('Dgafka\AnnotationSecurity\Domain\Security\SecurityAccessDenied')->during('execute', [$expression, $user, $resource, [$securityPolicy]]);
    }

}
