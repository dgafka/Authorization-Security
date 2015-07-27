<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    /** @var array  */
    private $userRoles = [];

    /** @var  string name of the security */
    private $securityName;

    /** @var  \Dgafka\Security\Application\Api\Security */
    private $securityAPI;

    /** @var  \Dgafka\Security\Application\Core */
    private $applicationCore;

    /** @var  \Dgafka\Security\Application\Helper\DIContainer */
    private $container;

    /** @var  int */
    private $securityCheckResult;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }


    /**
     * @Given users with roles:
     */
    public function usersWithRoles(TableNode $table)
    {
        foreach($table->getColumnsHash() as $userInfo) {
            $roles = explode(',', $userInfo['role']);

            $this->userRoles[$userInfo['user']] = $roles;
        }
    }


    /**
     * @Given users with level:
     */
    public function usersWithLevel(TableNode $table)
    {
        foreach($table->getColumnsHash() as $userInfo) {
            $this->userRoles[$userInfo['user']] = $userInfo['level'];
        }
    }

    /**
     * @Given :arg1 security
     */
    public function security($securityName)
    {
        $this->securityName = $securityName;
        \org\bovigo\vfs\vfsStream::setup('home');
        $this->container        = \Dgafka\Fixtures\Application\DIContainer::getInstance();


        $this->applicationCore = new \Dgafka\Security\Application\Core(new \Dgafka\Security\Application\CoreConfig(array(\org\bovigo\vfs\vfsStream::url('home')), \org\bovigo\vfs\vfsStream::url('home/cache'), true));
        $this->securityAPI  = new \Dgafka\Security\Application\Api\Security($this->container);

        switch($securityName) {
            case 'role':
                $this->applicationCore->registerSecurityType('role', function() {
                    return new \Dgafka\Security\Domain\Security\Type\StandardSecurity();
                });
                break;
            case 'lattice':
                $this->applicationCore->registerSecurityType('lattice', function() {
                    return new \Dgafka\Security\Domain\Security\Type\StandardSecurity();
                });
                break;
            default:
                throw new \Exception("Operation not permitted");
        }
    }

    /**
     * @Given is user with id :userID
     */
    public function isUserWithId($userID)
    {
        $additional = $this->userRoles[$userID];

        switch($this->securityName) {
            case 'role':
                $this->applicationCore->registerUserFactory($this->securityName, function () use ($userID, $additional) {
                    return new \Dgafka\Fixtures\Factory\RoleUserFactory($userID, $additional);
                });
                break;
            case 'lattice':
                $this->applicationCore->registerUserFactory($this->securityName, function () use ($userID, $additional) {
                    return new \Dgafka\Fixtures\Factory\LatticeUserFactory($userID, $additional);
                });
                break;
        }
    }

    /**
     * @When user check :expression
     */
    public function userCheck($expression)
    {
        $this->applicationCore->initialize($this->container, new \Dgafka\Security\Infrastructure\ExpressionReader(new \Symfony\Component\ExpressionLanguage\ExpressionLanguage()), function(){
            return new \Dgafka\Security\Domain\Security\Type\StandardSecurity();
        });

        try {
            $this->securityAPI->authorize($this->securityName, $expression, $this->securityName);
            $this->securityCheckResult = 1;
        }catch (\Dgafka\Security\Domain\Security\SecurityAccessDenied $e) {
            $this->securityCheckResult = 0;
        }
    }

    /**
     * @When user check :expression and :policies
     */
    public function userCheckAnd($expression, $policies)
    {
        $this->applicationCore->initialize($this->container, new \Dgafka\Security\Infrastructure\ExpressionReader(new \Symfony\Component\ExpressionLanguage\ExpressionLanguage()), function(){
            return new \Dgafka\Security\Domain\Security\Type\StandardSecurity();
        });
        $policies = explode(',', $policies);

        try {
            $this->securityAPI->authorize($this->securityName, $expression, $this->securityName, null, $policies);
            $this->securityCheckResult = 1;
        }catch (\Dgafka\Security\Domain\Security\SecurityAccessDenied $e) {
            $this->securityCheckResult = 0;
        }
    }

    /**
     * @Then he should be allowed :securityCheckResult
     */
    public function heShouldBeAllowed($securityCheckResult)
    {
        PHPUnit_Framework_Assert::assertEquals($securityCheckResult, $this->securityCheckResult);
    }

    /**
     * @Given expression language contains own functions
     */
    public function expressionLanguageContainsOwnFunctions()
    {

        $this->applicationCore->registerExpressionFunction(new \Dgafka\Fixtures\ExpressionFunction\IsLocalHost());
        $this->applicationCore->registerExpressionFunction(new \Dgafka\Fixtures\ExpressionFunction\IsSuperPlayer());
        $this->applicationCore->registerExpressionFunction(new \Dgafka\Fixtures\ExpressionFunction\IsStringLower());
        $this->applicationCore->registerExpressionFunction(new \Dgafka\Fixtures\ExpressionFunction\IsEqualTo());

    }

    /**
     * @Given security contains own policies
     */
    public function securityContainsOwnPolicies()
    {

        $this->applicationCore->registerSecurityPolicy('isLocalHost', function(){
            return new \Dgafka\Fixtures\Policies\IsLocalHost();
        });
        $this->applicationCore->registerSecurityPolicy('isMonday', function(){
            return new \Dgafka\Fixtures\Policies\IsMonday();
        });
        $this->applicationCore->registerSecurityPolicy('isSuperUser', function(){
            return new \Dgafka\Fixtures\Policies\IsSuperUser();
        });
        $this->applicationCore->registerSecurityPolicy('userLevelHigherThan5', function(){
            return new \Dgafka\Fixtures\Policies\UserLevelHigherThan5();
        });

    }

}
