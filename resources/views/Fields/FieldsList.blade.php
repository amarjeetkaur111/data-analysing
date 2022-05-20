 
@include('Common.Header')  
  @if($errors->AddField->any())
    <script>
       $(function(){
           $('#add_field_modal').modal('show');
       });
    </script>
  @enderror 
  @if($errors->EditField->any())
    <script>
       $(function(){
           $('#edit_field_modal').modal('show');
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
              <a class="nav-link active" id="field-tab" data-toggle="tab" href="#field" role="tab" aria-controls="field" aria-selected="true">Fields</a>
            </li>          
          </ul>
         <!-- Nav tabs Ends -->

          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="field" role="tabpanel" aria-labelledby="field-tab">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6"><h4>List Fields Category Wise</h4>
                    </div>
                    <div class="col-md-6 text-right">
						<button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#add_field_modal" >Add New Field</button>
                    </div>
                  </div>
				  <div class="col-md-3">
					<div class="md-form md-outline">
						<select class="form-control" id="Category" name="Category" style="border-radius:0.2rem;">
							<option value="">Select Category</option>
							@foreach($categories as $row)
							<option value="{{ $row->CategoryID }}">{{ $row->CategoryName }}</option>	
							@endforeach										
						</select>							
					</div>						
				  </div>
                  <hr>
                  <table id="field_table" class="table table-striped" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Field Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
					<tbody id="fields_list">
             
                    </tbody>               
                    
                  </table>
                </div>
              </div>
            </div>
          </div>

         <!-- Tab Panes Ends -->

         <!-- Add New Field Modal -->

        <div class="modal fade" id="add_field_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add New Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
					<form method="post" action="{{ route('InsertFields') }}">
					@csrf
						<div class="col-md-10 offset-1">
							<div class="md-form md-outline">
								<select class="form-control" name="Category" style="border-radius:0.2rem;">
									<option value="">Select Category</option>
									@foreach($categories as $row)
									<option value="{{ $row->CategoryID }}">{{ $row->CategoryName }}</option>	
									@endforeach										
								</select>
								@if($errors->AddField->has('Category'))
									<span class="text-danger">{{$errors->AddField->first('Category')}}</span>
								@endif							
							</div>
						</div>
						<div class="col-md-10 offset-1">
							<div class="md-form md-outline">
								<input type="text" id="FieldName" name="FieldName" class="form-control" value="{{old('FieldName')}}">
								<label for="text">Field Name</label>
								@if($errors->AddField->has('FieldName'))
									<span class="text-danger">{{$errors->AddField->first('FieldName')}}</span>
								@endif															
							</div>
						</div>
						<div class="card-foter text-center">
							<button type="submit" class="btn btn-outline-primary btn-sm" style="width: 140px;">Submit</button>
						</div>
					</form> 
              </div>   
            </div>              
          </div>
        </div>      
        <!--------- Add New Field Model Ends ------------->

        <!-- -----------Edit Field Modal ----------------->
        <div class="modal fade" id="edit_field_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
					<form method="post" action="{{ route('UpdateField') }}">
					@csrf
						<input type="hidden" id="editfield_id" name="editfield_id" value="{{ old('editfield_id') }}">
						<div class="col-md-10 offset-1">
							<div class="md-form md-outline">
								<select class="form-control" id="EditCategoryName" name="EditCategoryName" style="border-radius:0.2rem;">
									<option value="">Select Category</option>
									@foreach($categories as $row)
									<option value="{{ $row->CategoryID }}">{{ $row->CategoryName }}</option>	
									@endforeach										
								</select>
								@if($errors->EditField->has('EditCategoryName'))
									<span class="text-danger">{{$errors->EditField->first('EditCategoryName')}}</span>
								@endif							
							</div>
						</div>
						<div class="col-md-10 offset-1">
							<div class="md-form md-outline">
								<input type="text" id="EditFieldName" name="EditFieldName" class="form-control" value="{{old('EditFieldName')}}" autofocus>
								<label for="text">Field Name</label>
								@if($errors->EditField->has('EditFieldName'))
									<span class="text-danger">{{$errors->EditField->first('EditFieldName')}}</span>
								@endif															
							</div>
						</div>
						<div class="card-foter text-center">
							<button type="submit" class="btn btn-outline-primary btn-sm" style="width: 140px;">Submit</button>
						</div>
					</form> 
              </div>   
            </div>              
          </div>
        </div>        
        <!--------- Edit Field Modal Ends ------------->	

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
<script src="{{asset('assets/js/Fields/Fields.js')}}"></script>

