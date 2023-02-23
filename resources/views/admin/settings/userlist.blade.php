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
                        <button class="edit-avatar editUser" data-id=""><i
                                class="fa fa-pencil"></i></button>
                        <img src="{{asset('images/userimg.jpg')}}" alt="" class="avatar-photo profileImage">
                    </div>
                    <h5 class="text-center h5 mb-0 userName"></h5>
                    <div class="profile-social">
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                <div class="card-box height-100-p overflow-hidden">
                    <div class="profile-tab height-100-p">
                        <div class="row mt-3">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <button class="btn btn-danger btn-sm backBtn"><i
                                        class="icon-copy fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i>
                                    Back</button>
                            </div>
                        </div>
                        <div class="row m-5">
                            <div class="col-md-6 mb-20">
                                <h5 class=" h5 text-blue">Email</h5>
                                <h6 class="userEmail"> </h6>
                            </div>
                            <div class="col-md-6 mb-20">
                                <h5 class=" h5 text-blue">Address</h5>
                                <h6 class="userAddress">-</h6>
                            </div>
                            <div class="col-md-6 mb-20">
                                <h5 class="h5 text-blue">Contact Information</h5>
                                <h6 class="userPhonenumber">-</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pd-20 card-box mt-30 mb-30 userlist">
        <div class="row">
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <button type="button" class="btn btn-success" id="adduser">
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
                                        <h4 class="ml-2 "><a href="#" data-id='{{$value->id}}' id="viewprofile">{{
                                                $value->name }}</a></h4>
                                        <a href="#" class="btn btn-outline-primary" id="viewprofile"
                                            data-id='{{$value->id}}'>View Profile</a>
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
    <div class="user_form">

    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('.profileview').hide();
        $(document).on('click','.backBtn', function () {
            $('.profileview').hide();
            $('.userlist').show();
        });
        $(document).on('click','#viewprofile', function () {
            $('.profileview').show();
            $('.userlist').hide();
            var data = {id:$(this).data('id')};
            $.ajax({
                type: "post",
                url: "{{route('admin.getuserinfo')}}",
                data: data,
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                        console.log(data);
                        $('.userName').text(data.name);
                        $('.userEmail').text(data.email);
                        $('.editUser').attr("data-id", data.id);
                        if (data.profileImage !== null && data.profileImage !== '') {
                            var url = '/' + data.id+ '/' + data.profileImage;
                            $(".profileImage").attr("src", '{{asset("UserImages")}}'+url);
                        }
                        else
                        {
                            $(".profileImage").attr("src", "{{asset('images/userimg.jpg')}}");
                        }
                        if (data.address !== null && data.address !== '') {
                            $(".userAddress").text(data.address);
                        }
                        else{
                            $(".userAddress").text('-');
                        }
                        if (data.phonenumber !== null && data.phonenumber !== '') {
                            $(".userPhonenumber").text(data.phonenumber);
                        }
                        else{
                            $(".userPhonenumber").text('-');
                        }
                        htmlStr = "<h5 class='mb-10 h5 text-blue'>Social Links</h5>";
                        htmlStr += " <ul class='clearfix'>";
                        if (data.facebookLink !== null && data.facebookLink !== '') {
                            htmlStr += "<li><a href='"+data.facebookLink+"' target='_blank' class='btn' data-bgcolor='#3b5998' data-color='#ffffff' style='color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);'>";
                            htmlStr += "<i class='fa fa-facebook'></i></a></li>";
                        }
                        if (data.instagramLink !== null && data.instagramLink !== '') {
                            htmlStr += "<li><a href='"+data.instagramLink+"' target='_blank' class='btn' data-bgcolor='#f46f30' data-color='#ffffff' style='color: rgb(255, 255, 255); background-color: rgb(244, 111, 48);'>";
                            htmlStr += "<i class='fa fa-instagram'></i></a></li>";
                        }
                        if (data.linkedInLink !== null && data.linkedInLink !== '') {
                            htmlStr += "<li><a href='"+data.linkedInLink+"' target='_blank' class='btn' data-bgcolor='#007bb5' data-color='#ffffff' style='color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);'>";
                            htmlStr += "<i class='fa fa-linkedin'></i></a></li>";
                        }
                        if (data.twitterLink !== null && data.twitterLink !== '') {
                            htmlStr += "<li><a href='"+data.twitterLink+"' target='_blank' class='btn' data-bgcolor='#1da1f2' data-color='#ffffff' style='color: rgb(255, 255, 255); background-color: rgb(29, 161, 242);''>";
                            htmlStr += "<i class='fa fa-twitter'></i></a></li>";
                        }
                        if (data.skypeLink !== null && data.skypeLink !== '') {
                            htmlStr += "<li><a href='"+data.skypeLink+"' target='_blank' class='btn' data-bgcolor='#00aff0' data-color='#ffffff' style='color: rgb(255, 255, 255); background-color: rgb(0, 175, 240);''>";
                            htmlStr += "<i class='fa fa-skype'></i></a></li>";
                        }
                        htmlStr += "</ul>";
                       $(".profile-social").html(htmlStr);
                        
                }
            });
        });
        $(document).on('click','#adduser', function () {
            $('.userlist').hide();
            $('.profileview').hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var csrf = {
                csrf: $('meta[name="csrf-token"]').attr('content')
            };
            $('.user_form').show();
            $('.user_form').load("{{ route('admin.userForm') }}", csrf);

        });
    });
    $(document).on('click', '.editUser', function() {
        $('.userlist').hide();
        $('.profileview').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = {
        id: $(this).data('id'),
        csrf: $('meta[name="csrf-token"]').attr('content')
        };
        $('.user_form').show();
        $('.user_form').load("{{ route('admin.userForm') }}", id);
    });
    
</script>
@endsection