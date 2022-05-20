$(document).ready(function () {
    $('#category_table').DataTable();
});

// <!-----------------------Edit Category------------------>
$(document).on('click','#edit_category', function(){
    event.preventDefault();
    var id = $(this).data('id');
    $.get('/category/edit_category/'+ id, function (data) {        
		$('#edit_category_modal').modal('show');
		$('#EditId').val(id);
		$('#EditCategoryName').val(data.data.CategoryName);
    })
});

// <!-------------------Edit Category End------------------>

// <!-------------------Delete Category------------------>
$(document).on('click','#deletecategory', function(){
	var element=$(this);
	var catid=element.attr('data-id');
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
					url:"/category/delete_category/"+catid,
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
// <!-------------------Delete Category End------------------>