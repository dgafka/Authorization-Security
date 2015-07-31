<?php

namespace Dgafka\Examples;

use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationSecurity;
use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationExpression;

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



} 