<?php
/*
* app/validators.php
*/


Validator::extend('alpha_spaces', function($attribute, $value) // <-- ALPHABET/NUMBERS/ENYE/DOT/SPACE
{
	
    return preg_match("/^([-a-z_-ñÑ. ])+$/i", $value);

});

Validator::extend('decimal', function($attribute, $value) // <-- ALPHABET/NUMBERS/ENYE/DOT/SPACE
{
    
    if(!ctype_digit(str_replace(str_split(' ,s.'),'',$value)))
	{
		return false;
	}				
	else									
	{
		return true;
	}
});









