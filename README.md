#Security Framework#


###Expression Language###
Security framework, comes with `expression language`: https://github.com/symfony/expression-language.

Expression module provides two classes, which will be up to use, inside of expressions.

	user.permission.level > 5 and user.id == 2

Those classes are `user` and `resource`.

####User
Every user need to extends base User class.

	abstract class User
	{
	
			/**
			 * @var string
			 */
			public $id;
		
			/**
			 * @param string $id
			 */
			public function __construct($id)
			{
				$this->id = $id;
			}
		
			/**
			 * @return string
			 */
			public function id()
			{
				return $this->id;
			}
	
	}

As you can see necessary element is `id`.  Which is visible in `expression language` now, like any other variable you will choose to add.

Variables aren't the only thing you can use inside `expression`. Every method, which will be visible (**public methods**), will be also free to use inside expression.

	final class RoleUser extends User
	{

		/** @var Roles  */
		private $roles;
	
		/**
		 * @param string $id
		 * @param Roles $roles
		 */
		public function __construct($id, Roles $roles)
		{
			parent::__construct($id);
			$this->roles = $roles;
		}
	
		/**
		 * @param $roleName
		 *
		 * @return bool
		 */
		public function hasRole($roleName)
		{
			return $this->roles->hasRole($roleName);
		}
	
		/**
		 * @param array $roleNames
		 *
		 * @return bool
		 */
		public function containsRole(array $roleNames = array())
		{
			return $this->roles->containsRole($roleNames);
		}

	}

Usage in `expression`:

	user.containsRole(['Rambo', 'Admin']) or user.hasRole('Moderator')

####Resource

The `Resource` class works exactly the same as the `User` does.
It's up to you, if you want to build Resource based on clean interface BaseResource or implement it by extending Resource.

	class Resource implements BaseResource
	{
	
		/** @var  string */
		public $id;
	
		/** @var  string */
		public $type;
	
		public function __construct($id, $type)
		{
			$this->id   = $id;
			$this->type = $type;
		}
	
		/**
		 * @return string
		 */
		public function id()
		{
			return $this->id;
		}
	
		/**
		 * @return string
		 */
		public function type()
		{
			return $this->type;
		}
	
	}

#### Your own expression functions ####

Sometimes you will need to implement your own expression functions.
Before you will read this section, check `Security Policy` section first.
It's highly recommended to use policies over own expressions.
Policies are lightweight and expression function are not, besides they make your code looks more clear.
The only difference, which should make you choose expression function is possibility of usage `or` statement in expressions. Policies works as `and` statement. 
Read more in `Security Policy` section.

So, if you chose to use expression function, how to do it?

Every new expression function need to implements ExpressionFunction interface.

	interface ExpressionFunction
	{
	
		/**
		 * Returns function name, which will be used to initialize function in expression language
		 *
		 * @return string
		 */
		public function name();
	
		/**
		 * Returns Expression function implementation as closure
		 *
		 * @return \Closure
		 */
		public function expressionFunction();
	
	}
	
It contains two abstract functions `name` and `expressionFunction`.

>**Name**  

> should return as a string name of a function, which will be visible in expression language. 
> For example: `isLocalHost`

>**Expression Function**
> Should return closure describing process of evaluating given function.
>  For example it can check, if IP is equal to localhost. 

Above code could looks like that:
			
	public function name()
	{
		return 'isLocalHost';
	}
	public function expressionFunction()
	{
		$sessionStore = $this->sessionStore;
		return function($arguments) use ($sessionStore) {
			return $sessionStore->getIP() === 'localhost';
		};
	}

Usage in `expression`:

	user.permission.level < 5 && isLocalHost()

If you have eagle eyes, you probably saw `$arguments` as a closure parameter.
Under this variable you can find every parameter passed inside expression.

Let's say we have expression `equalTo10`, that takes two parameters.

Usage in `expression`:
	
	isLocalHost() && equalTo10(5, 2)

Implementation could looks like this:

	public function name()
	{
		return 'equalTo10';
	}
	
	public function expressionFunction()
	{
		return function($arguments) {
			return ($arguments[0] + $arguments[1]) === 10;
		};
	}
Parameters are passed inside array, first argument under first index, second under second and so on. 