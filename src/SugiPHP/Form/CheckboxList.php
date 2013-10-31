<?php namespace SugiPHP\Form;


/**
 * \SugiPHP\Form\Input
 */

class CheckboxList extends BaseControl implements IControl
{ 

	protected $values = array();
	protected $value = null;

	/**
	 * Can't instantiate BaseControl
	 * 
	 * @param string
	 */
	public function __construct($name, $label, $values = array())
	{
		$this->setAttribute('name', $name);
		$this->setAttribute('type', 'checkbox');
		$this->label = $label;
		$this->values = $values;
	}

	public function __toString()
	{
		$label = $this->getLabel();

		$classAdded = false;

		$control = "";

		foreach ($this->values as $key => $val) {
			$selected = (!is_null($this->getValue()) && in_array($key,$this->getValue())) ? "checked='checked'" : '' ;

			$control .= "<label><input";
			foreach ($this->attributes as $attr => $value) {
				if ($attr != 'value' && $attr != 'name') {
					if ($this->error and ($attr == 'class')) {
						$value .= " ".$this->form->errorClass();
						$classAdded = true;
					} 
					$control .= " {$attr}=\"{$value}\"";
				}
			}

			if ($this->error and !$classAdded) {
				$control .= " class=\"{$this->form->errorClass()}\"";
			}

			$control .= " value =\"{$key}\"";
			$control .= " name =\"{$this->getName()}[]\"";
			$control .= " {$selected} />{$val}</label>\n";

		}
		
		$error = $this->error ? $this->error : "";
		
		return $this->renderControl(compact('label','control','error'));
	}
}
