<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('vendors/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('vendors/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('vendors/images/favicon-16x16.png') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/jquery-steps/jquery.steps.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="{{ asset('vendors/images/deskapp-logo.svg') }}" alt="">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ asset('vendors/images/register-page-img.png') }}" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="register-box bg-white box-shadow border-radius-10">
                        <div class="wizard-content">

                            {!! Form::open(['route' => 'admin.admin_registration', 'method' => 'POST', 'files' => true,
                            'class' => 'tab-wizard2 wizard-circle wizard register','id'=>'register']) !!}
                            <h5>Basic Account Credentials</h5>
                            <section>
                                <div class="form-wrap max-width-600 mx-auto">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Email Address*</label>
                                        <div class="col-sm-8">
                                            {!! Form::text('email', null, ['placeholder' => 'Enter Email Address',
                                            'class' => 'form-control email']) !!}
                                        </div>
                                        @if ($errors->has('email'))
                                        <span class="text-danger  " style="font-size: 0.8rem; margin-left:150px;">{{
                                            $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Username*</label>
                                        <div class="col-sm-8">
                                            {!! Form::text('username', null, ['placeholder' => 'Enter Username', 'class'
                                            => 'form-control username']) !!}
                                        </div>
                                        @if ($errors->has('username'))
                                        <span class="text-danger " style="font-size: 0.8rem; margin-left:150px;">{{
                                            $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Password*</label>
                                        <div class="col-sm-8">
                                            {!! Form::password('password',['placeholder' => 'Enter Password', 'class' =>
                                            'form-control password']) !!}
                                        </div>
                                        @if ($errors->has('password'))
                                        <span class="text-danger " style="font-size: 0.8rem; margin-left:150px;">{{
                                            $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Confirm Password*</label>
                                        <div class="col-sm-8">
                                            {!! Form::password('confirm_password',['placeholder' => 'Enter Confirm
                                            Password', 'class' => 'form-control confirm_password']) !!}
                                        </div>
                                        @if ($errors->has('confirm_password'))
                                        <span class="text-danger " style="font-size: 0.8rem; margin-left:150px;">{{
                                            $errors->first('confirm_password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </section>
                            <!-- Step 2 -->
                            <h5>Personal Information</h5>
                            <section>
                                <div class="form-wrap max-width-600 mx-auto">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Full Name*</label>
                                        <div class="col-sm-8">
                                            {!! Form::text('name', null, ['placeholder' => 'Enter Full Name', 'class' =>
                                            'form-control name']) !!}
                                        </div>
                                        @if ($errors->has('name'))
                                        <span class="text-danger " style="font-size: 0.8rem; margin-left:150px;">{{
                                            $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-4 col-form-label">Gender*</label>
                                        <div class="col-sm-8">
                                            <div class="custom-control custom-radio custom-control-inline pb-0">
                                                {!! Form::radio('gender', 'male', '', ['class' => 'custom-control-input
                                                gender', 'id' => 'male']) !!}
                                                <label class="custom-control-label" for="male">Male</label>

                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline pb-0">
                                                {!! Form::radio('gender', 'female', '', ['class' =>
                                                'custom-control-input gender', 'id' => 'female']) !!}
                                                <label class="custom-control-label" for="female">Female</label>
                                            </div>
                                            @if ($errors->has('gender'))
                                            <span class="text-danger " style="font-size: 0.8rem; margin-left:8px;">{{
                                                $errors->first('gender') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">City</label>
                                        <div class="col-sm-8">
                                            {!! Form::text('city', null, ['placeholder' => 'Enter City', 'class' =>
                                            'form-control city']) !!}
                                        </div>
                                        @if ($errors->has('city'))
                                        <span class="text-danger " style="font-size: 0.8rem; margin-left:150px;">{{
                                            $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">State</label>
                                        <div class="col-sm-8">
                                            {!! Form::text('state', null, ['placeholder' => 'Enter State', 'class' =>
                                            'form-control state']) !!}
                                        </div>
                                        @if ($errors->has('state'))
                                        <span class="text-danger " style="font-size: 0.8rem; margin-left:150px;">{{
                                            $errors->first('state') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- success Popup html Start -->
    <button type="button" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal"
        data-backdrop="static">Launch modal</button>
    <div class="modal fade submit_modal" id="success-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered max-width-400" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Form Submitted!</h3>
                    <div class="mb-30 text-center"><img src="{{ asset('vendors/images/success.png') }}"></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </div>
                <div class="modal-footer justify-content-center">
                    {!! Form::submit('submit', ['class' => 'btn btn-primary wow zoomIn']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <!-- success Popup html End -->
    <!-- js -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.register').submit(function (e) { 
            if({{$errors->has('name','email','username','confirm_password','state','city','gender','password')}})
            {
                $('.submit_modal').hide();
                location.reload(true);
            }
                e.preventDefault();
                var action = $(this).attr('action');
                var data = $(this).serialize();
                console.log(data);
                $.ajax({
                    type: "post",
                    url: action,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('src/plugins/jquery-steps/jquery.steps.js') }}"></script>
    <script src="{{ asset('vendors/scripts/steps-setting.js') }}"></script>
</body>

</html>