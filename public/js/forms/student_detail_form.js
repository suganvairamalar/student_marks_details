$(document).ready(function(){	

    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


   

    

	$( "#reset").click(function() {     
	   
	    $('#student_name').val('');	    
	    
	    location.reload(true);
    });	

	$('#student_detail_form').on('click','#student_action_button',function(e){
		e.preventDefault();
		 if($('#student_action').val()=='ADD'){
				/*alert("Hi");
				return;*/
				 $.ajax({
		            url:'/student_detail_add_data',
		            method:'GET',
		            data:$('#student_detail_form').serialize(),
		            dataType:"json",
		            success:function(data)
		              {
		               /* console.log(data);
		            return;*/
		               var html = '';
		                  if(data.errors){
		                    html = '<div class="alert alert-danger">';
		                    for(var count = 0; count < data.errors.length; count++){
		                      html += '<p>' + data.errors[count] + '</p>';
		                      }
		                      html += '</div>';
		                    }
		                    if(data.success){
		                    html = '<div class="alert alert-success">' + data.success + '</div>';
		                    //$('#position_form')[0].reset();
		                    //$("#position_form").trigger("reset");
		                    location.reload(true);
		                  }
		                  $('#student_detail_form_result').html(html);
		              }
          	});
		 }

		 if($('#student_action').val()=='UPDATE'){
				/*alert("Hi");
				return;*/
				 $.ajax({
		            url:'/student_detail_update_data',
		            method:'POST',
		            data:$('#student_detail_form').serialize(),
		            dataType:"json",
		            success:function(data)
		              {
		               /* console.log(data);
		            return;*/
		               var html = '';
		                  if(data.errors){
		                    html = '<div class="alert alert-danger">';
		                    for(var count = 0; count < data.errors.length; count++){
		                      html += '<p>' + data.errors[count] + '</p>';
		                      }
		                      html += '</div>';
		                    }
		                    if(data.success){
		                    html = '<div class="alert alert-success">' + data.success + '</div>';
		                    //$('#position_form')[0].reset();
		                    //$("#position_form").trigger("reset");
		                    location.reload(true);
		                  }
		                  $('#student_detail_form_result').html(html);
		              }
          	});
		 }
	});

	$(document).on('click','.edit',function(){
		var id = $(this).attr('id');
		$('#student_detail_form_result').html('');
		$.ajax({
			url:'/student_detail_edit_data/'+id,
			dataType:"json",
			success:function(html){
				
				
				$('#student_name').val(html.data.student_name);				
       
				$('#hidden_id').val(html.data.id);
        
    		$('.header_student_detail_form panel-heading').text("STUDENT EDIT FORM");          
     		$('#student_action_button').val("UPDATE");
     		$('#student_action').val("UPDATE");
     		$('#student_action_button').removeClass('btn btn-success').addClass('btn btn-warning');  
			}
		});
	});


 var student_detail_id;
  $(document).on('click', '.delete', function(){
    /*alert("DELETE");
    return;*/
      student_detail_id = $(this).attr('id');
      $('#student_detail_confirm_Modal').modal('show');      
  });

  $('#student_detail_ok_button').click(function(){
        $.ajax({
          url:'/student_detail_delete_data/'+student_detail_id,
          beforeSend:function(){
            $('#student_detail_ok_button').text('Deleting.....');
            },
            success:function(data){
              setTimeout(function(){
                $('student_detail_confirm_Modal').modal('hide');
                location.reload();
              }, 2000);
            }
        });
  });

  //SEARCH DROPDOWN
  $(document).on("change",'#search_dropdown',function(){
    var select_value = $('#search_dropdown option:selected').val();
      //alert(select_value);
     
      if(select_value=='student_name'){
        $('#search').attr('placeholder','Search By Name');
      }
      else{
        $('#search').attr('placeholder','');
      }
  });

  

   $('#student_detail_search_submit').on('click',function(){

            var _token = $('#token').val();
            $value = $('#search').val();
            $search_dropdown = $('#search_dropdown option:selected').val();
            /*alert($search_dropdown);
            return;*/
            if($search_dropdown == "")
            {
            $('#search_dropdown').focus();
            alert("Please select");
            return false;
            }

            if(($search_dropdown!='') && ($value=='')){
              $('#search').focus();
              alert("Please enter to search");
              return false;
            }
           
            
            $.ajax({
               type:'GET',
               url:'/student_details',
               data:{'search_dropdown':$search_dropdown,'search':$value,_token:_token},
               success: function(data){
                console.log(data);
               }
            });
   });



   


});