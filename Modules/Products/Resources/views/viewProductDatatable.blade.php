@extends('products::index')

@section('manageProduct')
<div class="col-md-12 pr-30 productTable">
    <div class="card-box  ">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Manage Product</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <a href="{{route('admin.viewProducts')}}" class="btn btn-warning">SWITCH TO CARD</a>
    <a href="{{route('admin.productindex')}}" class="btn btn-primary ProductAdd">ADD PRODUCT</a>
    <div class="pd-20 card-box mt-30 mb-30">
        <div class="container">
            <div class="row">
                <div class="col-md-2 mb-3">
                    <select class="selectpicker form-control" name="gender" id="gender_filter"
                        data-style="btn-outline-info" style="
                        element.style: #17a2b8;">
                        <optgroup label="Gender">
                            <option value="0">Select Gender</option>
                            <option value="1">Men</option>
                            <option value="2">Women</option>
                            <option value="3">Kids</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <select class="selectpicker form-control" name="category" id="category_filter"
                        data-style="btn-outline-info" style="
                        element.style: #17a2b8;">
                        <optgroup label="Categories">
                            <option value="0">Select Categories</option>
                            @foreach ($productCategory as $item => $value)
                            <option value={{$value}}>{{$value}}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>
        <div class="container">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
<div class="editProductdiv">

</div>
@endsection

@section('script')
{{ $dataTable->scripts() }}
<script>
    $(document).ready(function () {
        $(document).on('click','.editProduct', function () {
            $('.productTable').hide();
            var id = {id : $(this).data('id')};
            $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $('.editProduct').load("{{route('admin.editProduct')}}", id, function (response, status, request) {
            
            });
        });
        $('#gender_filter').selectpicker();
        $(document).on('change','#gender_filter', function () {
            $('#productsdatatable-table').on('preXhr.dt', function (e, settings, data ) {
                data.gender = $('#gender_filter').val();
            }); 
            $('#productsdatatable-table').DataTable().ajax.reload();
            $('#gender_filter').selectpicker('refresh');
        });
        $(document).on('change','#category_filter', function () {
            $('#productsdatatable-table').on('preXhr.dt', function (e, settings, data ) {
                data.category = $('#category_filter').val();
            }); 
            $('#productsdatatable-table').DataTable().ajax.reload();
            $('#category_filter').selectpicker('refresh');
        });
    });
</script>
@endsection