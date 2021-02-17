<?php
spl_autoload_register(function ($class_name){
	$class_name = str_replace("\\", "/", $class_name);
	require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $class_name . ".php";
});
use php_class\User;
use php_class\Validation;

function handle_edit_email_request(){
	if(!isset($_POST) || !isset($_POST['email'])){
		return array('success' => FALSE, 'id' => 0, 'show_message' => FALSE, 'edit_email_message' => '');
	}
	$user_obj = new User();
	$validation_obj = new Validation();
	$_post = $_POST;
	$_post['id'] = intval($_post['id']);
	$_post = $validation_obj->validate_assign_email($_post); // data for edition is almost same needed data to assign a new email
	if(!$_post){
		//Error at validating data
		return array('success' => FALSE, 'id' => 0, 'show_message' => TRUE, 'edit_email_message' => "خطایی در اعتبار سنجی داده ها رخ داده است");
	}

	if(!$user_obj->edit_assignment($_post['id'], $_post['firstname'], $_post['lastname'], $_post['email'])){
		// Error in model side
		return array('success' => FALSE, 'id' => 0, 'show_message' => TRUE, 'edit_email_message' => $user_obj->getErrorMessage());
	}

	// email is edited
	return array('success' => TRUE, 'id' => $user_obj->getErrorMessage(), 'show_message' => TRUE, 'edit_email_message' => "ایمیل شما با موفقیت به روز رسانی شد");
	
}

$result = handle_edit_email_request();
echo json_encode($result);

