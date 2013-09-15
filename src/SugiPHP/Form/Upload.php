<?php namespace SugiPHP\Form;

/**
 * SugiPHP\Form\Submit
 *
 * @extends SugiPHP\Form\Text
 */

class Upload extends Text
{

	public function __construct($name, $label)
	{
		parent::__construct($name, $label);
		$this->setAttribute("type", "file" );
	}

	// protected function value($v = '')
	// {
	// 	return $this
	// }

	public function readHttpData($data)
	{
		if (!isset($_FILES[$this->getName()])) {
			$this->error = $this->required;
		} else {
			$val = $_FILES[$this->getName()];
			$error = $val['error'];
			unset($val['error']);
			switch($error) {
				case UPLOAD_ERR_OK: 
					//"There is no error, the file uploaded with success.";
					$this->error = null;
					break;
				case UPLOAD_ERR_INI_SIZE:
				    //'The uploaded file exceeds the upload_max_filesize directive in php.ini.'
					$this->error = 'The uploaded file is too big.';
					break;
				case UPLOAD_ERR_FORM_SIZE:
				    //'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.'
					$this->error = 'The uploaded file is too big.';
					break;
				case UPLOAD_ERR_PARTIAL:
					//'The uploaded file was only partially uploaded.'.
					$this->error = 'The uploaded file was only partially uploaded.';
					break;
				case UPLOAD_ERR_NO_FILE:
					//'No file was uploaded.'
					$val = null;
					$this->error = $this->required;
					break;
				case UPLOAD_ERR_NO_TMP_DIR:
				    //'Missing a temporary folder.'
					$this->error = 'Missing a temporary folder.';
					break;
				case UPLOAD_ERR_CANT_WRITE:
					//'Failed to write file to disk.'
					$this->error = 'Failed to write file to disk.';
					break;
				case UPLOAD_ERR_EXTENSION:
				    //'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.'
					$this->error = 'Failed to write file to disk.';
					break;
			}
			$this->setValue($val);
		}
		
	}

	public function __toString()
	{
		$label = $this->getLabel();
		
		$classAdded = false;
		$control = "<input";
		foreach ($this->attributes as $attr => $value) {
			if ($attr != "value") {
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
		$control .= " />";

		$error = $this->error ? $this->error : "";

		return $this->renderControl(compact('label','control','error'));
	}

}
