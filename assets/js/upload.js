$(document).ready(function () {
    highlight_errors_validate();

    
    // Setup form validation on the #upload-form element
    $("#upload_form").validate({
        // Specify the validation rules
        rules: {
            image: {
                required: true
            }
        },
        
        // Specify the validation error messages
        messages: {
            image: "Please select an image!"
        },
        
        submitHandler: function(form) {
            $('#upload_error').html(
                '<div class="alert alert-info col-sm-8">Uploading....</div><br>');  

            var formData = new FormData();
            formData.append('image', $('input[type=file]')[0].files[0]);

            $.ajax({  
                type: 'POST',
                url: $(form).attr('action'),
                data: formData,
                enctype: 'multipart/form-data',
                dataType : 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(data) 
                {

                    if (data.success)
                    {
                        $('#upload_error').html(
                            '<div class="alert alert-success col-sm-8">Image has been uploaded.</div><br>');  

                        setTimeout(function(){
                            $('#upload_error').empty();
                            window.location.href = "./login";
                        },3000);

                    }
                    else 
                    {
                        $('#upload_error').html(
                            '<div class="alert alert-danger col-sm-8">' + data.message + '</div><br>');
                    }
                },
                error: function(data) 
                {
                    console.log(data);
                    $('#upload_error').html(
                        '<div class="alert alert-danger col-sm-8">Something went wrong.</div><br>');
                }
            });
            return false;
        },
    });

// user has been skipped the upload image. Redirect him to a login page.
$('#skip_upload').click(function () {
    window.location.href = "login";
});

});






