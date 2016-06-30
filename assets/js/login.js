$(document).ready(function () {
    highlight_errors_validate();

    
    // Setup form validation on the #register-form element
    $("#forgotpassword_form").validate({
        // Specify the validation rules
        rules: {
            forgotpassword_email: {
                required: true,
                email: true
            }
        },
        
        // Specify the validation error messages
        messages: {
            forgotpassword_email: "Please enter a valid email address",
        },
        
        submitHandler: function(form) {
            $.ajax({  
                type: 'POST',
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType : 'json',
                success: function(data) 
                {
                    console.log("success.")
                    $('#forgotpassword_error').empty();

                    if (data.success)
                    {
                        $('#forgotpassword_error').html(
                            '<div class="alert alert-success col-sm-8">Email has been sent. Please reset your password.</div><br>');  

                        setTimeout(function(){
                            $('#forgotpassword_error').empty();
                            $('#forgotpasswordModal').modal('hide');
                        },3000);

                    }
                    else 
                    {
                        $('#forgotpassword_error').html(
                            '<div class="alert alert-danger col-sm-8">' + data.message + '</div><br>');
                    }
                },
                error: function(data) 
                {
                    console.log(data);
                }
            });
            return false;
        },
    });

    // now validate and send ajax request for forgot password form

    // Setup form validation on the #register-form element
    $("#login_form").validate({
        // Specify the validation rules
        rules: {
            password: "required",
            email: {
                required: true,
                email: true
            }
        },
        
        // Specify the validation error messages
        messages: {
            password: "Please enter your password",
            email: "Please enter a valid email address",
        },
        
        submitHandler: function(form) {
            console.log("Making an ajax call.");
            $.ajax({  
                type: 'POST',
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType : 'json',
                success: function(data) {

                    $('#form_error').empty();
                    $('#password_error').empty();
                    $('#email_error').empty();

                    if (data.success)
                    {
                        // login is successful. Redirect from here to home.
                        window.location.href = "home";

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

                       if ( data.password != "" && data.password != null  )
                         $('#password_error').html(
                            '<div class="alert alert-danger col-sm-8">' + data.password + '</div><br>');

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




