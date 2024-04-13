<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Designation - T-Sync</title>

  <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Designations') }}
        </h2>
    </x-slot>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/sync-removebg-preview.ico" alt="AdminLTELogo" height="200" width="200">
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <span class="alert alert-success" id="alert-success" style="display: none"></span>
    <span class="alert alert-danger" id="alert-danger" style="display: none"></span>
    <!-- /.content-header -->
    <section class="content" style="margin-left: 5%; margin-right: 5%; margin-top: 2%; background: white;">
      <div class="container-fluid" >
        <div class="row">
          <div class="col-12" >
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Designation Information</h3>
                <div class="float-right">
                  <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal-add-new"><i class="fas fa-user-plus"></i>Add New Designation</button>
              </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @if (count($designations) > 0)
                            @foreach ($designations as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td><button class="btn btn-primary btn-sm editBtn" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-category="{{ $item->category }}" data-description="{{ $item->description }}" data-toggle="modal" data-target="#editModal"><i class="fas fa-pencil-alt"></i>Edit</button></td>
                                    <td><button class="btn btn-danger btn-sm deleteBtn" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i>Delete</button></td>
                                </tr>
                            @endforeach
                       @else
                                <tr>
                                    <td colspan="6">No Data Found!</td>
                                </tr>
                       @endif
                    </tbody>
                </table>

          </div>


              {{-- ADD DESIGNATIONS MODAL --}}
            <div class="modal fade" id="modal-add-new">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">New Designations</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="addDesignationsForm">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"  id=""  placeholder="Enter Your Name">
                      </div>
                      <div class="form-group">
                        <label>Select Category</label>
                        <select name="category" class="form-control" id="categoryId">
                            @foreach ($data as $row)
                             <option value="{{ $row->name }}">{{ $row->name }}</option>
                            @endforeach
                            </select>
                      </div>
                      <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="" class="form-control" rows="3"></textarea>
                      </div>
                    <div class="modal-footer justify-content-between">
                      <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary addButton"  value = "Add New Record">
                    </div>
                  </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              </div>

              {{-- EDIT DESIGNATIONS MODAL --}}
            <div class="modal fade" id="editModal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Designations</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="editDesignationsForm">
                        @csrf
                        <input type="hidden" id="designations_id" name="designations_id">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"  id="name"  placeholder="Enter Your Name">
                      </div>
                      <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" name="category"  id="category">
                      </div>
                      <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                      </div>
                    <div class="modal-footer justify-content-between">
                      <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary editButton"  value = "Update New Record">
                    </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            </div>
            </form>

                         {{-- DELETE MODAL --}}
            <div class="modal fade" id="deleteModal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">New Designations</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                        Do you really want to delete <p class="designations_name"></p> ?

                    <div class="modal-footer justify-content-between">
                      <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-danger deleteBTN" value = "Delete">
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              </div>
              </form>

               <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            </div>

      </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">

    <!-- Control sidebar content goes here -->

  </aside>
  <!-- /.control-sidebar -->
</div>

{{-- ADD AJAX --}}
<script>
    $(document).ready(function(){
         $('#addDesignationsForm').submit('click', function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: '{{ route("addDesignations") }}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('.addButton').prop('disabled', true);
                },
                complete: function(){
                    $('.addButton').prop('disabled', false);
                },
                success: function(data){
                    if(data.success == true){
                        $('#modal-add-new').modal('hide');
                        printSuccessMsg(data.msg);
                        var reloadInterval = 1000;
                        function reloadPage(){
                            location.reload(true);
                        }
                        var intervalId = setInterval(reloadPage, reloadInterval);
                    }else if(data.success == false){
                        printErrorMsg(data.msg);
                    }else{
                        printValidationErrorMsg(data.msg);
                    }
                }
           });
           return false;
        });
        // DELETE AJAX
        $('.deleteBtn').on('click', function(){
            var designations_id = $(this).attr('data-id');
            var designations_name = $(this).attr('data-name');
            $('.designations_name').html('');
            $('.designations_name').html(designations_name);

            $('.deleteBTN').on('click', function(){
            var url = "{{ route('deleteDesignations','designations_id') }}";
            url = url.replace('designations_id',designations_id);

            // console.log(url);
            $.ajax({
                url: url,
                type: 'GET',
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('.deleteBTN').prop('disabled', true);
                },
                complete: function(){
                    $('.deleteBTN').prop('disabled', false);
                },
                success: function(data){
                    if(data.success == true){
                        $('#deleteModal').modal('hide');
                        printSuccessMsg(data.msg);
                        var reloadInterval = 1000;
                        function reloadPage(){
                            location.reload(true);
                        }
                        var intervalId = setInterval(reloadPage, reloadInterval);
                    }else{
                        printErrorMsg(data.msg);
                    }
                }
            });
        });
        });

        // EDIT DESIGNATIONS FUNCTIONALITY
        $('.editBtn').on('click', function(){
            var designations_id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var category = $(this).attr('data-category');
            var description = $(this).attr('data-description');

            $('#name').val(name);
            $('#category').val(category);
            $('#description').val(description);
            $('#designations_id').val(designations_id);

            // EDIT SUBMIT
           $('#editDesignationsForm').submit('click', function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: '{{ route("editDesignations") }}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('.editButton').prop('disabled', true);
                },
                complete: function(){
                    $('.editButton').prop('disabled', false);
                },
                success: function(data){
                    if(data.success == true){
                        $('#editModal').modal('hide');
                        printSuccessMsg(data.msg);
                        var reloadInterval = 1000;
                        function reloadPage(){
                            location.reload(true);
                        }
                        var intervalId = setInterval(reloadPage, reloadInterval);
                    }else if(data.success == false){
                        printErrorMsg(data.msg);
                    }else{
                        printValidationErrorMsg(data.msg);
                    }
                }
           });
        });

        function printValidationErrorMsg(msg){
                $.each(msg, function(field_name,error){
                    console.log(field_name,error);
                    $(document).find('#'+field_name+'_error').text(error);
                });
            }

        });
        function printErrorMsg(msg){
                $('#alert-danger').html('');
                $('#alert-danger').css('display','block');
                $('#alert-danger').append(''+msg+'');
            }
            function printSuccessMsg(msg){
                $('#alert-success').html('');
                $('#alert-success').css('display','block');
                $('#alert-success').append(''+msg+'');
                document.getElementById('addDesignationsForm').reset();
            }



    });
</script>

<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>


</x-app-layout>
