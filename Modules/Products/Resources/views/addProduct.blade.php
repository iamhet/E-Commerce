@extends('products::index')

@section('manageProduct')
<div class="col-md-12 pr-30">
    <div class="card-box  ">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Add Products</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Manage Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Email</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-directory-list ">
        <ul class="row">
            @foreach ($productCategory as $item)
            <li class="col-xl-4 col-lg-4 col-md-6 col-sm-12 ">
                <div class="contact-directory-box">
                    <div class="contact-dire-info text-center">
                        <div class="contact-avatar">
                            <span>
                                @if ($item->gender == 'Kids')
                                <img src={{ asset('images/kids.jpg') }} class="mt-2"
                                    style="height: -webkit-fill-available !important">
                                @endif
                                @if ($item->gender == 'Men')
                                <img src={{ asset('images/men.jpg') }} alt="">
                                @endif
                                @if ($item->gender == 'Women')
                                <img src={{ asset('images/women.jpg') }} alt="">
                                @endif
                            </span>
                        </div>
                        <div class="contact-name">
                            <h4>{{$item->gender}}</h4>
                        </div>
                    </div>
                    <div class="view-contact">
                        <a href="#" class="category" data-gender="{{$item->gender}}" class="gender">Add Products</a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="pd-20 card-box mt-30 mb-30 add_product">    
       
    </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
    $('.add_product').hide();
    $(document).on('click','.category', function () {
        alert($(this).data('gender'));
    });
});
</script>
@endsection