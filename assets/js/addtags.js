//this file is to add tags to the various fields of the form elements

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
		$('#tags').append("<br><input type='text' class='form-control' placeholder='tag' id='tag" + i + "'' name='tag" + i + "' />");
	else
		$('#tag_error').html("Please fill available fields to add extra fields.");
	e.preventDefault();  
});

// <input type="text" class="form-control" id="tag1" name="tag1" placeholder="tag" required autofocus>