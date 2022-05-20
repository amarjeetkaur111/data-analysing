// <----------------Phone Number Pattern-------------->

    $('input[type=tel]').keyup(function(){
      $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'))
    });
    
// <----------------Phone Number Pattern-------------->

   $(document).ready(function () {
		$(".nav.nav-tabs li a[href*=admin]").addClass("active"); 
		$('#admin_table').DataTable();	
		$('#pharmacy_table').DataTable();	
    });


// <----------------Admin User-------------->

  $(document).on('click','#deleteadmin',function(){
		var element = $(this);
		var del_id = element.attr("data-id");
		var name = element.attr("data-name");
		var id = del_id;

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
					url:"/administration/users/delete_user/"+id,
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


    $('body').on('click', '#edit_admin', function (event)
   {
		event.preventDefault();
		var id = $(this).data('id');
		$.get('/administration/users/edit_user/'+ id, function (data) {        
			$('#edit_admin_modal').modal('show');
			$('#EditId').val(id);
			$('#EditAdminFirstName').val(data.data.FirstName);
			$('#EditAdminLastName').val(data.data.LastName); 
			$('#EditAdminEmail').val(data.data.Email);
			$('#EditAdminPhoneNumber').val(data.data.PhoneNumber);
		})
  });
// <----------------Admin User Ends-------------->

// <----------------Pharmacy Delete-------------->

$(document).on('click','#deletepharmacy',function(){
      var element = $(this);
      var del_id = element.attr("data-id");
      var name = element.attr("data-name");
      var id = del_id;

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
            url:"/administration/pharmacies/delete_pharmacy/"+id,
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
// <----------------Pharmacy Delete End-------------->

// <--------------------Pharmacy Edit----------------->
   $('body').on('click', '#edit_pharmacy', function (event)
   {
      event.preventDefault();
      var id = $(this).data('id');
      $.get('/administration/pharmacies/edit_pharmacy/'+ id, function (data) {        
         $('#edit_pharmacy_modal').modal('show');
         $('#EditPharmacyId').val(id);
         $('#EditPharmacyName').val(data.data.PharmacyName);
         $('#EditPharmacyAddress').val(data.data.PharmacyAddress);
         $('#EditPharmacyManager').val(data.data.ManagerName);
         $('#EditPharmacyPhone').val(data.data.PhoneNumber);
       })
  });

// <--------------------Pharmacy Edit End----------------->