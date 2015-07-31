<?php

namespace Dgafka\AuthorizationSecurity\UI\Annotation\Type;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class AuthorizationSecurity
 *
 * @package Dgafka\AuthorizationSecurity\UI\Annotation\Type
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @Annotation
 * @Target({"METHOD"})
 */
class AuthorizationSecurity
{

    /** @var  string */
    private $securityTypeName;

    /** @var  string */
    private $userFactoryName;

    public function __construct(array $values)
    {

        if(!isset($values['type'])) {
            throw new \RuntimeException("Pass 'type' of security to AuthorizationSecurity annotation.");
        }

        if(!isset($values['userFactory'])) {
            throw new \RuntimeException("Pass 'userFactory' to AuthrizationSecurity annotation.");
        }

        $this->securityTypeName = $values['type'];
        $this->userFactoryName  = $values['userFactory'];
    }


    /**
     * @return string
     */
    public function securityTypeName()
    {
        return $this->securityTypeName;
    }

    /**
     * @return string
     */
    public function userFactoryName()
    {
        return $this->userFactoryName;
    }

}