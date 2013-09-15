<?php namespace SugiPHP\Form;

/**
 * SugiPHP\Form\Password
 * 
 * @extends SugiPHP\Form\Text
 */

class Password extends Text
{
	public function __construct($name, $label)
	{
		parent::__construct($name, $label);
		
		$this->setAttribute("type", "password");
	}
}
