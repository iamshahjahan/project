
var tag_id = $('#tag_id').val();
var user_id = $('#user_id').val();



$('#follow').click(
	function (e) {
		// calling ajax for lgoin verification

		$.ajax({

			type:"POST",
			url:$("#follows").attr("action"),
			data: {user_id : user_id,tag_id : tag_id},

			success: function(data) 
			{
				console.log(data);
				location.reload();
			},
			error: function(data)
			{
				console.log(data);
			}
		});

		e.preventDefault();
	});

$('#unfollow').click(
	function (e) {
		console.log("Un follow is clicked.");
		e.preventDefault();
		$.ajax({

			type:"POST",
			url:$("#follows").attr("action"),
			data: {user_id : user_id,tag_id : tag_id, unfollow : ""},

			success: function(data) 
			{

				console.log(data);
				location.reload(); 

			},
			error: function(data)
			{
				console.log(data);
			}


		});

	});

