<?php namespace SugiPHP\Form;

/**
 * SugiPHP\Form\Checkbox
 *
 * @extends SugiPHP\Form\Text
 */

use SugiPHP\Form;

class Checkbox extends Text
{

	private $val;

	public function __construct($name, $label, $value = true)
	{
		parent::__construct($name, $label);
		$this->val = $value;
		$this->setAttribute("value", $value);
		$this->setAttribute("type", "checkbox");
	}

	public function error()
	{
		if ($this->error) return $this->error;
		
		if ($this->required and is_null($this->getAttribute("checked"))) {
			return $this->error = $this->required;
		}
		return false;
	}

	public function setValue($value) {
		if ($value == $this->getAttribute("value"))	$this->setAttribute('checked','checked');
		parent::setValue($value);
	}

	public function getValue() {
		return ($this->getAttribute("checked") == 'checked') ? $this->val : null;
	}

	public function readHttpData($data , $key = null)
	{
		$data = Form::filterKey($this->getName(), $data);
		if (!empty($data)) {
			$this->setAttribute('checked','checked');
		}
	}

	public function __toString()
	{
		if (!is_null($this->getValue())) $this->setAttribute('checked','checked');
		return parent::__toString();
	}

}
