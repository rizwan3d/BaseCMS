@extends('admin.layout.layout')

@section('title', 'All Category List')


@section('lable', 'Category List')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title d-inline">List of all Category</h3>
        <div class="text-right">
            <a href="{{ url('/Category/add') }}" class="btn btn-primary">Add</a>
        </div>
    </div>
    <div class="card-body">

        <div class="alert alert-success m-2 d-none"> Deleted Sucessfully </div>

        <table class="table table-bordered table-hover yajra-datatable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
@endsection

@section('script')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript">
    $(function () {
      
      var table = $('.yajra-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ url('Category/list') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'Name', name: 'Name'},
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
              },
          ]
      });
    });
    function deleteCall (id) {
            $.ajaxSetup({
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            $.ajax({
                url: "{{ url('/Category/') }}/" + id,
                data: {method: '_DELETE', submit: true}  ,  type: 'DELETE',

            }).always(function (data) {
                $(".alert").show();
                $('.yajra-datatable').DataTable().draw(false);
            });
          }


    
          



</script>

@endsection