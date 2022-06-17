@extends('admin.main_content')
@section('settings')

<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card-box  mb-30">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>General Settings</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">General Settings</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="pd-20 card-box mt-30 mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">General Settings </h4>
                    <p class="mb-30">Add some details</p>
                </div>
            </div>
            <hr class="mb-6">
            {!! Form::open(['route'=>'admin.save_settings' ,'method' => 'POST', 'files'=>true ]) !!}
            <div class="row form-group">
                <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Company Name</label>
                <div class="col-sm-12 col-md-9">
                    {!! Form::text('company_name', null, ['placeholder' => 'Enter Company Name', 'class' =>
                    'form-control ']) !!}
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Company Domain</label>
                <div class="col-sm-12 col-md-9">
                    {!! Form::text('company_domain', null, ['placeholder' => 'Enter Company Domain', 'class' =>
                    'form-control ']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Company Logo</label>
                <div class="col-sm-12 col-md-9">
                    {!!Form::file('light_logo',['class' => 'form-control', 'id' => 'light_logo'])!!}
                    <img id="preview-light_logo" src="" alt="preview image" style="max-height: 250px;">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Company Dark Logo</label>
                <div class="col-sm-12 col-md-9">
                    {!!Form::file('dark_logo',['class' => 'form-control', 'id' => 'dark_logo'])!!}
                    <img id="preview-dark_logo" src="" alt="preview image" style="max-height: 250px;">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Favicon</label>
                <div class="col-sm-12 col-md-9">
                    {!!Form::file('favicon',['class' => 'form-control', 'id' => 'favicon'])!!}
                    <img id="preview-favicon" src="" alt="preview image" style="max-height: 250px;">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3"></div>
                <div class="col-md-2">
                    {!! Form::submit('ADD', ['class' => 'btn btn-primary btn-sm btn-block mb-4','style' =>
                    'font-color:black ']) !!}

                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#preview-light_logo').hide();
        $('#preview-dark_logo').hide();
        $('#preview-favicon').hide();

        $('#light_logo').change(function (){
            $('#preview-light_logo').show();
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#preview-light_logo').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
        $('#dark_logo').change(function (){
            $('#preview-dark_logo').show();
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#preview-dark_logo').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
        $('#favicon').change(function (){
            $('#preview-favicon').show();
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#preview-favicon').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });
</script>
@endsection