@extends('admin.settings.setup')
@section('settings')
<div class="col-md-10 pr-30">
    <div class="card-box  ">
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
        {{-- <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">General Settings </h4>
                <p class="mb-30">Add some details</p>
            </div>
        </div>
        <hr class="mb-6"> --}}
        {!! Form::open(['route'=>'admin.save_settings' ,'method' => 'POST', 'files'=>true ,'id' =>
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
            <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Company
                Domain</label>
            <div class="col-sm-12 col-md-6">
                {!! Form::url('company_domain', get_option('company_domain') ? get_option('company_domain'):
                '',
                ['placeholder' => 'Enter Company Domain', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Company Logo</label>
            <div class="col-sm-12 col-md-6">
                @if (get_option('light_logo'))
                <div class="row">
                    <div class="col-md-6">
                        <img id="preview-light_logo" src="{{asset('logo/'.get_option('light_logo'))}}"
                            alt=" preview image" style="max-height: 250px;">
                    </div>
                    <div class="col-md-1">
                        <div data-toggle="tooltip" data-image="light_logo" class="delete_image text-danger">
                            <i class="fa fa-remove"></i>
                        </div>
                    </div>
                </div>

                @else
                {!!Form::file('light_logo',['class' => 'custom-file-input' , 'id' => 'light_logo'])!!}
                <label class="custom-file-label">Choose file</label>
                <img id="preview-light_logo" src="" class="my-3" alt="preview image" style="max-height: 250px;">
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label" style="font-size: 1.3rem;">Company Dark
                Logo</label>
            <div class="col-sm-12 col-md-6">
                @if (get_option('dark_logo'))
                <div class="row">
                    <div class="col-md-6">
                        <img id="preview-dark_logo" src="{{asset('logo/'.get_option('dark_logo'))}}"
                            alt=" preview image" style="max-height: 250px;">

                    </div>
                    <div class="col-md-1">
                        <div data-toggle="tooltip" data-image="dark_logo" class="delete_image text-danger">
                            <i class="fa fa-remove"></i>
                        </div>
                    </div>
                </div>
                @else
                {!!Form::file('dark_logo',['class' => 'custom-file-input', 'id' => 'dark_logo'])!!}
                <label class="custom-file-label">Choose file</label>
                <img id="preview-dark_logo" src="" class="my-3" alt="preview image" style="max-height: 250px;">

                @endif
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-12 col-md-3 col-form-label " style="font-size: 1.3rem;">Favicon</label>
            <div class="col-sm-12 col-md-6 custom-file">
                @if (get_option('favicon'))
                <div class="row">
                    <div class="col-md-6">
                        <img id="preview-favicon" src="{{asset('logo/'.get_option('favicon'))}}" alt=" preview image"
                            style="max-height: 250px;">

                    </div>
                    <div class="col-md-1">
                        <div data-toggle="tooltip" data-image="favicon" class="delete_image text-danger"><i
                                class="fa fa-remove"></i></div>
                    </div>
                </div>
                @else
                {!!Form::file('favicon',['class' => 'custom-file-input', 'id' => 'favicon'])!!}
                <label class="custom-file-label">Choose file</label>
                <img id="preview-favicon" src="" class="my-3" alt="preview image" style="max-height: 250px;">

                @endif
            </div>
        </div>
        <div class="row form-group">
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

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('.delete_image').on('click', function() {
            var data = {};
            data['name']=$(this).data('image');
            $.ajax({
                type: "post",
                url: "{{route('admin.remove_settings')}}",
                data: data,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    location.reload()
                }
            });
        });
        if(!$('#preview-light_logo').attr('src'))
        {
            $('#preview-light_logo').hide()
        }
        if(!$('#preview-dark_logo').attr('src'))
        {
            $('#preview-dark_logo').hide()
        }
        if(!$('#preview-favicon').attr('src'))
        {
            $('#preview-favicon').hide()
        }
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