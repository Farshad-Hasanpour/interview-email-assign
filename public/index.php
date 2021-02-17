<?php
spl_autoload_register(function ($class_name){
	$class_name = str_replace("\\", "/", $class_name);
	require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $class_name . ".php";
});

require_once '../setting.php';
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $description; ?>">
    <meta name="keyword" content="<?= $keyword; ?>">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= $bootstrap_css_link; ?>">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?= $main_css_link; ?>">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Favicon Link -->
    <link rel="shortcut icon" href="<?= $favicon_link; ?>" >
	<title><?= $brand; ?></title>
</head>
<body>
<main class="container" style="margin-top: 20px;padding-top: 20px;padding-bottom: 20px;">

	<div class="alert" role="alert" id="alert"></div>

	<!-- Button trigger modal -->
	<button type="button" class="btn btn-success col-12" data-toggle="modal" data-target="#email-assign-modal">
		ایمیل خود را ثبت کنید.
	</button>

	<!-- Assign Email Modal -->
	<div class="modal fade" id="email-assign-modal" tabindex="-1" role="dialog" aria-labelledby="EmailAssignModalLabel" aria-hidden="true" dir="ltr">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" dir="rtl">
					<h5 class="modal-title" id="exampleModalLabel">ثبت ایمیل</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: auto;margin-left:0;">
				  		<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form name="assign_email_form" id="assign_email_form">
				<div class="modal-body" id="modal-body" dir="rtl">
					
						<div class="form-group">
						    <label for="email">ایمیل</label>
						    <input type="email" class="form-control" id="email" name="email"  placeholder="info@example.com" dir="ltr">
						</div>
						<div class="form-group">
						    <label for="firstname">نام</label>
						    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="نام">
						</div>
						<div class="form-group">
						    <label for="lastname">نام خانوادگی</label>
						    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="نام خانوادگی">
						</div>

					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
					<button id="assign-email" class="btn btn-primary">ثبت</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="row" style="color:blue;margin-top: 50px;">
		<div class="col-5 email-show" >ایمیل</div>
		<div class="col-3 firstname-show">نام</div>
		<div class="col-3 lastname-show">نام خانوادگی</div>
		<div class="col-1 action-show">کنترل</div>
	</div>
	<div id="data-container" style="direction: middle;">

	</div>
	
</main>

	<script src="<?= $jquery_js_link; ?>"></script>
    <script src="<?= $popper_js_link ?>"></script>
    <script src="<?= $bootstrap_js_link ?>"></script>
    <script src="<?= $main_js_link; ?>"></script>
</body>
</html>