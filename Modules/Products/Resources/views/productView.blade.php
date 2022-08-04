@extends('products::index')

@section('manageProduct')
<div class="col-md-12 pr-30">
    <div class="card-box ">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Manage Products</h4>
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
    <div class="viewProduct">
        <button class="btn btn-warning">SWITCH TO DATATABLE</button>
        <a href="{{route('admin.productindex')}}" class="btn btn-primary ProductAdd">ADD PRODUCT</a>

        <div class="pd-20 card-box mt-30 mb-30 ">

            <div class="row">
                <div class="col-md-11">
                    <div class="title page-header mt-2">
                        <h4 style="font-size: 1.5rem;" class="addProductTitle">Products</h4>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-5 ">
                <div class="col-md-12">
                    <div class="product-wrap">
                        <div class="product-list">
                            <ul class="row">
                                @foreach ($products as $item)
                                <li class="col-lg-2 col-md-2 col-sm-12">
                                    <div class="product-box">
                                        <div class="producct-img"><img src={{
                                                asset('ProductImages/'.$item['id'].'/'.$item['product_images'][0]['product_image'])
                                                }} alt=""></div>
                                        <div class="product-caption">
                                            <h4><a href="#">{{$item['product_name']}}</a></h4>
                                            <div class="price">
                                                <del>{{$item['product_price']+100}}</del><ins>{{$item['product_price']}}</ins>
                                            </div>
                                            <a href="#" class="btn btn-outline-primary">Read More</a>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog-pagination mb-30">
                            <div class="btn-toolbar justify-content-center mb-15">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-outline-primary prev"><i
                                            class="fa fa-angle-double-left"></i></a>
                                    <a href="#" class="btn btn-outline-primary">1</a>
                                    <a href="#" class="btn btn-outline-primary">2</a>
                                    <span class="btn btn-primary current">3</span>
                                    <a href="#" class="btn btn-outline-primary">4</a>
                                    <a href="#" class="btn btn-outline-primary">5</a>
                                    <a href="#" class="btn btn-outline-primary next"><i
                                            class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="add_product"></div>
</div>
@endsection