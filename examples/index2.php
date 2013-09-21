<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('html_errors',    '1');

require realpath(__DIR__.'/../vendor/autoload.php');

use SugiPHP\Form;


$form = new Form(null, array(
	'error_class' => 'form_error',
	'control_tpl' => "{label}<div class=\"control\">\n{control}\n{error}\n</div>\n",
	'form_error_tpl' => "<div class='{error_class}'>{error}</div>",
));

$form->addText("email", "Email:")->filter('trim')->filter('addgmail');

function addgmail($val) {	return $val . '@gmail.com';}


for ($i=1; $i <= 3; $i++) { 
	$ctrl = $form->addText("urls", "URL{$i}:")->filter('trim');;
	if ($i == 2) {
		$ctrl->rule('required','REQUIRED');
	}
}

$form->addSubmit("submit", "Send");


header('Content-Type: text/html; charset=utf-8');


if ($form->valid()){
	echo 'success';
	die;	
} 

echo $form;
echo "<hr/>";
echo htmlspecialchars($form);
echo "<hr/>";
// var_dump($form->data());



?>
