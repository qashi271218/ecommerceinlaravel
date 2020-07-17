@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Ecommerce</a>
          <span class="breadcrumb-item active">Edit Product Section</span>
        </nav>

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Edit Product</h6>
                <form action="{{ url('update/product/'.$products->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_name" value="{{$products->product_name}}">
                            </div>
                          </div><!-- col-4 -->
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_code" value="{{$products->product_code}}">
                            </div>
                          </div><!-- col-4 -->
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_quantity" value="{{$products->product_quantity}}">
                            </div>
                          </div><!-- col-4 -->


                           <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label">Discount Price: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="discount_price" value="{{$products->discount_price}}">
                            </div>
                          </div>


                          <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                   <select class="form-control select2" data-placeholder="Choose country" name="category_id">
                                <option label="Choose Category"></option>
                                @foreach($categories as $row)
                                <option value="{{ $row->id }}" <?php if ($row->id == $products->category_id) {
                                 echo "selected"; } ?> > {{ $row->category_name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Subcategory: <span class="tx-danger">*</span></label>
                   <select class="form-control select2" data-placeholder="Choose country" name="subcategory_id">
                                <option label="Choose Subcategory"></option>
                                @foreach($subcategory as $row)
                                <option value="{{ $row->id }}" <?php if ($row->id == $products->subcategory_id) {
                                 echo "selected"; } ?> > {{ $row->subcategory_name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div><!-- col-4 -->

                          <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                   <select class="form-control select2" data-placeholder="Choose country" name="brand_id">
                    <option label="Choose Brand"></option>
                    @foreach($brand as $row)
                                <option value="{{ $row->id }}" <?php if ($row->id == $products->brand_id) {
                                 echo "selected"; } ?> > {{ $row->brand_name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div><!-- col-4 -->





            <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_size" id="size" data-role="tagsinput" value="{{$products->product_size}}">
                            </div>
                          </div><!-- col-4 -->

            <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="product_color" id="color" data-role="tagsinput" value="{{$products->product_color}}">
                            </div>
                          </div><!-- col-4 -->

                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="selling_price" value="{{$products->selling_price}}" >
                            </div>
                          </div><!-- col-4 -->


                           <div class="col-lg-12">
                            <div class="form-group">
                              <label class="form-control-label">Product Details: <span class="tx-danger">*</span></label>

                        <textarea class="form-control" id="summernote"  name="product_details">{{$products->product_details}}

                         </textarea>

                            </div>
                          </div><!-- col-4 -->

                            <div class="col-lg-12">
                            <div class="form-group">
                              <label class="form-control-label">Video Link: <span class="tx-danger">*</span></label>
                              <input class="form-control" name="video_link" value="{{$products->video_link}}" >
                            </div>
                          </div><!-- col-4 -->



             <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">Image One ( Main Thumbnali): <span class="tx-danger">*</span></label>
                             <label class="custom-file">
                      <input type="file" id="file" class="custom-file-input" name="image_one" onchange="readURL(this);">
                      <span class="custom-file-control"></span>
                      <img src="#" id="one">
                        </label>

                            </div>
                            <img width="50px" height="50px" src="{{url('public/images/product/'.$products->image_one)}}" />

                          </div><!-- col-4 -->




                           <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
                             <label class="custom-file">
                      <input type="file" id="file" class="custom-file-input" name="image_two" onchange="readURL2(this);">
                      <span class="custom-file-control"></span>
                      <img src="#" id="two">
                        </label>

                            </div>
                            <img width="50px" height="50px" src="{{url('public/images/product/'.$products->image_two)}}" />

                          </div><!-- col-4 -->




             <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
                             <label class="custom-file">
                      <input type="file" id="file" class="custom-file-input" name="image_three" onchange="readURL3(this);" >
                      <span class="custom-file-control"></span>
                       <img src="#" id="three">
                        </label>

                            </div>
                            <img width="50px" height="50px" src="{{url('public/images/product/'.$products->image_three)}}" />

                          </div><!-- col-4 -->

                        </div><!-- row -->

                        <div class="col-lg-4">
                            <div class="form-group">
                              <input type="hidden" name="old_image_1" value="{{ $products->image_one }}">
                              <input type="hidden" name="old_image_2" value="{{ $products->image_two }}">
                              <input type="hidden" name="old_image_3" value="{{ $products->image_three }}">

                            </div>

                          </div><!-- col-4 -->

                        </div><!-- row -->

              <hr>
              <br><br>

                      <div class="row">

                    <div class="col-lg-4">
                    <label class="ckbox">
                      <input type="checkbox" name="main_slider" value="1" <?php if($products->main_slider===1){
                       echo "checked";
                      } ?>>
                      <span>Main Slider</span>
                    </label>

                    </div> <!-- col-4 -->

                     <div class="col-lg-4">
                    <label class="ckbox">
                      <input type="checkbox" name="hot_deal" value="1"<?php if($products->hot_deal===1){
                        echo "checked";
                       } ?>>
                      <span>Hot Deal</span>
                    </label>

                    </div> <!-- col-4 -->



                     <div class="col-lg-4">
                    <label class="ckbox">
                      <input type="checkbox" name="best_rated" value="1" <?php if($products->best_rated===1){
                        echo "checked";
                       } ?>>
                      <span>Best Rated</span>
                    </label>

                    </div> <!-- col-4 -->


                     <div class="col-lg-4">
                    <label class="ckbox">
                      <input type="checkbox" name="trend" value="1"<?php if($products->trend===1){
                        echo "checked";
                       } ?>>
                      <span>Trend Product </span>
                    </label>

                    </div> <!-- col-4 -->

             <div class="col-lg-4">
                    <label class="ckbox">
                      <input type="checkbox" name="mid_slider" value="1"<?php if($products->mid_slider===1){
                        echo "checked";
                       } ?>>
                      <span>Mid Slider</span>
                    </label>

                    </div> <!-- col-4 -->

            <div class="col-lg-4">
                    <label class="ckbox">
                      <input type="checkbox" name="hot_new" value="1" <?php if($products->hot_new===1){
                        echo "checked";
                       } ?>>
                      <span>Hot New </span>
                    </label>

                    </div> <!-- col-4 -->


                    <div class="col-lg-4">
                    <label class="ckbox">
                      <input type="checkbox" name="buyone" value="1" <?php if($products->buyone===1){
                        echo "checked";
                       } ?>>
                      <span>Buyone Getone</span>
                    </label>

                    </div> <!-- col-4 -->


                      </div><!-- end row -->
            <br><br>


                        <div class="form-layout-footer">
                          <button class="btn btn-info mg-r-5">Update Form</button>
                          <button class="btn btn-secondary">Cancel</button>
                        </div><!-- form-layout-footer -->
                      </div><!-- form-layout -->
                    </div><!-- card -->
        </form>
        </div>
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
       $('select[name="category_id"]').on('change',function(){
            var category_id = $(this).val();
            if (category_id) {

              $.ajax({
                url: "{{ url('/get/subcategory/') }}/"+category_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                var d =$('select[name="subcategory_id"]').empty();
                $.each(data, function(key, value){

                $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');

                });
                },
              });

            }else{
              alert('danger');
            }

              });
        });

   </script>
   <script type="text/javascript">
    function readURL(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#one')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  <script type="text/javascript">
    function readURL2(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#two')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  <script type="text/javascript">
    function readURL3(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#three')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
      @endsection

