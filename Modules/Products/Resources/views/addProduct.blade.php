<div class="pd-20 card-box mt-30 mb-30">

    <div class="row">
        <div class="col-md-1">
            <img src={{ asset('images/women.jpg') }} alt="" style="border-radius: 100%;" width="100px" height="100px">
        </div>
        <div class="col-md-11">
            <div class="title page-header mt-2">
                <h4 style="font-size: 1.5rem;">Add Women Products</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
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
                    {!! Form::select('email_encryption',$product_category, get_option('email_encryption') ?
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
</div>