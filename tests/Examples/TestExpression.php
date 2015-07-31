<?php

namespace Dgafka\Examples;

use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationSecurity;
use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationExpression;
use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationResourceFactory;

/**
 * Class Expression
 * @package Dgafka\Examples
 */
class TestExpression
{

    /**
     * @AuthorizationSecurity(type="standard", userFactory="roleUserFactory")
     * @AuthorizationExpression(" user.hasRole('moderator') ")
     */
    public function tellMeWhy()
    {
        echo "BecauseYourHigh!";
    }

    /**
     * @AuthorizationSecurity(type="standard", userFactory="roleUserFactory")
     * @AuthorizationExpression(" user.hasRole('moderator') or user.hasRole('test') ")
     */
    public function test()
    {
        echo "Well seems, that I have enough power to run this method";
    }

} 