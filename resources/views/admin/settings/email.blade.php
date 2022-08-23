@extends('admin.settings.setup')
@section('settings')
<div class="col-md-10 pr-30">
    <div class="card-box  ">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Email Settings</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Email</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="pd-20 card-box mt-30 mb-30">
        <p class="mb-3" style="color: #777;">These information will be displayed on invoices/estimates/payments and
            other PDF documents
            where company info is required</p>

        {!! Form::open(['route'=>'admin.save_settings_information' ,'method' => 'POST', 'files'=>true ,'id' =>
        'setting_form'])
        !!}
        @csrf
        {!! Form::hidden('emailsettings', 1) !!}
        <div class="row form-group">
            <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">Email Encryption</label>
            <div class="col-sm-12 col-md-6">
                @php
                $email_encryption = 0;
                @endphp
                @if (get_option('email_encryption') == 'TLS')
                @php
                $email_encryption = 2
                @endphp
                @elseif (get_option('email_encryption') == 'SSL')
                @php
                $email_encryption = 1
                @endphp
                @endif
                {!! Form::select('email_encryption',['None','SSL','TLS'], get_option('email_encryption') ?
                $email_encryption:'',[ 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">SMTP Host</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::text('smtp_host', get_option('smtp_host') ? get_option('smtp_host'):
                '',
                ['placeholder' => 'Enter SMTP Host', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">SMTP Port</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::text('smtp_port', get_option('smtp_port') ? get_option('smtp_port'):
                '',
                ['placeholder' => 'Enter SMTP Port', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">Email</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::input('email','email', get_option('email') ? get_option('email'):
                '',
                ['placeholder' => 'Enter Email', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">SMTP Username</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::text('smtp_username', get_option('smtp_username') ?
                get_option('smtp_username'):
                '',
                ['placeholder' => 'Enter SMTP Username', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">SMTP Password</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::input('password','smtp_password', get_option('smtp_password') ? get_option('smtp_password'):
                '',
                ['placeholder' => 'Enter SMTP Password', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">Email Charset</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::text('email_charset', get_option('email_charset') ? get_option('email_charset'):
                'utf-8',
                ['placeholder' => 'Enter Email Charset', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">BCC All Emails To</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::input('email','bcc_email', get_option('bcc_email') ? get_option('bcc_email'):
                '',
                ['placeholder' => 'Enter BCC Emails', 'class' =>'form-control ']) !!}
            </div>
        </div>
        <label class="mt-5" style="font-size: 1.3rem;">Send Test Email</label><br>
        <label style="color: #777;">Send test email to make sure that your SMTP settings is set correctly.</label>
        <div class="row form-group">
            <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">Test Email </label>
            <div class="col-sm-12 col-md-6 mr-0">
                <div class="row">
                    <div class="col-md-10">
                        <input type="email" id="testEmailAddress" class="form-control"
                            placeholder="Enter Test Email Address" />
                    </div>
                    <div class="col-md-2">
                        <button id='testMail' type="button" class="btn btn-warning btn-sm form-control"
                            style="color: white;">Test</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                {!! Form::submit('SUBMIT', ['type'=>'button','class' => 'mt-5 btn btn-info btn-sm
                btn-block
                mb-4']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
    $(document).on('click','#testMail', function() {
            var data ={'email' : $('#testEmailAddress').val()};
            $.ajax({
                type: "post",
                url: "{{route('admin.testemail')}}",
                data: data,
                dataType: "json",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    alert_float(response.icon,response.message);
                }
            });
        });
    });
</script>
@endsection