<?php namespace SugiPHP\Form;

/**
 * SugiPHP\Form\Hidden
 *
 * @extends SugiPHP\Form\Text
 */

class Hidden extends Text
{
	public function __construct($name, $value)
	{
		parent::__construct($name, false);

		$this->setAttribute("value", $value);
		$this->setAttribute("type", "hidden");
	}

	public function error()
	{
		return false;
	}
}
