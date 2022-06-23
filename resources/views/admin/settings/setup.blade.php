@extends('admin.main_content')
@section('settings')
<div class="row" style="margin-left:300px; margin-top:90px;">
    <div class="col-md-2">
        <div class="card-box">
            <div class="page-header">
                <div class="title">
                    <h4>Settings</h4>
                </div>
                <hr>
                <div style="margin-top:20px; font-size: 1.2rem;">
                    <a href="{{route('admin.settings')}}">General Setings</a>
                </div>
                <div style="margin-top:20px; font-size: 1.2rem;">
                    <a href="{{route('admin.company_information')}}">Company Information</a>
                </div>
            </div>
        </div>
    </div>
    @yield('general_settings')
    @yield('company_information_settings')

</div>
@endsection