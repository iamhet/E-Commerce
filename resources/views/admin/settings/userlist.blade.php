@extends('admin.settings.setup')
@section('settings')
<div class="col-md-10 pr-30">
    <div class="card-box  ">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Users</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="profileview">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                <div class="pd-20 card-box height-100-p">
                    <div class="profile-photo">
                        <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i
                                class="fa fa-pencil"></i></a>
                        <img src="vendors/images/photo1.jpg" alt="" class="avatar-photo">
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body pd-5">
                                        <div class="img-container">
                                            <img id="image" src="vendors/images/photo2.jpg" alt="Picture">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" value="Update" class="btn btn-primary">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 class="text-center h5 mb-0">Ross C. Lopez</h5>
                    <p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
                    <div class="profile-social">
                        <h5 class="mb-10 h5 text-blue">Social Links</h5>
                        <ul class="clearfix">
                            <li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i
                                        class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i
                                        class="fa fa-linkedin"></i></a></li>
                            <li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i
                                        class="fa fa-instagram"></i></a></li>
                            <li><a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff"><i
                                        class="fa fa-dribbble"></i></a></li>
                            <li><a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff"><i
                                        class="fa fa-dropbox"></i></a></li>
                            <li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i
                                        class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff"><i
                                        class="fa fa-pinterest-p"></i></a></li>
                            <li><a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff"><i
                                        class="fa fa-skype"></i></a></li>
                            <li><a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff"><i
                                        class="fa fa-vine"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                <div class="card-box height-100-p overflow-hidden">
                    <div class="profile-tab height-100-p">
                        <div class="row mt-3">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <button class="btn btn-danger btn-sm"><i class="icon-copy fa fa-arrow-circle-o-left" aria-hidden="true"></i>Back</button>
                            </div>
                        </div>
                        <div class="row m-5">
                            <div class="col-md-6">
                                <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-20 h5 text-blue">Contact Information</h5>

                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-20 h5 text-blue">Contact Information</h5>

                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-20 h5 text-blue">Contact Information</h5>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pd-20 card-box mt-30 mb-30">
        <div class="row">
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <button type="button" class="btn btn-success" id="addrole" data-toggle="modal" data-target="#roleModal">
                    ADD NEW USER
                </button>
            </div>
        </div>
        <div class="row mt-3 ">
            <div class="col-md-12">
                <div class="product-wrap">
                    <div class="product-list">
                        <ul class="row">
                            @foreach ($user as $item => $value)
                            <li class="col-lg-2 col-md-2 col-sm-12">
                                <div class="product-box">
                                    <div class="producct-img" style="width: 200px; height: 200px">
                                        <img src="{{ $value->profileImage ? asset('UserImages/' . $value->id . '/' . $value->profileImage) : asset('images/userimg.jpg') }}"
                                            alt="No Image" style="width: 200px; height: 200px">
                                    </div>
                                    <div class="ml-3 product-caption">
                                        <h4 class="ml-2 "><a href="#">{{ $value->name }}</a></h4>
                                        <a href="#" class="btn btn-outline-primary">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection