<?php
namespace php_class;
class Validation{

	public function validate_assign_email($_post){
	//validation of $_post array
	foreach($_post as $key => $value){
	$_post[$key]=trim($value);
	}
	if(!isset($_post['email'])){
	$_post['email'] = '';
	}
	if(!isset($_post['firstname'])){
	$_post['firstname'] = '';
	}
	if(!isset($_post['lastname'])){
	$_post['lastname'] = '';
	}
	if(
	($_post['email']=='') || 
	($_post['email']!='' && !filter_var($_post['email'],FILTER_VALIDATE_EMAIL)) || 
	($_post['email']!=''&&is_numeric($_post['email'])) || 
	($_post['email']!=''&&strlen($_post['email'])<5) || 
	($_post['email']!=''&&strlen($_post['email'])>255) || 
	($_post['firstname']=='') || 
	($_post['firstname']!=''&&is_numeric($_post['firstname'])) || 
	($_post['firstname']!=''&&strlen($_post['firstname'])<3) || 
	($_post['firstname']!=''&&strlen($_post['firstname'])>63) || 
	($_post['lastname']=='') || 
	($_post['lastname']!=''&&is_numeric($_post['lastname'])) || 
	($_post['lastname']!=''&&strlen($_post['lastname'])<3) || 
	($_post['lastname']!=''&&strlen($_post['lastname'])>63)
	){
	return false;
	}
	$_post['email']=strtolower($_post['email']);
	return $_post;
	}
}

