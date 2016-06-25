$('#answer_submit').click(function (e) 
{
	console.log("I am in post answer.");
	var answer = $('#answer').val();
	var q_id = $('#q_id').val();
	var user_id = $('#user_id').val();

	// now make ajax call

	$.ajax
	({
		type: "POST",
		url : $('#post_answer').attr('action'),
		data:{answer:answer,q_id:q_id,user_id:user_id},


		success:function(response)
		{
			console.log(response);
		},
		error:function(response)
		{
			console.log(response)
		}


	});

	e.preventDefault();
});