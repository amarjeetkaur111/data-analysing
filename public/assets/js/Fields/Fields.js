$(document).ready(function(){
	$('#field_table').DataTable();	
});

/*----------------On Category Select load Fields in table Category Wise---------*/
$(document).on('change','#Category',function(){
	var SelectedCategory=$('#Category option:selected').val();
	var html_content='';
	var num=1;
	var fields_table = $('#field_table').DataTable();	
		$.ajax({
			url:"/fields/fetch_fields/"+SelectedCategory,
			data:'',
			type:'get',
			datatype:'JSON',
			success:function(result)
			{
				fields_table.destroy();
				$("#fields_list").empty();
				for(i=0;i<result.data.length;i++)
				{
					html_content+='<tr>';
					html_content+='<td>'+num+'</td>';
					html_content+='<td>'+result.data[i]['FieldTitle']+'</td>';
					html_content+='<td><a href="" id="edit_field" data-toggle="modal" data-target="#edit_field_modal" data-field-id="'+result.data[i]['id']+'"><i class="icon-item fas fa-user-edit" role="button" data-prefix="fas" data-id="" data-unicode="f4ff" data-mdb-original-title="" title=""></i></a></td>';
					html_content+='<td><a href="javascript:void(0);" data-name="'+result.data[i]['FieldTitle']+'" data-field-id="'+result.data[i]['id']+'" id="deletefield"><i class="icon-item fas fa-trash-alt" role="button" data-prefix="fas" data-id="trash-alt" data-unicode="f2ed" data-mdb-original-title="" title=""></i></a></td>';
					html_content+='</tr>';
					num++;
				}
				
				$("#fields_list").append(html_content);
				$('#field_table').DataTable({
					'pageLength':10,
					'order':[],
					language: {
						searchPlaceholder: "Search Fields in List"
					}
				});				
			},
			}).fail(function (jqXHR, textStatus, error) {
				Swal.fire('Something Went Wrong!','Try Again','fail');
			});
});
/*----------------------End--------------------------------*/
/*---------------------Fetch Field Details and load in editable form------------*/
$(document).on('click','#edit_field',function(){
		event.preventDefault();
		var fieldid = $(this).attr('data-field-id');
		$.get('/fields/edit_field/'+ fieldid, function (data) {   
			$('#EditFieldName').val(data.data.FieldTitle); 
			$('#editfield_id').val(fieldid);
			$('#EditCategoryName option:selected').removeAttr('selected');
			$('#EditCategoryName option[value='+data.data.CategoryID+']').attr('selected','selected');
		})
});
/*-------------------------End---------------------------------------------*/

/*----------------------Delete Field--------------------------------------*/
$(document).on('click','#deletefield',function(){
      var element = $(this);
      var id = element.attr("data-field-id");
      var name = element.attr("data-name");
		
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete the record of "+name+" ?",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        preConfirm: false
      }).then((result) => {
      if (result.isConfirmed) 
      {
          $.ajax({
            url:"/fields/delete_field/"+id,
            data:'',
            type:'get',
            success:function($result)
            {
              Swal.fire('Deleted!','Record has been deleted.','success');
            }
          });
          $(this).parents("tr").animate({ backgroundColor: "#003" }, "slow")
           .animate({ opacity: "hide" }, "slow");
      }else{
        return false;
      }
    });  
  });