<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require('../../vendor/autoload.php');

$language = new \Symfony\Component\ExpressionLanguage\ExpressionLanguage();

class User
{
	public $age;

	public function __construct($age)
	{
		$this->age = $age;
	}

	public function roles($roles)
	{
		var_dump($roles);
	}

	public function getClosure()
	{
		$bla = 1;
		$tmp = function() use ($bla) {
			return $bla;
		};

		return $tmp;
	}

}

$user = new User(11);
//$rfl = new \ReflectionClass($user);
//$property = $rfl->getProperty('age');
//$property->setAccessible(true);


//var_dump(
//	$language->evaluate("user.age in [10, 20]", [ 'user' => $user ])
//);

$closure = $user->getClosure();


//use Symfony\Component\ExpressionLanguage\ExpressionFunction;
//use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
//
//class StringExpressionLanguageProvider implements ExpressionFunctionProviderInterface
//{
//	public function getFunctions()
//	{
//		return array(
//			new ExpressionFunction('lowercase', null, function ($arguments, $str, $test, $bla) {
//				var_dump($str);
////				if (!is_string($str)) {
////					return $str;
////				}
////
////				return strtolower($str);
//			}),
//		);
//	}
//}

//$language = new \Symfony\Component\DependencyInjection\ExpressionLanguage(null, array(
//	new StringExpressionLanguageProvider()
//));

//$language->register('lowercase', null, function($arguments, $str) {
//
//	$args = func_get_args();
//	array_shift($args);
//
//	$function = function ($arguments) {
//
//		if (!is_string($arguments[1])) {
//			return $arguments[1];
//		}
//
//		return strtolower($arguments[1]);
//	};
//
//	return $function($args);
//});

//var_dump($language->evaluate('lowercase({"test" : "HELLO"}, "TEST", "blabla")'));



use Dgafka\AuthorizationSecurity\Application\Core;
use Dgafka\AuthorizationSecurity\Application\CoreConfig;
use Dgafka\AuthorizationSecurity\UI\Annotation\AnnotationSecurity;



$core = new Core(new CoreConfig(array(
    __DIR__,
), __DIR__ . '/../cache', true));

$core->registerUserFactory('roleUserFactory', function(){
    return new \Dgafka\Fixtures\Factory\RoleUserFactory(1, ['test']);
});

$annotationSecurity = AnnotationSecurity::getInstance();
$annotationSecurity->init($core);

echo "\nFirst Example:\n";
$basicUsage = new \Dgafka\Examples\BasicUsage;
$basicUsage->doIt();


echo "\nSecond Example:\n";
$expression = new \Dgafka\Examples\TestExpression();
$expression->tellMeWhy();

//$expression->test();