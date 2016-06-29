$(document).ready(function () {
    // Setup form validation on the #register-form element
    $("#register_form").validate({
        // Specify the validation rules
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            mobileno: {
                required: true,
                // exactlength: 10
            },
            password: {
              required: true,
              minlength: 6
          },
          confirm_password:{
            required: true,
            equalTo: '#password'
        }
    },

        // Specify the validation error messages
        messages: {
            name:"Please enter your name.",
            email: {
                required: 'Email address is required',
                email: 'Please enter a valid email address',
            },
            mobileno: {
                required: 'Mobile number is required',
                // exactlength: 'The mobile number should be of 10 characters.',
            },
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
        	console.log("Making an ajax call.");
        	$.ajax({  
        		type: 'POST',
        		url: $(form).attr('action'),
        		data: $(form).serialize(),
        		dataType : 'json',
        		success: function(data) {
        			if (data.success)
        			{
        				if ( data.email != null )
                        {
                            console.log("verification link has been sent to " + data.email);
                        }
                        else
                        {
                            console.log("Unable to send verification link." + data.email);
                        }
                    }
                    else 
                    {
                        if ( data.message != null )
                        {
                           $('#form_error').text(data.message);
                        }
                       else
                       {
                           $('#email_error').text(data.email);
                           $('#name_error').text(data.name);
                           $('#password_error').text(data.password);
                           $('#confirm_password_error').text(data.confirm_password);
                           $('#mobileno_error').text(data.mobileno);
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


