$(document).ready(function () {
	// override jquery validate plugin defaults
	highlight_errors_validate();
	// Setup form validation on the #register-form element
	$("#reset_password_form").validate({
		// Specify the validation rules
		rules: {
			password: {
				required: true,
				minlength: 6
			},
			confirm_password:{
				required: true,
				equalTo: '#password'
			}
		},

	//     // Specify the validation error messages
	messages: {

		password: {
			required: 'Password is required',
			minlength: 'The password should be of minimum 6 characters.',
		},
		confirm_password: {
			required: 'Confirm password is required',
			equalTo: 'The confirm password should match password.',
		}

	},

	submitHandler: function(form) {

			// waiting for server response.

			$('#password_error').empty();
			
			$('#confirm_password_error').empty();


			$('#reset_password_form_error').html(
				'<div class="alert alert-success col-sm-8">Resetting password...</div><br>');  


			$.ajax({  
				type: 'POST',
				url: $(form).attr('action'),
				data: $(form).serialize(),
				dataType : 'json',
				success: function(data) {

					// set all errors to empty tag.
					// console.log("Resetting errrors.");
					
					if (data.success)
					{

						$('#reset_password_form_error').html(
							'<div class="alert alert-success col-sm-8">Password changed successfully.</div><br>');  

						setTimeout(function(){
							$('#reset_password_form_error').empty();
							window.location = 'home';

						},3000);

					}
					else
					{
						if ( data.message != null )
						{
							$('#reset_password_form_error').html(
								'<div class="alert alert-error col-sm-8">'+ data.message+'</div><br>');  

						}
						else
						{

							
							if ( data.password != "" && data.password != null)
								$('#password_error').html(
									'<div class="alert alert-danger col-sm-8">' + data.password + '</div><br>');

							if ( data.confirm_password != "" && data.confirm_password != null)
								$('#confirm_password_error').html(
									'<div class="alert alert-danger col-sm-8">' + data.confirm_password + '</div><br>');

						}
					}

				},
				error: function(data) {
					console.log(data);
				}
			});
			return false;
		},
	});




});


