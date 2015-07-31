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
            throw new \RuntimeException("Pass expression to AuthorizationExpression annotation. Example usage: @AuthorizationExpression(\" user.hasRole('moderator') \") ");
        }

        $this->expression = trim($values['value']);
    }

    /**
     * @return string
     */
    public function expression()
    {
        return $this->expression;
    }

} 