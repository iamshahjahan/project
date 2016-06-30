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

            // waiting for server response.

            $('#form_error').empty();
            $('#password_error').empty();
            $('#name_error').empty();
            $('#email_error').empty();
            $('#mobileno_error').empty();
            $('#confirm_password_error').empty();


            $('#form_error').html(
                '<div class="alert alert-success col-sm-8">Regiseration going on......</div><br>');  


            $.ajax({  
              type: 'POST',
              url: $(form).attr('action'),
              data: $(form).serialize(),
              dataType : 'json',
              success: function(data) {

                    // set all errors to empty tag.
                    console.log("Resetting errrors.");
                    
                    if (data.success)
                    {
                        if ( data.email != null )

                        {                          
                            $('#form_error').html(
                                '<div class="alert alert-success col-sm-8">Registeration successful. Please verify your email by click a link sent to you.</div><br>');  

                            setTimeout(function(){
                                $('#form_error').empty();
                                window.location = 'upload';

                            },3000);

                        }
                        else
                        {
                            // console.log("" + data.email);
                            $('#form_error').html(
                                '<div class="alert alert-success col-sm-8">Unable to send verification link. Please try later.</div><br>');  

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
                        $('#form_error').empty();
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


