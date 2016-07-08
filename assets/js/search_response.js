
// $(document).ready(function () {

// 	$('#addressSearch').click(function() {
// 		var input = $('#searchtext').val();

// 		$.ajax({
// 			type: "POST",
// 			url: "search_controller/quessearch",
// 			data: {'search':input},
// 			success: function(result) {
// 				console.log(result);
// 				$("#resultBox").html(result).show();
// 			}
// 		});
// 	});

// });

$('#search_user').on('keyup',
	function (e) {
		// e.preventDefault();

		var search_text = $('#search_user').val();
        // var text = $('#post-text').val();

        // alert("hello from keyup" + search_text);

         // alert(username);
         if (search_text !="")
         {
         	$.ajax(
         	{
         		url:$("#search_form").attr('action'),
         		type:'POST',
         		dataType:"json",
         		data: { search : search_text },
         		success:function(data)
         		{
                    var data_array = [];
                        console.log(data);
                    // if (data.success) {
                        $.each(data, function(i, item) 
                        {

                            data_array.push({value:window.location.origin +'/project/index.php/tag/get/'+item.id,label:item.tagname})
                         // // console.log(item['name']);
                         // var ap = '<li> <a href="tag/get/'+item.id +'">'+item.tagname+'</a></li>' ;
                         //   // $('#search_list').append(ap);
                         //   data_array.push(item.tagname);
                     });

                        $( "#search_user" ).autocomplete({
                            source: data_array,
                           select: function( event, ui ) { 
                            window.location.href = ui.item.value;
                        },
                    });


                    // }
                    // else
                    // {
                    //      $('#search_list').text("No results found.");   
                    // }


                },
                error : function(data) {
                    console.log(data);
                }
            }
            );
         }

     });