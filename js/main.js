$(document).ready(function(){
	// Setting links
	var ajax_assign_email_link = "../ajax/assign_email.php";
	var ajax_get_email_link = "../ajax/get_email.php";
	var ajax_delete_assignment_link = "../ajax/delete_assignment.php";
	var ajax_edit_assignment_link = "../ajax/edit_assignment.php"
	
	//initiate
	initiation_function();

	// Event Listeners
	$('#assign_email_form').on('submit' , assign_email);
	$('#alert').on('click', '#hide-alert', hide_alert);
	$('#data-container').on('click', '.edit-action', edit_assignment);
	$('#data-container').on('click', '.edit-cancel', reset_rows_view);
	$('#data-container').on('click', '.edit-save', save_assignment_edit);
	$('#data-container').on('click', '.delete-action', delete_assignment);


	//Functions
	function assign_email(e){
		e.preventDefault();
		var email = $('input#email').val().toLowerCase();
		var firstname = $('input#firstname').val();
		var lastname = $('input#lastname').val();
		$('input#email').val("");
		$('input#firstname').val("");
		$('input#lastname').val("");
		reset_rows_view();
		if(!email || !firstname || !lastname){
			show_alert('هیچ کدام از ورودی ها نباید خالی باشند.', false);
			return;
		}
		var data = {email: email, firstname: firstname, lastname: lastname};
		$.ajax({
			method: "post",
			url: ajax_assign_email_link,
			data: data
		}).done(function(data){
			var json_obj = JSON.parse(data);
			if(json_obj['show_message'] === true ){
				show_alert(json_obj['assign_email_message'], json_obj['success']);
			}

			// update data if Successfuly data is added to database
			if(json_obj['success'] === true){
				add_html_row(email, firstname, lastname, json_obj['id']);
			}
		}).fail(function(){
			show_alert('متاسفانه خطایی رخ داده است.', false);
		});
	}

	function show_assignments(){
		$.get({
			url: ajax_get_email_link
		}).done(function(data){
			var json_obj = JSON.parse(data);
			$.each(json_obj, function(index, value){
				add_html_row(value['1'], value['2'], value['3'], value['0']);
			});
		});
	}

	function delete_assignment(){
		var $self = $(this);
		var id = $self.parent().attr('data-user-id');
		var data = {id: id};
		$.ajax({
			url: ajax_delete_assignment_link,
			method: "post",
			data: data
		}).done(function(data){
			var json_obj = JSON.parse(data);
			if(json_obj['show_message'] === true ){
				show_alert(json_obj['delete_assignment_message'], json_obj['success']);
			}

			// Remove deleted row
			if(json_obj['success'] === true ){
				$self.closest('.row').remove();
			}
		}).fail(function(){
			show_alert('متاسفانه خطایی رخ داده است.', false);
		});
	}

	function edit_assignment(){
		reset_rows_view();
		// Set View of that row
		var $thisRow = $(this).closest('.row');
		$thisRow.addClass('editing-state');
		$thisRow.find('.read-only').css({display: 'none'});
		$thisRow.find('.read-write').css({display: 'block'});
	}

	function reset_rows_view(){
		// Reset View
		var $thisRow = $('.editing-state');
		var unchangedEmail;
		var unchangedFirstname;
		var unchangedLastname;
		$.each($thisRow, function(index, value){
			unchangedEmail = $(value).find('.email-show').html();
			unchangedFirstname = $(value).find('.firstname-show').html();
			unchangedLastname = $(value).find('.lastname-show').html();
			// Reset input values
			$(value).find('input.email-edit').val(unchangedEmail);
			$(value).find('input.firstname-edit').val(unchangedFirstname);
			$(value).find('input.lastname-edit').val(unchangedLastname);
		});
		$thisRow.find('.read-write').css({display: 'none'});
		$thisRow.find('.read-only').css({display: 'block'});
		$thisRow.removeClass('editing-state');
	}

	function save_assignment_edit(){
		var $self = $(this);
		var $thisRow = $self.closest('.row');
		var id = $self.closest('.edit-show').attr('data-user-id');
		var newEmail = $thisRow.find('input.email-edit').val();
		var newFirstname = $thisRow.find('input.firstname-edit').val();
		var newLastname = $thisRow.find('input.lastname-edit').val();
		var unchangedEmail = $thisRow.find('.email-show').html();
		var unchangedFirstname = $thisRow.find('.firstname-show').html();
		var unchangedLastname = $thisRow.find('.lastname-show').html();

		if(newEmail == unchangedEmail && newFirstname == unchangedFirstname && newLastname == unchangedLastname){
			show_alert('هیچ داده ای تغییر نکرده است.', false);
			return;
		}
		if(!newEmail || !newFirstname || !newLastname){
			show_alert('هیچ کدام از ورودی ها نباید خالی باشند.', false);
			return;
		}
		var data = {
			id: id,
			email: newEmail,
			firstname: newFirstname,
			lastname: newLastname
		};

		$.ajax({
			url: ajax_edit_assignment_link,
			method: "post",
			data: data
		}).done(function(data){
			var json_obj = JSON.parse(data);
			if(json_obj['show_message'] === true ){
				show_alert(json_obj['edit_email_message'], json_obj['success']);
			}

			// update data if Successfuly data is added to database
			if(json_obj['success'] === true){
				add_html_row(newEmail, newFirstname, newLastname, id, true, $thisRow);
			}

		}).fail(function(){
			show_alert('متاسفانه خطایی در ویرایش داده رخ داده است.', false);
		});
	}

	function add_html_row(email, firstname, lastname, id, isUpdate = false, $updatingRow = false){
		var row_html = 
		'<div class="row email-assignment-row" >' + 
			'<div class="col-5 email-show read-only">' + email + '</div>' + 
			'<div class="col-3 firstname-show read-only">' + firstname + '</div>' + 
			'<div class="col-3 lastname-show read-only">' + lastname + '</div>' + 
			'<div class="col-1 action-show read-only" data-user-id="' + id + '">' +
				'<span class="edit-action" title="ویرایش"><i class="fas fa-pencil-alt"></i></span>' + 
				'<span class="delete-action" title="حذف کردن"><i class="fas fa-trash-alt"></i></span>' + 
			'</div>' +
			// Edit Section 
			'<div class="col-5 read-write"><input class="email-edit" value="' + email + '" style="width:95%;"></div>' + 
			'<div class="col-3 read-write"><input class="firstname-edit" value="' + firstname + '" style="width:95%;"></div>' + 
			'<div class="col-3 read-write"><input class="lastname-edit" value="' + lastname + '" style="width:95%;"></div>' + 
			'<div class="col-1 edit-show read-write" data-user-id="' + id + '">' +
				'<span class="edit-save" title="ذخیره"><i class="fas fa-save"></i></span>' + 
				'<span class="edit-cancel" title="لغو"><i class="fas fa-times"></i></span>' + 
			'</div>' + 
		'</div>';

		// New row OR Update current row?
		if(!isUpdate){
			$(row_html).prependTo('#data-container');
		}else{
			$updatingRow.replaceWith(row_html);
		}
		
	}

	function show_alert(message, success = false){
		message += '<span id="hide-alert" style="margin-right:30px;"><i class="fas fa-times"></i></span>';
		$alert = $('#alert');
		if(success === false){
			$alert.html(message).css({display: 'block'}).addClass('alert-danger').removeClass('alert-success');
		}else{
			//$(message).prependTo('#alert');
			$alert.html(message).css({display: 'block'}).addClass('alert-success').removeClass('alert-danger');
		}	
	}

	function hide_alert(){
		$(this).closest('#alert').css({display: 'none'});
	}

	function initiation_function(){
		show_assignments();
	}
});