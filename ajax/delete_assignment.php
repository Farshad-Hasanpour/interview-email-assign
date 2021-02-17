<?php
spl_autoload_register(function ($class_name){
	$class_name = str_replace("\\", "/", $class_name);
	require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $class_name . ".php";
});
use php_class\User;

function handle_delete_assignment_request(){
	if(!isset($_POST) || !isset($_POST['id'])){
		// No Data Sent
		return array('success' => FALSE, 'show_message' => FALSE, 'delete_assignment_message' => '');
	}
	$user_obj = new User();
	if(!$user_obj->delete_assignment(intval($_POST['id']))){
		// Error at model side
		return array('success' => FALSE, 'show_message' => TRUE, 'delete_assignment_message' => $user_obj->getErrorMessage());
	}

	//Success
	return array('success' => TRUE, 'show_message' => TRUE, 'delete_assignment_message' => 'ایمیل مورد نظر حذف شد.');
}

echo json_encode(handle_delete_assignment_request());