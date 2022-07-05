@extends('admin.settings.setup')
@section('company_information_settings')
<div class="col-md-10 pr-30">
    <div class="card-box  ">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Company Information</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Company Information Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="pd-20 card-box mt-30 mb-30">
        <p class="mb-30">These information will be displayed on invoices/estimates/payments and other PDF documents
            where company info is required</p>

        {!! Form::open(['route'=>'admin.save_settings_information' ,'method' => 'POST', 'files'=>true ,'id' =>
        'setting_form'])
        !!}
        <div class="row form-group">
            <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Company Name</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::text('company_name', get_option('company_name') ? get_option('company_name'):
                '',
                ['placeholder' => 'Enter Company Name', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Address</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::text('company_address', get_option('company_address') ? get_option('company_address'):
                '',
                ['placeholder' => 'Enter Company Address', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">City</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::text('company_city', get_option('company_city') ? get_option('company_city'):
                '',
                ['placeholder' => 'Enter City', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">State</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::text('company_state', get_option('company_state') ? get_option('company_state'):
                '',
                ['placeholder' => 'Enter State', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Country Code</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::text('company_country_code', get_option('company_country_code') ?
                get_option('company_country_code'):
                '',
                ['placeholder' => 'Enter Country Code', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Zip Code</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::text('company_zip_code', get_option('company_zip_code') ? get_option('company_zip_code'):
                '',
                ['placeholder' => 'Enter Zip Code', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Phone</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::text('company_phone', get_option('company_phone') ? get_option('company_phone'):
                '',
                ['placeholder' => 'Enter Phone', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2">
                {!! Form::submit('SUBMIT', ['type'=>'button','class' => 'mt-5 btn btn-info btn-sm
                btn-block
                mb-4','style' =>
                'font-color:black ']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@endsection