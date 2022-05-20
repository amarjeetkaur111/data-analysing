 
@include('Common.Header')  
  @if($errors->AddCategory->any())
    <script>
       $(function(){
           $('#add_category_modal').modal('show');
       });
    </script>
  @enderror
  @if($errors->EditCategory->any())
    <script>
       $(function(){
           $('#edit_category_modal').modal('show');
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
              <a class="nav-link active" id="category-tab" data-toggle="tab" href="#category" role="tab" aria-controls="category" aria-selected="true">Category</a>
            </li>          
          </ul>
         <!-- Nav tabs Ends -->

          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="category" role="tabpanel" aria-labelledby="category-tab">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6"><h4>Catgories</h4>
                    </div>
                    <div class="col-md-6 text-right">
                      <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" data-target="#add_category_modal" >Add New Category</button>
                    </div>
                  </div>
                  <hr>
                  <table id="category_table" class="table table-striped" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
					<tbody>
                      @foreach($categories as $data)
                      <tr>
                        <td>{{$data->CategoryID}}</td>
                        <td>{{$data->CategoryName}}</td>                  
                        <td><a href="" id="edit_category" data-toggle="modal" data-target='#edit_category_modal' data-id="{{encval($data->CategoryID)}}"><i class="icon-item fas fa-user-edit" role="button" data-prefix="fas" data-id="" data-unicode="f4ff" data-mdb-original-title="" title=""></i></a></td>

                        <td><a href="javascript:void(0);" data-name="{{$data->CategoryName}}" data-id="{{encval($data->CategoryID)}}" id="deletecategory"><i class="icon-item fas fa-trash-alt" role="button" data-prefix="fas" data-id="trash-alt" data-unicode="f2ed" data-mdb-original-title="" title=""></i></a></td>
                      </tr> 
                      @endforeach               
                    </tbody>               
                    
                  </table>
                </div>
              </div>
            </div>
          </div>

         <!-- Tab Panes Ends -->

         <!-- Add Category Modal -->

        <div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('AddCategory')}}">
                  @csrf
                  <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-10 offset-1">
                      <div class="md-form md-outline">
                        <input type="text" class="form-control" id="CategoryName" name="CategoryName" autofocus value="{{old('CategoryName')}}" style="height: 3rem;">
                        <label for="FirstName" class="">Category Name</label>
                        @if($errors->AddCategory->has('CategoryName'))
                          <span class="text-danger">{{$errors->AddCategory->first('CategoryName')}}</span>
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
        <!--------- Add Category Model Ends ------------->

        <!-- Edit Category Modal -->

        <div class="modal fade" id="edit_category_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{route('UpdateCategory')}}">
                  @csrf
                  <input type="hidden" class="form-control" id="EditId" name="EditId" autofocus value="{{old('EditId')}}">
                  <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-10 offset-1">
                      <div class="md-form md-outline">
                        <input type="text" class="form-control" id="EditCategoryName" name="EditCategoryName" autofocus value="{{old('EditCategoryName')}}" style="height: 3rem;">
                        <label for="EditAdminFirstName" class="">Category Name</label>
                        @if($errors->EditCategory->has('EditCategoryName'))
                          <span class="text-danger">{{$errors->EditCategory->first('EditCategoryName')}}</span>
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
        
        <!--------- Edit Category Modal Ends ------------->	

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
<script src="{{asset('assets/js/Categories/Categories.js')}}"></script>

