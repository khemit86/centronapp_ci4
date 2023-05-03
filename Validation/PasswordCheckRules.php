<?php
namespace App\Validation;

class PasswordCheckRules
{
	public function passwordCheckValidation(string $str, string $fields, array $data)
	{
		$password = trim($data['password']);
		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
		
		
		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			
			return FALSE;
		}
		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			return FALSE;
		}
		if (preg_match_all($regex_number, $password) < 1)
		{
			return FALSE;
		}
		if (preg_match_all($regex_special, $password) < 1)
		{
			
			return FALSE;
		}
		
		return true;
		/* if ($data['password'] == 'abc') {
			return false;
		} else {
			return false;
		} */
	}
}		
