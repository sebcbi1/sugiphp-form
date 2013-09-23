<?php namespace SugiPHP\Form;

/**
 * \SugiPHP\Form\Input
 */

class Input extends BaseControl
{
	
	/**
	 * Sets control value
	 * 
	 * @param string
	 */
	protected function setValue($value)
	{
		parent::setValue($value);
		return $this->setAttribute("value", $this->value);
	}

	/**
	 * Returns submitted data
	 * 
	 * @return string
	 */
	protected function getValue()
	{
		return $this->getAttribute("value");
	}

	public function readHttpData($data)
	{
		$this->setValue(\SugiPHP\Form::filterKey($this->getName(), $data));
	}

}
