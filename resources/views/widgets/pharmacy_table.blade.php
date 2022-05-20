<style>
    #pharmacylist_wrapper{width:98%;}
</style>
<!-- Section: Table -->
<section>

<div class="card card-cascade narrower z-depth-0">
  <div
    class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 align-items-center">
    <!-- <div>
      <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i
          class="fas fa-th-large mt-0"></i></button>
      <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i
          class="fas fa-columns mt-0"></i></button>
    </div> -->
    <a href="" class="white-text mx-3">List Of Pharmacies</a>
    <!-- <div>
      <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i
          class="fas fa-pencil-alt mt-0"></i></button>
      <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i
          class="fas fa-eraser mt-0"></i></button>
      <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i
          class="fas fa-info-circle mt-0"></i></button>
    </div> -->
  </div>
  <div class="px-4">
    <div class="table-responsive">
      <!--Table-->
      <table id="pharmacylist" class="table table-hover table-striped" cellspacing="0" width="100%">
        <!-- Table head -->
        <thead>
          <tr>
            <th class="th-lg"><a>Name <i class="fas fa-sort ml-1"></i></a></th>
            <th class="th-lg"><a>Address<i class="fas fa-sort ml-1"></i></a></th>
            <th class="th-lg"><a>Phone Number<i class="fas fa-sort ml-1"></i></a></th>
            <th class="th-lg"><a>Manager Name<i class="fas fa-sort ml-1"></i></a></th>
          </tr>
        </thead>
        <!-- Table head -->

        <!-- Table body -->
        <tbody>
          @if($data)
            @foreach($data as $data)
          <tr>
            <td>{{$data['PharmacyName']}}</td>
            <td>{{$data['PharmacyAddress']}}</td>
            <td>{{$data['PhoneNumber']}}</td>
            <td>{{$data['ManagerName']}}</td>
          </tr>       
          @endforeach   
          @endif
        </tbody>
        <!-- Table body -->

      </table>
      <!-- Table -->

    </div>
    <hr class="my-0">
  </div>
</div>

</section>
<!--Section: Table-->
<script>
    $(document).ready(function() {
        $("#pharmacylist").DataTable();
    });
</script>