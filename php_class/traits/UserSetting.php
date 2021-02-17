<?php
namespace php_class\traits;
trait UserSetting{
	protected $user_table_name = "user";
	protected $user_id_col_name = "user_id";
	protected $user_email_col_name = "user_email";
	protected $user_firstname_col_name = "user_firstname";
	protected $user_lastname_col_name = "user_lastname";
}