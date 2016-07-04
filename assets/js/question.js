$(document).ready(function () {
    highlight_errors_validate();


    // function to add tags.


    var i = 1;


    $('#addTag').click(function (e) {
        i++;

// make sure that there is no empty field left there.

for (var j = 1; j < i ; j++) {
    var tag_ids = '#tag' + j;
    var is_empty_any_field = false;


    if ( !$(tag_ids).val())
    {
        i--;
        is_empty_any_field = true;
        break;
    }

}

    // console.log
    if ( !is_empty_any_field )
    {
        $("#tag_error").val('');
        $('#tags').append("<br><input type='text' class='form-control' placeholder='tag' id='tag" + i + "'' name='tag" + i + "' />");
    }
    else
        $('#tag_error').html("Please fill available fields to add extra fields.");
    e.preventDefault();  
});



    
    // Setup form validation on the #register-form element
    $("#question_form").validate({
        // Specify the validation rules
        rules: {
            title: {
                required: true,
            },

            description: {
                required: true,
            },
            tag1: {
                required: true,
            },

            
        },

        // Specify the validation error messages
        messages: {
            title: "Please give us a title.",
            description: "Please enter a description.",
            tag1:"Please enter a tag."
        },
        
        submitHandler: function(form) {
            $('#title_error').empty();
            $('#description_error').empty();
            $('#tag_error').empty();
            $('#question_form_error').html(

                '<div class="alert alert-info col-sm-8">Adding question..</div><br>');  


            $.ajax({  
                type: 'POST',
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType : 'json',
                success: function(data) 
                {
                   $('#question_form_error').empty();

                   console.log(data);
                   if (data.success)
                   {
                    $('#question_form_error').html(
                        '<div class="alert alert-success col-sm-8">Successfully inserted.</div><br>');  
                    location.reload();

                }
                else 
                {
                   if ( data.message != null )
                   {
                    $('#question_form_error').html(
                        '<div class="alert alert-danger col-sm-8">' + data.message + '</div><br>');

                }
                else
                {
                  if ( data.title != "" && data.title != null  )
                     $('#title_error').html(
                        '<div class="alert alert-danger col-sm-8">' + data.title + '</div><br>');

                 if ( data.description != "" && data.description != null  )
                   $('#description_error').html(
                    '<div class="alert alert-danger col-sm-8">' + data.description + '</div><br>');

               if ( data.tag1 != "" && data.tag1 != null  )
                   $('#tag1_error').html(
                    '<div class="alert alert-danger col-sm-8">' + data.tag1 + '</div><br>');

           }
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


});




