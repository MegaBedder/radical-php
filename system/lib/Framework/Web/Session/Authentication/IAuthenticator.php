<?php
namespace Web\Session\Authentication;

use Web\Session\Authentication\Source\ISessionSource;

interface IAuthenticator {
	function Authenticate();
	function Init(ISessionSource $handler);
	function AuthenticationError($error = 'Username or Password Invalid');
}