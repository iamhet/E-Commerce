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
    <hr>
    <div class="row mt-5">
        <div class="col-md-12">
            {!! Form::open(['route'=>'admin.save_settings_information' ,'method' => 'POST', 'files'=>true ,'id' =>
            'setting_form'])
            !!}
            @csrf
            {!! Form::hidden('productId', '') !!}
            <div class="row form-group">
                <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">Product Category</label>
                <div class="col-sm-12 col-md-6">
                    {!! Form::select('productCategory',$product_category,'',[ 'class' =>'form-control ']) !!}
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">Product Name</label>
                <div class="col-sm-12 col-md-6">
                    {!! Form::text('productName', '',['placeholder' => 'Enter Product Name', 'class' =>'form-control '])
                    !!}
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">Product Details</label>
                <div class="col-sm-12 col-md-6">
                    {!! Form::textarea('productDetails', '', ['class' => 'form-control',]) !!}
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
            <div class="row">
                <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">Product Details</label>
                <div class="col-md-6">
                    <form class="dropzone" action="#" id="productImages">
                        @csrf
                        <div class="fallback ">
                            <input type="file" name="file" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    Dropzone.autoDiscover = false;
		$(".dropzone").dropzone({
			addRemoveLinks: true,
            maxFilesize: 5,
            chunking: true,
            chunkSize: 500000,
            retryChunks: true,
            retryChunksLimit: 3, 
			removedfile: function(file) {
                file.previewElement.remove();
            }
		});
</script>