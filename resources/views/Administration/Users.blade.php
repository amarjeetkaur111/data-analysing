 
@include('Common.Header')  
  @if($errors->AddAdmin->any())
    <script>
       $(function(){
           $('#add_admin_modal').modal('show');
       });
    </script>
  @enderror
  @if($errors->EditAdmin->any())
    <script>
       $(function(){
           $('#edit_admin_modal').modal('show');
       });
    </script>
  @enderror
@if($errors->AddPharmacy->any())
    <script>
       $(function(){
           $('#add_pharmacy_modal').modal('show');
       });
    </script>
  @enderror
  @if($errors->EditPharmacy->any())
    <script>
       $(function(){
           $('#edit_pharmacy_modal').modal('show');
       });
    </script>
  @enderror  
  <!-- Main Navigation  -->
  <!-- Main layout  -->
  <main class="user-list">
    <div class="container-fluid mb-5">
      <!-- Section: Basic examples -->
      <section>
        <!-- Gird column -->
        <div class="col-md-12">
          <h5 class="my-4 dark-grey-text font-weight-bold"></h5>
         <!-- Nav tabs -->
          <ul class="nav nav-tabs md-tabs nav-justified primary-color" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="true">Admins</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pharmacy-tab" data-toggle="tab" href="#pharmacy" role="tab" aria-controls="pharmacy" aria-selected="false">Pharmacies</a>
            </li>           
          </ul>
         <!-- Nav tabs Ends -->

          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="admin" role="tabpanel" aria-labelledby="admin-tab">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6"><h4>Admin Users</h4>
                    </div>
                    <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#add_admin_modal" >Add Admin</button>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <table id="admin_table" class="table table-striped" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($userdata as $data)
                      <tr>
                        <td>{{$data->UserId}}</td>
                        <td>{{$data->FirstName}} {{$data->LastName}}</td>
                        <td>{{$data->Email}}</td>
                        <td>{{$data->PhoneNumber}}</td>                    
                        <td><a href="" id="edit_admin" data-toggle="modal" data-target='#edit_admin_modal' data-id="{{encval($data->UserId)}}"><i class="icon-item fas fa-user-edit" role="button" data-prefix="fas" data-id="" data-unicode="f4ff" data-mdb-original-title="" title=""></i></a></td>

                        <td><a href="javascript:void(0);" data-name="{{$data->FirstName}} {{$data->LastName}}" data-id="{{encval($data->UserId)}}" id="deleteadmin"><i class="icon-item fas fa-trash-alt" role="button" data-prefix="fas" data-id="trash-alt" data-unicode="f2ed" data-mdb-original-title="" title=""></i></a></td>
                      </tr> 
                      @endforeach               
                    </tbody>
                    
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="pharmacy" role="tabpanel" aria-labelledby="pharmacy-tab">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6"><h4>Pharmacies</h4>
                    </div>
                    <div class="col-md-6 text-right">
                     <a><button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#add_pharmacy_modal" >Add Pharmacy</button></a>
                    </div>
                  </div>
                  <hr>
                  <table id="pharmacy_table" class="table table-striped" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Pharmacy Name</th>
                        <th>Address</th>
                        <th>Manager</th>
						            <th>Phone Number</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($pharmacy as $row)
                      <tr>
                        <td>{{$row->PharmacyID}}</td>
                        <td>{{$row->PharmacyName}}</td>
                        <td>{{$row->PharmacyAddress}}</td>
                        <td>{{$row->ManagerName}}</td>                  
                        <td>{{$row->PhoneNumber}}</td>                  
                    <td><a href="" id="edit_pharmacy" data-toggle="modal" data-target='#edit_pharmacy_modal' data-id="{{encval($row->PharmacyID)}}"><i class="icon-item fas fa-user-edit" role="button" data-prefix="fas" data-id="" data-unicode="f4ff" data-mdb-original-title="" title=""></i></a></td>
                    <td><a href="javascript:void(0);" data-name="{{$row->PharmacyName}}" data-id="{{encval($row->PharmacyID)}}" id="deletepharmacy"><i class="icon-item fas fa-trash-alt" role="button" data-prefix="fas" data-id="trash-alt" data-unicode="f2ed" data-mdb-original-title="" title=""></i></a></td>
                      </tr>  
                      @endforeach       
                    </tbody>
                    
                  </table>
                </div>
              </div>
            </div>

          </div>

         <!-- Tab Panes Ends -->

         <!-- Add Admin Modal -->

        <div class="modal fade" id="add_admin_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add New Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('AddUser')}}">
                  @csrf
                  <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-10 offset-1">
                      <div class="md-form md-outline">
                        <input type="text" class="form-control" id="FirstName" name="FirstName" autofocus value="{{old('FirstName')}}" style="height: 3rem;">
                        <label for="FirstName" class="">First Name</label>
                        @if($errors->AddAdmin->has('FirstName'))
                          <span class="text-danger">{{$errors->AddAdmin->first('FirstName')}}</span>
                        @endif
                      </div>
                      <div class="md-form md-outline">
                        <input type="text" class="form-control" id="LastName" name="LastName" autofocus value="{{old('LastName')}}" style="height: 3rem;">
                        <label for="LastName" class="">Last Name</label>
                        @if($errors->AddAdmin->has('LastName'))
                          <span class="text-danger">{{$errors->AddAdmin->first('LastName')}}</span>
                        @endif
                      </div>
                      <div class="md-form md-outline">
                        <input type="email" class="form-control" id="Email" name="Email" autofocus value="{{old('Email')}}" style="height: 3rem;" >
                        <label for="Email" class="">Email</label>
                        @if($errors->AddAdmin->has('Email'))
                          <span class="text-danger">{{$errors->AddAdmin->first('Email')}}</span>
                        @endif
                      </div>
                       <div class="md-form md-outline">
                        <input type="tel" class="form-control" id="PhoneNumber" name="PhoneNumber" autofocus value="{{old('PhoneNumber')}}" style="height: 3rem;" maxlength="12">
                        <label for="PhoneNumber" class="">Phone Number</label>
                        @if($errors->AddAdmin->has('PhoneNumber'))
                          <span class="text-danger">{{$errors->AddAdmin->first('PhoneNumber')}}</span>
                        @endif
                      </div>
                      <div class="md-form md-outline">
                        <input type="password" class="form-control" id="Password" name="Password" autofocus value="{{old('Password')}}" style="height: 3rem;">
                        <label for="Password" class="">Password</label>
                        @if($errors->AddAdmin->has('Password'))
                          <span class="text-danger">{{$errors->AddAdmin->first('Password')}}</span>
                        @endif
                      </div>
                      <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>                   
                      <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </form> 
              </div>   
            </div>              
          </div>
        </div>      
        <!--------- Add Admin Model Ends ------------->

        <!-- Edit Admin Modal -->

        <div class="modal fade" id="edit_admin_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('UpdateUser')}}">
                  @csrf
                  <input type="hidden" class="form-control" id="EditId" name="EditId" autofocus value="{{old('EditId')}}">
                  <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-10 offset-1">
                      <div class="md-form md-outline">
                        <input type="text" class="form-control" id="EditAdminFirstName" name="EditAdminFirstName" autofocus value="{{old('EditAdminFirstName')}}" style="height: 3rem;">
                        <label for="EditAdminFirstName" class="">First Name</label>
                        @if($errors->EditAdmin->has('EditAdminFirstName'))
                          <span class="text-danger">{{$errors->EditAdmin->first('EditAdminFirstName')}}</span>
                        @endif
                      </div>
                      <div class="md-form md-outline">
                        <input type="text" class="form-control" id="EditAdminLastName" name="EditAdminLastName" autofocus value="{{old('EditAdminLastName')}}" style="height: 3rem;">
                        <label for="EditAdminLastName" class="">Last Name</label>
                        @if($errors->EditAdmin->has('EditAdminLastName'))
                          <span class="text-danger">{{$errors->EditAdmin->first('EditAdminLastName')}}</span>
                        @endif
                      </div>
                      <div class="md-form md-outline">
                        <input type="email" class="form-control" id="EditAdminEmail" name="EditAdminEmail" autofocus value="{{old('EditAdminEmail')}}" style="height: 3rem;">
                        <label for="EditAdminEmail" class="">Email</label>
                        @if($errors->EditAdmin->has('EditAdminEmail'))
                          <span class="text-danger">{{$errors->EditAdmin->first('EditAdminEmail')}}</span>
                        @endif
                      </div>
                       <div class="md-form md-outline">
                        <input type="tel" class="form-control" id="EditAdminPhoneNumber" name="EditAdminPhoneNumber" autofocus value="{{old('EditAdminPhoneNumber')}}" style="height: 3rem;" maxlength="12">
                        <label for="EditAdminPhoneNumber" class="">Phone Number</label>
                        @if($errors->EditAdmin->has('EditAdminPhoneNumber'))
                          <span class="text-danger">{{$errors->EditAdmin->first('EditAdminPhoneNumber')}}</span>
                        @endif
                      </div>
                      <div class="md-form md-outline">
                        <input type="password" class="form-control" id="EditAdminPassword" name="EditAdminPassword" autofocus value="{{old('EditAdminPassword')}}" style="height: 3rem;">
                        <label for="EditAdminPassword" class="">Password</label>                        
                      </div>
                      <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>                   
                      <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
                </form> 
              </div>   
            </div>              
          </div>
        </div>
        
        <!--------- Edit Admin Modal Ends ------------->

		<!----------Add Pharmacy Modal----------------->
        <div class="modal fade" id="add_pharmacy_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add New Pharmacy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('AddPharmacy')}}">
                  @csrf
                  <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-10 offset-1">
                      <div class="md-form md-outline">
                        <input type="text" class="form-control" id="PharmacyName" name="PharmacyName" autofocus value="{{old('PharmacyName')}}" style="height: 3rem;">
                        <label for="PharmacyName" class="">Pharmacy Name</label>
                        @if($errors->AddPharmacy->has('PharmacyName'))
                          <span class="text-danger">{{$errors->AddPharmacy->first('PharmacyName')}}</span>
                        @endif
                      </div>
                      <div class="md-form md-outline">
                        <textarea type="text" class="form-control" id="PharmacyAddress" name="PharmacyAddress" rows="5">{{old('PharmacyAddress')}}</textarea>
                        <label for="PharmacyAddress" class="">Pharmacy Address</label>
                        @if($errors->AddPharmacy->has('PharmacyAddress'))
                          <span class="text-danger">{{$errors->AddPharmacy->first('PharmacyAddress')}}</span>
                        @endif
                      </div>
                      <div class="md-form md-outline">
                        <input type="text" class="form-control color-input" id="PharmacyManager" name="PharmacyManager" autofocus value="{{old('PharmacyManager')}}">
                        <label for="PharmacyManager" class="">Pharmacy Manager</label>
                        @if($errors->AddPharmacy->has('PharmacyManager'))
                          <span class="text-danger">{{$errors->AddPharmacy->first('PharmacyManager')}}</span>
                        @endif
                      </div>
                      <div class="md-form md-outline">
                        <input type="tel" class="form-control color-input" id="PharmacyPhone" name="PharmacyPhone" autofocus value="{{old('PharmacyPhone')}}" maxlength="12">
                        <label for="PharmacyPhone" class="">Pharmacy Phone Number</label>
                        @if($errors->AddPharmacy->has('PharmacyPhone'))
                          <span class="text-danger">{{$errors->AddPharmacy->first('PharmacyPhone')}}</span>
                        @endif
                      </div>
                      <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                    </div>
                  </div>
                </form> 
              </div>   
            </div>              
          </div>
        </div>		
		
		<!----------Add Pharmacy Modal End----------------->
		
		<!----------Edit Pharmacy Modal-------------------->	
        <div class="modal fade" id="edit_pharmacy_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Pharmacy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('UpdatePharmacy')}}">
                  @csrf
                  <input type="hidden" id="EditPharmacyId" name="EditPharmacyId" value="{{old('EditPharmacyId')}}">
                  <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-10 offset-1">
                      <div class="md-form md-outline">
                        <input type="text" class="form-control" id="EditPharmacyName" name="EditPharmacyName" autofocus value="{{old('EditPharmacyName')}}" style="height: 3rem;">
                        <label for="EditPharmacyName" class="">Pharmacy Name</label>
                        @if($errors->EditPharmacy->has('EditPharmacyName'))
                          <span class="text-danger">{{$errors->EditPharmacy->first('EditPharmacyName')}}</span>
                        @endif
                      </div>
                      <div class="md-form md-outline">
                        <textarea type="text" class="form-control" id="EditPharmacyAddress" name="EditPharmacyAddress" rows="5">{{old('EditPharmacyAddress')}}</textarea>
                        <label for="EditPharmacyAddress" class="active">Pharmacy Address</label>
                        @if($errors->EditPharmacy->has('EditPharmacyAddress'))
                          <span class="text-danger">{{$errors->EditPharmacy->first('EditPharmacyAddress')}}</span>
                        @endif
                      </div>
                      <div class="md-form md-outline">
                        <input type="text" class="form-control color-input" id="EditPharmacyManager" name="EditPharmacyManager" autofocus value="{{old('EditPharmacyManager')}}">
                        <label for="EditPharmacyManager" class="">Pharmacy Manager</label>
                        @if($errors->EditPharmacy->has('EditPharmacyManager'))
                          <span class="text-danger">{{$errors->EditPharmacy->first('EditPharmacyManager')}}</span>
                        @endif
                      </div>
                      <div class="md-form md-outline">
                        <input type="tel" class="form-control color-input" id="EditPharmacyPhone" name="EditPharmacyPhone" autofocus value="{{old('EditPharmacyPhone')}}" maxlength="12">
                        <label for="EditPharmacyPhone" class="">Pharmacy Phone Number</label>
                        @if($errors->EditPharmacy->has('EditPharmacyPhone'))
                          <span class="text-danger">{{$errors->EditPharmacy->first('EditPharmacyPhone')}}</span>
                        @endif
                      </div>
                      <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                    </div>
                  </div>
                </form> 
              </div>   
            </div>              
          </div>
        </div>		
		<!----------Edit Pharmacy Modal End-------------------->	


        </div>
        <!-- Gird column -->

        <!-- Gird column -->
        <!-- Gird column -->

      </section>
      <!-- Section: Basic examples -->

    </div>

  </main>
  <!-- Main layout -->

@include('Common.Footer')
<script src="{{asset('assets/js/Administration/Administration.js')}}"></script>

