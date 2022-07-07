@extends('admin.main_content')
@section('settings')
<div class="main-container">
    <div class="pd-ltr-20">
        <div class="row">
            <div class="col-md-2">
                <div class="card-box">
                    <div class="page-header">
                        <div class="title">
                            <h4>Settings</h4>
                        </div>
                        <hr>
                        <div style="margin-top:20px; font-size: 1.2rem;">
                            <a href="{{route('admin.settings')}}">General</a>
                        </div>
                        <div style="margin-top:20px; font-size: 1.2rem;">
                            <a href="{{route('admin.company_information')}}">Company Information</a>
                        </div>
                        <div style="margin-top:20px; font-size: 1.2rem;">
                            <a href="{{route('admin.email')}}">Email</a>
                        </div>
                    </div>
                </div>
            </div>
            @yield('general_settings')
            @yield('company_information_settings')
            @yield('email_settings')
        </div>
    </div>
</div>


</div>
@endsection