<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require(__DIR__ . '/../../vendor/autoload.php');

use Dgafka\AuthorizationSecurity\Application\Core;
use Dgafka\AuthorizationSecurity\Application\CoreConfig;
use Dgafka\AuthorizationSecurity\UI\Annotation\AnnotationSecurity;

//Initialization

$core = new Core(new CoreConfig(array(
    __DIR__,
), __DIR__ . '/../cache', true));

$core->registerUserFactory('roleUserFactory', function(){
    return new \Dgafka\Fixtures\Factory\RoleUserFactory(1, ['test']);
});

$core->registerUserFactory('identityUserFactory', function(){
	return new \Dgafka\Fixtures\IBAC\IdentityUserFactory(10);
});

$core->registerResourceFactory('resourceFactory', function(){
	return new \Dgafka\Fixtures\IBAC\ExampleResourceFactory();
});

$core->registerSecurityType('ibac', function(){
	return new \Dgafka\Fixtures\IBAC\IBACSecurity(new \Dgafka\Fixtures\IBAC\SimpleACL(['10' => [10, 12]]));
});

$core->registerSecurityPolicy('isLocalHost', function(){
	return new \Dgafka\Fixtures\Policies\IsLocalHost();
});

$core->registerSecurityPolicy('isMonday', function(){
	return new \Dgafka\Fixtures\Policies\IsMonday();
});

$annotationSecurity = AnnotationSecurity::getInstance();
$annotationSecurity->init($core);







//Tests



echo "\nFirst Example:\n";
$example = new \Dgafka\Examples\BasicUsage;
$example->doIt();


echo "\nSecond Example:\n";
$example = new \Dgafka\Examples\TestExpression();

$shouldCatchException = false;
try {
	$example->tellMeWhy();
}catch (\Dgafka\AuthorizationSecurity\Domain\Security\SecurityAccessDenied $e) {
	$shouldCatchException = true;
}
PHPUnit_Framework_Assert::assertEquals(true, $shouldCatchException);

$example->test();


echo "\nThird Example\n";
$example = new \Dgafka\Examples\TestSecurityType();

$command = new stdClass();
$command->resourceId = 10;
$example->test($command);

$command = new stdClass();
$command->resourceId = 13;

$shouldCatchException = false;
try {
	$example->test($command);
}catch (\Dgafka\AuthorizationSecurity\Domain\Security\SecurityAccessDenied $e) {
	$shouldCatchException = true;
}
PHPUnit_Framework_Assert::assertEquals(true, $shouldCatchException);


echo "\nFourth Example\n";

$example = new \Dgafka\Examples\TestPolicies();

$shouldCatchException = false;
try {
	$example->test($command);
}catch (\Dgafka\AuthorizationSecurity\Domain\Security\SecurityAccessDenied $e) {
	$shouldCatchException = true;
}
PHPUnit_Framework_Assert::assertEquals(true, $shouldCatchException);

$example->test2();



//Basic Security

$basicSecurity = \Dgafka\AuthorizationSecurity\UI\Basic\BasicSecurity::getInstance();
$basicSecurity->init($core);

$command = new \Dgafka\AuthorizationSecurity\Application\Api\SecurityCommand('standard', 'user.id == 4', 'roleUserFactory');
PHPUnit_Framework_Assert::assertEquals(false, $basicSecurity->isAuthorized($command));

$command = new \Dgafka\AuthorizationSecurity\Application\Api\SecurityCommand('standard', 'user.id == 1', 'roleUserFactory');
PHPUnit_Framework_Assert::assertEquals(true, $basicSecurity->isAuthorized($command));