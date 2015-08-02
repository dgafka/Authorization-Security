## Authorization Security

Authorization Security provides powerful open for extending library. 
The main idea behind it, is to provide easy to read, clean way of securing your applications.

Example usage of security:

        /*
        * @AuthorizationSecurity(type="standard", userFactory="roleUserFactory")
        * @AuthorizationExpression(" user.hasRole('moderator') and resource.isAvailable() ")
        * @AuthorizationResourceFactory("resourceFactory", parameters="article")
		* @AuthorizationPolicy("isMonday")
		* @AuthorizationPolicy("hasPremiumAccount")
        */
        public function changeArticle($command)

>Read Authorization Security Wiki to get known with library
[Read Here](https://github.com/dgafka/Authorization-Security/wiki/1.-About)