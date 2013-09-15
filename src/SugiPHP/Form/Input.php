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
		return $this->setAttribute("value", $value);
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
