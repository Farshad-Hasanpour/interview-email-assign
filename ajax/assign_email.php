<?php
spl_autoload_register(function ($class_name){
	$class_name = str_replace("\\", "/", $class_name);
	require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $class_name . ".php";
});
use php_class\User;
use php_class\Validation;

function handle_assign_email_request(){
	if(!isset($_POST) || !isset($_POST['email'])){
		return array('success' => FALSE, 'id' => 0, 'show_message' => FALSE, 'assign_email_message' => '');
	}
	$user_obj = new User();
	$validation_obj = new Validation();
	$_post = $_POST;
	$_post = $validation_obj->validate_assign_email($_post);
	if(!$_post){
		//Error at validating data
		return array('success' => FALSE, 'id' => 0, 'show_message' => TRUE, 'assign_email_message' => "خطایی در اعتبار سنجی داده ها رخ داده است");
	}

	if(!$user_obj->assign_email($_post['firstname'], $_post['lastname'], $_post['email'])){
		// Error in model side
		return array('success' => FALSE, 'id' => 0, 'show_message' => TRUE, 'assign_email_message' => $user_obj->getErrorMessage());
	}

	// email is assigned
	return array('success' => TRUE, 'id' => $user_obj->getErrorMessage(), 'show_message' => TRUE, 'assign_email_message' => "ایمیل شما با موفقیت ثبت شد");
	
}

$result = handle_assign_email_request();
echo json_encode($result);
