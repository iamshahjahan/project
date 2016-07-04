$(document).ready(function () {
	highlight_errors_validate();


    // Setup form validation on the #register-form element
    $("#answer_form").validate({
        // Specify the validation rules
        rules: {
        	answer: {
        		required: true,
        		minlength: 50
        	}
        },
        
        // Specify the validation error messages
        messages: {
        	answer: "Please enter at least 50 characters.",
        },
        
        submitHandler: function(form) {
        	$.ajax({  
        		type: 'POST',
        		url: $(form).attr('action'),
        		data: $(form).serialize(),
        		dataType : 'json',
        		success: function(data) {

        			$('#answer_error').empty();


        			if (data.success)
        			{
                        console.log(data);
						// location.reload();             
        			}
        			else 
        			{
        				if ( data.message != null )
        				{
        					$('#answer_error').html(
        						'<div class="alert alert-danger col-sm-8">' + data.message + '</div><br>');

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




