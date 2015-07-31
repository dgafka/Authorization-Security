<?php

namespace Dgafka\AuthorizationSecurity\UI\Annotation\Type;

/**
 * Class AuthorizationExpression
 * @package Dgafka\AuthorizationSecurity\UI\Annotation\Type
 * @Annotation
 * @Target({"METHOD"})
 */
class AuthorizationExpression
{

    /** @var  string */
    private $expression;

    /**
     * @param array $values
     *
     * @throws \RuntimeException
     */
    public function __construct(array $values)
    {
        if(!isset($values['value'])) {
            throw new \RuntimeException("Pass expression to AuthorizationExpression annotation");
        }

        $this->expression = $values['value'];
    }

    /**
     * @return string
     */
    public function expression()
    {
        return $this->expression;
    }

} 