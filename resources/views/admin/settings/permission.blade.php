@extends('admin.settings.setup')
@section('settings')
<div class="col-md-10 pr-30">
    <div class="card-box  ">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Permission</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Permission</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="pd-20 card-box mt-30 mb-30">
        <div class="row">
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <button type="button" class="btn btn-success add_permission" id="addrole" data-toggle="modal" data-target="#permissionModal">
                    ADD NEW PERMISSION
                </button>
            </div>
        </div>
        <br>
        <div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permissionModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route'=>'admin.add_permission' ,'method' => 'POST','id' =>
                        'manage_permission_form']) !!}
                        @csrf
                        {!! Form::hidden('permissionId') !!}
                        <label class="col-form-label" style="font-size: 1rem;">Enter Permission </label>
                        {!! Form::text('permissionName', '',['id'=>'permissionName','placeholder' => 'Enter Permission', 'class'
                        =>'form-control ']) !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info submitBtn ms-auto" data-bs-dismiss="modal">
                            Add Permission
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="container">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@endsection

@section('script')
{{ $dataTable->scripts() }}
<script type="text/javascript">
    $(document).ready(function () {
        $('#permissiondatatable-table').DataTable().ajax.reload();
        $(document).on('click','.add_permission', function() {
            $('#permissionModalLabel').text('Add New Permission');
            $('input[name=permissionId]').val('');
            $('input[name=permissionName]').val('');
            $('.submitBtn').text('Add Permission');
        });
        $(document).on('submit','#manage_permission_form', function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                type: "post",
                url: url,
                data: data,
                dataType: "json",
                success: function (data) {
                    $('#permissionModal').modal('hide');
                    $('#permissiondatatable-table').DataTable().ajax.reload();
                    alert_float(data.success,data.message);
                }
            });
        });
        $(document).on('click','.editPermission', function() {
            $('input[name=permissionName]').val('');

            var id = {id: $(this).data('id')};
            $.ajax({
                type: "post",
                url: "{{route('admin.edit_permission')}}",
                data: id,
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    $('.submitBtn').text('Edit Permission');
                    $('#permissionModalLabel').text('Edit New Permission');
                    $('input[name=permissionId]').val(data.id);
                    $('input[name=permissionName]').val(data.name);
                    $('#permissionModal').modal('show');
                }
            });
        });
        $(document).on('click','.deletePermission ', function() {
            var data = {id:$(this).data('id')};
            $.ajax({
                type: "post",
                url: "{{route('admin.delete_permission')}}",
                data: data,
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    $('#permissiondatatable-table').DataTable().ajax.reload();
                    alert_float(data.success,data.message);
                }
            });
        });
    });
</script>
@endsection