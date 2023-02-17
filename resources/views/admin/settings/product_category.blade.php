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
            <div class="col-md-3">
                <button type="button" class="btn btn-success" id="addCategory" data-toggle="modal"
                    data-target="#categoryModal">
                    ADD PRODUCT CATEGORY
                </button>
            </div>
            <div class="col-md-3">
                <select class="selectpicker form-control" name="gender" id="gender_filter" data-size="5"
                    data-style="btn-outline-info" multiple data-actions-box="true" data-selected-text-format="count">
                    <optgroup label="Gender">
                        <option value="0">Men</option>
                        <option value="1">Women</option>
                        <option value="2">Kids</option>
                    </optgroup>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-info btn-sm get_filter">GET</button>
            </div>
        </div>
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route'=>'admin.save_product_category' ,'method' => 'POST','id' =>
                        'product_category_form']) !!}
                        <input type="hidden" name="categoryId" id="categoryId" value="">
                        <span data-toggle="tooltip" data-placement="top"
                            title="This is a main Category of ours Products">
                            <i class="fa fa-question-circle"></i>
                        </span>
                        <label class="col-form-label" style="font-size: 1rem;">Enter Product Category </label>
                        {!! Form::text('productCategory', '',['id'=>'productCategory','placeholder' => 'Enter Product
                        Category', 'class'
                        =>'form-control ']) !!}
                        <label class="col-form-label" style="font-size: 1rem;">Gender</label>
                        {!! Form::select('gender',['None','Men','Women','Kids'],'',['id'=>'gender','class'
                        =>'form-control ']) !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {!! Form::submit('Save', ['type'=>'submit','class' => 'btn btn-info']) !!}
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
    $(document).on('click','#addCategory',function () {
        $('#categoryModalLabel').text('Add Category');
    });
    $(document).ready(function () {
        $('#gender_filter').selectpicker();
        // $('#gender').selectpicker();

        $(document).on('click','.get_filter', function () {
            $('#productcategorydatatable-table').on('preXhr.dt', function (e, settings, data ) {
                data.gender = $('#gender_filter').val();
            }); 
            $('#productcategorydatatable-table').DataTable().ajax.reload();
            $('#gender_filter').selectpicker('refresh');
        });
        $(document).on('click','.editCategory', function (e) {
            e.preventDefault();
            var data = {'categoryId' : $(this).data('id')};
            $.ajax({
                type: "post",
                url: "{{route('admin.get_product_category')}}",
                data: data,
                dataType: "json",
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#categoryModal').modal('show');
                    $('#categoryId').val(response.id);
                    $('#productCategory').val(response.category_name);
                    if(response.gender=='Men'){
                        $('#gender').val(1);
                        $('select[name=gender]').val(1);
                        $('#gender').selectpicker('refresh')
                    }    
                    if(response.gender=='Women'){
                        $('#gender').val(2);
                        $('select[name=gender]').val(2);
                        $('#gender').selectpicker('refresh')
                    }
                    if(response.gender=='Kids'){
                        $('#gender').val(3);
                        $('select[name=gender]').val(3);
                        $('#gender').selectpicker('refresh')
                    }
                    $('#categoryModalLabel').text('Edit Category');
                }
            });
        });
        $('#product_category_form').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            console.log(data);
            var action = $(this).attr('action');
            $.ajax({
                type: "post",
                url: action,
                data: data,
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function (response) {
                    if(response.success)
                    {
                        alert_float('success',response.message);
                        $ ('#categoryModal').modal ('hide');
                        $('#productCategory').val('');
                        $('#gender').selectpicker('refresh');
                        $('#productcategorydatatable-table').DataTable().ajax.reload();
                    }
                }
            });
        });
        $(document).on('click','.deleteCategory', function () {
            var data = {'categoryId' : $(this).data('id')};
            $.ajax({
                type: "post",
                url: "{{route('admin.delete_product_category')}}",
                data: data,
                dataType: "json",
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.success)
                    {
                        $('#productcategorydatatable-table').DataTable().ajax.reload();
                        alert_float('success',response.message);
                    }
                    else
                    {
                        alert_float('error',response.message);

                    }
                }
            });
        });
    });     
</script>
@endsection