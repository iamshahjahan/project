$(document).ready(function () {


    // override jquery validate plugin defaults
    highlight_errors_validate();

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
                minlength: 10,
                maxlength: 10
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

    //     // Specify the validation error messages
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
         $.ajax({  
          type: 'POST',
          url: $(form).attr('action'),
          data: $(form).serialize(),
          dataType : 'json',
          success: function(data) {

                    // set all errors to empty tag.
                    console.log("Resetting errrors.");
                    $('#form_error').empty();
                    $('#password_error').empty();
                    $('#name_error').empty();
                    $('#email_error').empty();
                    $('#mobileno_error').empty();
                    $('#confirm_password_error').empty();

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
                         $('#form_error').html(
                            '<div class="alert alert-danger col-sm-8">' + data.message + '</div><br>');
                     }
                     else
                     {
                        if ( data.email != "" && data.email != null  )
                         $('#email_error').html(
                            '<div class="alert alert-danger col-sm-8">' + data.email + '</div><br>');

                     if ( data.name != "" && data.name != null)
                         $('#name_error').html(
                            '<div class="alert alert-danger col-sm-8">' + data.name + '</div><br>');

                     if ( data.password != "" && data.password != null)
                         $('#password_error').html(
                            '<div class="alert alert-danger col-sm-8">' + data.password + '</div><br>');

                     if ( data.confirm_password != "" && data.confirm_password != null)
                         $('#confirm_password_error').html(
                            '<div class="alert alert-danger col-sm-8">' + data.confirm_password + '</div><br>');

                     if ( data.mobileno != "" && data.mobileno != null )
                         $('#mobileno_error').html(
                            '<div class="alert alert-danger col-sm-8">' + data.mobileno + '</div><br>');
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


