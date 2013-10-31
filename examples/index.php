<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('html_errors',    '1');

require realpath(__DIR__.'/../vendor/autoload.php');

use SugiPHP\Form;


$form = new Form('test_form', array(
	'error_class' => 'form_error',
	'control_tpl' => "{label}<div class=\"control\">\n{control}\n{error}\n</div>\n",
	'form_error_tpl' => "<div class='{error_class}'>{error}</div>",
));
$form
	//->errorClass("form_error")
	//->formErrorTemplate("<div class='{error_class}'>{error}</div>")
	//->controlTemplate("{label}<div class=\"control\">\n{control}\n{error}\n</div>\n")
	->addCheckbox("terms", "terms" , "link")->rule("required", "Please agree with term of use");

$form->addSelect("test_select", "color" , array(
	"" => "-- Choose color --",
	1 => "Braun",
	2 => "Red",
	3 => "Blue",
))->rule("required", "Please choose a color");

$countries = array(
	"" => "-- Choose country --",
	"europe" => array(
		1 => "France",
		2 => "Bulgaria",
	),
	"asia" => array(
		3 => "China",
		4 => "Japan",
		5 => array("label" => "India", "class" => "test" , "id" => "test" )	,
));

$select = $form->addSelect("test_select2", "country" , $countries)->value(2)->rule("required", "Please choose a country");

//$select->getOption(3)->setSelected();
$select->value(3)->labelAttribute('class','labelTest');
$select->getOption(3)->attribute('class','test');

$form->addMultipleSelect("test_mselect2", "mcountry" , $countries)->value(array(1,3))->rule("required", "Please choose a country");


$form->addMultipleSelect("test_mselect", "mcolor" , array(
	1 => "Braun",
	2 => "Red",
	3 => "Blue",
))->value(array(2));

$form->addRadio("test_radio", "hair" , array(
	1 => "Braun",
	2 => "Red",
	3 => "Blue",
))->value(3)->rule("required","Please choose a color");

$form->addCheckboxList("test_checkboxList", "hair" , array(
	1 => "Braun",
	2 => "Red",
	3 => "Blue",
))->value(array(3))->rule("required","Please choose a color");



$form->addText("test_age", "Age")
	->rule('min', 'minimum 5', 5)
	->rule('max', 'maximum 2000', 2000);

$form->addText("test_age2", "Age range")
	->rule('range', 'between 5 and 20', 5, 20);

$form->addTextarea("test_area", "Description")
	->rule('min_length', 'minimum 5 symbols', 5)
	->rule('max_length', 'maximum 2000 symbols', 2000);

$form->addTextarea("test_area2", "Descr. range")
	->rule('length', 'between 5 and 20', 5, 20);

$form->addText("fname", "First Name:")
	->rule('regexp' , 'Името трябва да съдържа поне една голяма буква',  '/[A-Z]/');

$form->addText("email", "Email:")
//	->rule('required','required')
	->rule('email' , 'should be valid email')
	->rule('callback' , 'should be \'email@domain.com\'', 'callmeback');

function callmeback($val) {	return $val == 'email@domain.com';}

$form->addText("url", "URL:")->rule('url' , 'should be a valid url');

$form->addUpload("file", "test")->rule("required"	);

$form->addSubmit("submit", "Send");
$form->addSubmit("submit2", "Send2");


if ($form->submitted()) {
	$data = $form->data();
	if ($data['test_area'] == '11') $form->addError('test_area', 'Could not be 11');   
	if ($form->valid()) {
		$tpl->hide('form');
	}
} else {
	$form->getControl('terms')->value('link');
}

header('Content-Type: text/html; charset=utf-8');
echo $form;
echo "<hr/>";
echo htmlspecialchars($form);

var_dump($form->data());
?>
