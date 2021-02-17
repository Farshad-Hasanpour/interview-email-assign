<?php
spl_autoload_register(function ($class_name){
	$class_name = str_replace("\\", "/", $class_name);
	require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $class_name . ".php";
});
use php_class\User;
$user_obj = new User();

$assignments = $user_obj->get_all_assignments();
if(!is_array($assignments)){
	$assignments = array('0' => FALSE);
}
echo json_encode($assignments);
