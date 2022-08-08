@extends('products::index')

@section('manageProduct')
<div class="col-md-12 pr-30">
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
                    <select class="selectpicker form-control" name="gender" id="gender_filter" data-style="btn-outline-info" >
                        <optgroup label="Gender">
                            <option value="0">Nothing To Select</option>
                            <option value="1">Men</option>
                            <option value="2">Women</option>
                            <option value="3">Kids</option>
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

{{ $dataTable->scripts() }}
<script>
    $(document).ready(function () {
        $('#gender_filter').selectpicker();
        $(document).on('change','#gender_filter', function () {
            $('#productsdatatable-table').on('preXhr.dt', function (e, settings, data ) {
                data.gender = $('#gender_filter').val();
            }); 
            $('#productsdatatable-table').DataTable().ajax.reload();
            $('#gender_filter').selectpicker('refresh');
        });
    });
</script>
@endsection