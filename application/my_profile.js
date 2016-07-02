$(document).ready(function () {
    // override jquery validate plugin defaults
    highlight_errors_validate();
    // Setup form validation on the #register-form element
    $("#myprofile_form").validate({
        // Specify the validation rules
        rules: {
          name: "required",

          mobileno: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number:true
          },
          about: {
            required: true,
            minlength: 10
          }
        },

    //     // Specify the validation error messages
    messages: {
      name:"Please enter your name.",

      mobileno: {
        required: 'Mobile number is required',
        minlength: 'The mobile number should be of 10 characters.',
        minlength: 'The mobile number should be of 10 characters.',
      },

      about: {
        required: 'Please tell us something about yourself.',
        minlength: 'Don\'t be shy. Tell a few about yourself.',
      }

    },

    submitHandler: function(form) {

            // waiting for server response.

            $('#myprofile_form_error').empty();
            $('#name_error').empty();
            $('#email_error').empty();
            $('#mobileno_error').empty();
            $('#about_error').empty();


            $('#myprofile_form_error').html(
              '<div class="alert alert-success">Updating your profile....</div><br>');  


            $.ajax({  
              type: 'POST',
              url: $(form).attr('action'),
              data: $(form).serialize(),
              dataType : 'json',
              success: function(data) {

                    // set all errors to empty tag.
                    
                    if (data.success)
                    {
                      location.reload();
                    }
                    else 
                    {
                      if ( data.message != null )
                      {
                       $('#myprofile_form_error').html(
                        '<div class="alert alert-danger">' + data.message + '</div><br>');
                     }
                     else
                     {
                      $('#myprofile_form_error').empty();
                      if ( data.about != "" && data.about != null  )
                       $('#about_error').html(
                        '<div class="alert alert-danger">' + data.email + '</div><br>');

                     if ( data.name != "" && data.name != null)
                       $('#name_error').html(
                        '<div class="alert alert-danger">' + data.name + '</div><br>');


                     if ( data.mobileno != "" && data.mobileno != null )
                       $('#mobileno_error').html(
                        '<div class="alert alert-danger">' + data.mobileno + '</div><br>');
                   }
                 }
               },
               error: function(data) {
                $('#myprofile_form_error').html(
                  '<div class="alert alert-danger">Something went wrong. Please contact web admin.</div><br>');

                console.log(data);
              }
            });
            return false;
          },
        });




  });


