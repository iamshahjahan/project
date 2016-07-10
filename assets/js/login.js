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
            $('#forgotpassword_error').empty();
            $('#forgotpassword_error').html(
                '<div class="alert alert-info col-sm-8">Sending reset password link....</div><br>');  


            $.ajax({  
                type: 'POST',
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType : 'json',
                success: function(data) 
                {

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
                        // if is_active is zero, means user is not activated yet. 
                        if ( !data.is_active)
                        {
                           $('#resend_div').html(
                            '<div class="alert alert-danger col-sm-8">You have not verified the link sent to you.' +
                            'Verify the login link sent to you.' +
                            'Click the button to resend, if you are unable to verify.'+
                            ' <button class="btn btn-success" id="resend_link">Send</button></div><br>');


                       }
                       else
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


    $("#resend_div").delegate("#resend_link", "click", function (){

       $('#resend_div').html(
        '<div class="alert alert-info col-sm-8">Sending link....</div><br>');

       $.ajax
       ({
        url: "verifyregister/resend_verification_mail",
        type:"POST",
        dataType:"json",

        success: function(data)
        {
           if ( data.success )
           {
            $('#resend_div').html(
                '<div class="alert alert-success col-sm-8">Link sent successfully. Please verify.</div><br>');
        }

    },

    error: function(data)
    {
        console.log(data)
    },
});
       return false; 


   });
});




