<div class="pd-20 card-box mt-30 mb-30">
    <div class="row">
        <div class="col-md-1">
            <img src='' alt="img" class="genderImage" style="border-radius: 100%; height :100px !important;">
        </div>
        <div class="col-md-10">
            <div class="title page-header mt-2">
                <h4 style="font-size: 1.5rem;" class="addProductTitle">Add Women Products</h4>
            </div>
        </div>
        <div class="col-md-1">
            <button class="btn btn-danger btn-sm backButton"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back</button>
        </div>
    </div>
    <hr>
    <div class="row mt-5">
        <div class="col-md-12">
            {!! Form::open(['route'=>'admin.saveProduct' ,'method' => 'POST', 'files'=>true ,'id' =>
            'productForm'])
            !!}
            @csrf
            {!! Form::hidden('productId', '') !!}
            <div class="row form-group">
                <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">Product Category</label>
                <div class="col-sm-12 col-md-6">
                    <select class="form-control " name="productCategory">
                        @foreach ($result as $item)
                        <option value="{{$item->id}}">{{$item->category_name}}</option>
                        @endforeach
                    </select>
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
                <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">Product Price</label>
                <div class="col-sm-12 col-md-6">
                    {!! Form::input('number','productPrice', '100',['placeholder' => 'Enter Product Price', 'class'
                    =>'form-control '])
                    !!}
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">Product Details</label>
                <div class="col-sm-12 col-md-6">
                    {!! Form::textarea('productDetails', '', ['placeholder' => 'Enter Product Detail','class' =>
                    'form-control',]) !!}
                </div>
            </div>
            <div class="row form-group addImages">
                <label class="col-sm-12 col-md-2 col-form-label" style="font-size: 1rem;">Product Images</label>
                <div class="col-sm-12 col-md-6">
                    <a href="#" data-toggle="modal" data-target="#productImageModal">
                        <img src={{ asset('images/addImage.png') }} width="100px" height="100px"/>
                    </a>
                    
                </div>
            </div>
            {!! Form::close() !!}
            <div class="row mt-5">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <button class="btn btn-info " onclick="submitform()"><span class="accept"></span>ADD
                        PRODUCT</button>
                </div>
            </div>


            <div class="modal fade" id="productImageModal" tabindex="-1" role="dialog"
                aria-labelledby="productImageModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productImageModalLabel">Add Images</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="dropzone" action="{{route('admin.saveProductImages')}}"
                                        id="productImages">
                                        @csrf
                                        <input type="hidden" name="product_id" id="product_id" value="2" />
                                        <div class="fallback ">
                                            <input type="file" name="productImage" id="productImage" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary add_product_image">Add Images</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('.addImages').hide();
        $(document).on('click','.add_product_image', function () {
            $('#productImageModal').modal('hide');
            window.location.replace("{{route('admin.viewProducts')}}");   
            alert_float('success','Product Images Uploaded Successfull');
        });
    });
    function submitform(){
        $.ajax({
            type: "post",
            url: "{{route('admin.saveProduct')}}",
            data: $('#productForm').serialize(),
            dataType: "json",
            success: function (response) {
                if(response.success){
                    $('.addImages').show();
                    $('#product_id').val(response.productId);
                }
            }
        });
    }
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