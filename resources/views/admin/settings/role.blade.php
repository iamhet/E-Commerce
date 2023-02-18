@extends('admin.settings.setup')
@section('settings')
<div class="col-md-10 pr-30">
    <div class="card-box  ">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Product Category</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Category</li>
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
                <button type="button" class="btn btn-success" id="addrole" data-toggle="modal" data-target="#roleModal">
                    ADD NEW ROLE
                </button>
            </div>
        </div>
        <br>
        <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="roleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route'=>'admin.add_role' ,'method' => 'POST','id' =>
                        'manage_role_form']) !!}
                        @csrf
                        {!! Form::hidden('roleId') !!}
                        <label class="col-form-label" style="font-size: 1rem;">Enter Role Name </label>
                        {!! Form::text('rolename', '',['id'=>'rolename','placeholder' => 'Enter Role Name', 'class'
                        =>'form-control ']) !!}
                        <label class="col-form-label" style="font-size: 1rem;">Select Permission </label>
                        @foreach ($permission as $value)
                        <label class="form-check form-switch" style="margin-bottom: 0rem;">
                            <input class="form-check-input" type="checkbox" name="{{ 'permission[]' }}"
                                value="{{ $value->id }}">
                            <span class="form-check-label">{{ $value->name }}</span>
                        </label>
                        <br />
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info submit ms-auto" data-bs-dismiss="modal">
                            Add Role
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
    $(document).on('click', '#addrole', function() {
            $('.modal-title').text('Add New Role');
            $('.submit').text('Add Role');
            $('input[name=roleName]').val('');
            $('input:checkbox').prop('checked', false);
        });
    $(document).on('submit', '#manage_role_form', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            type: "post",
            url: "{{ route('admin.add_role') }}",
            data: data,
            dataType: "json",
            success: function(data) {
                $('#roledatatable-table').DataTable().ajax.reload();
                alert_float(data.success, data.message);
            }
        });
    });
    $(document).on('click', '.deleteRole ', function() {
         var data = {
            id: $(this).data('id')
        };
        $.ajax({
            type: "post",
            url: "{{ route('admin.delete_role') }}",
            data: data,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('#roledatatable-table').DataTable().ajax.reload();
                alert_float(data.success, data.message);
            }
        });
    });

    $(document).on('click', '.editRole', function(e) {
        e.preventDefault();
        $('.modal-title').text('Add New Role');
        $('.submit').text('Update Role');
        $('input:checkbox').prop('checked', false);

        var data = {
            id: $(this).data('id')
        };
        $.ajax({
            type: "post",
            url: "{{ route('admin.edit_role') }}",
            data: data,
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('input[name=rolename]').val(data.role.name);
                $('input[name=roleId]').val(data.role.id);
                $.each(data.roleHasPermission, function(index, value) {
                    $('input[value=' + value + ']').prop('checked', true);
                });
                $('#modal-role').modal('show');
            }
        });
    });
</script>
@endsection