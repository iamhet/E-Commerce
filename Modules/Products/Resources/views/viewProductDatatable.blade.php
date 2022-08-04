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
    <div class="pd-20 card-box mt-30 mb-30">
        <div class="container">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>

{{ $dataTable->scripts() }}

@endsection