<?php

namespace Dgafka\Examples;

use Dgafka\AuthorizationSecurity\UI\Annotation\Type\AuthorizationSecurity;

class BasicUsage
{

    /**
     * @AuthorizationSecurity(type="standard", userFactory="roleUserFactory")
     * @return void
     */
    public function doIt()
    {
        echo "This evaluates true, since there is no expression, neither a policy\n";
    }


}