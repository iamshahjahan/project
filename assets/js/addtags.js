//this file is to add tags to the various fields of the form elements

	var i = 1;
$('#addTag').click(function (e) {
	i++;
	console.log("Add tag is clicked.");
	$('#tags').append("<input type='text' name='tag" + i + "' />");

	e.preventDefault();  
});