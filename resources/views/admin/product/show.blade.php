@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Ecommerce</a>
          <span class="breadcrumb-item active">Product Section</span>
        </nav>

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">View Product</h6>
                    <div class="form-layout">
                        <div class="row mg-b-25">
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                              <strong>{{ $product->product_name }}</strong>
                            </div>
                          </div><!-- col-4 -->
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                              <strong>{{ $product->product_code }}</strong>
                            </div>
                          </div><!-- col-4 -->
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                              <strong>{{ $product->product_quantity }}</strong>
                            </div>
                          </div><!-- col-4 -->


                            <div class="col-lg-3">
                            <div class="form-group">
                              <label class="form-control-label">Discount Price: <span class="tx-danger">*</span></label>
                              <strong>{{ $product->discount_price }}</strong>

                            </div>
                          </div>


                          <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                              <strong>{{$product->category->category_name }}</strong>
                            </div>
                          </div><!-- col-4 -->


                          <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                               <label class="form-control-label">Sub Category:
                                   <span class="tx-danger">*</span></label>
                                   <strong>{{$product->subcategory->subcategory_name }}</strong>
                                </div>
                          </div><!-- col-4 -->



                          <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                              <strong>{{$product->brand->brand_name }}</strong>
                            </div>
                          </div><!-- col-4 -->


            <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                              <strong>{{$product->product_size }}</strong>
                            </div>
                          </div><!-- col-4 -->

            <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                              <strong>{{$product->product_color }}</strong>
                            </div>
                          </div><!-- col-4 -->

                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
                              <strong>{{$product->selling_price }}</strong>
                            </div>
                          </div><!-- col-4 -->


                           <div class="col-lg-12">
                            <div class="form-group">
                              <label class="form-control-label">Product Details: <span class="tx-danger">*</span></label>

                              <strong>{{$product->product_details }}</strong>

                            </div>
                          </div><!-- col-4 -->

                            <div class="col-lg-12">
                            <div class="form-group">
                              <label class="form-control-label">Video Link: <span class="tx-danger">*</span></label>
                              <strong>{{$product->video_link }}</strong>
                            </div>
                          </div><!-- col-4 -->


                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">1st Image: <span class="tx-danger">*</span></label>
                              <img src="{{url('public//images/product/'.$product->image_one)}}" />
                            </div>
                          </div><!-- col-4 -->



                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">2nd Image: <span class="tx-danger">*</span></label>
                              <img src="{{url('public//images/product/'.$product->image_two)}}" />
                            </div>
                          </div><!-- col-4 -->




                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">3rd Image: <span class="tx-danger">*</span></label>
                              <img src="{{url('public//images/product/'.$product->image_three)}}" />
                            </div>
                          </div><!-- col-4 -->

                        </div><!-- row -->

              <hr>
              <br><br>

                      <div class="row">

                    <div class="col-lg-4">
                    <label class="">
                        @if($product->main_slider===1)
                        <span class="bt btn-success">Active</span>
                        @else
                        <span class="bt btn-danger">Inctive</span>

                        @endif
                      <span>Main Slider</span>
                    </label>

                    </div> <!-- col-4 -->

                     <div class="col-lg-4">
                        <label class="">
                            @if($product->hot_deal===1)
                            <span class="bt btn-success">Active</span>
                            @else
                            <span class="bt btn-danger">Inctive</span>

                            @endif
                      <span>Hot Deal</span>
                    </label>

                    </div> <!-- col-4 -->



                     <div class="col-lg-4">
                        <label class="">
                            @if($product->best_rated===1)
                            <span class="bt btn-success">Active</span>
                            @else
                            <span class="bt btn-danger">Active</span>

                            @endif
                                                 <span>Best Rated</span>
                    </label>

                    </div> <!-- col-4 -->


                     <div class="col-lg-4">
                        <label class="">
                            @if($product->trend===1)
                            <span class="bt btn-success">Active</span>
                            @else
                            <span class="bt btn-danger">Active</span>

                            @endif                      <span>Trend Product </span>
                    </label>

                    </div> <!-- col-4 -->

             <div class="col-lg-4">
                <label class="">
                    @if($product->mid_slider===1)
                    <span class="bt btn-success">Active</span>
                    @else
                    <span class="bt btn-danger">Active</span>

                    @endif
                      <span>Mid Slider</span>
                    </label>

                    </div> <!-- col-4 -->

            <div class="col-lg-4">
                <label class="">
                    @if($product->hot_new===1)
                    <span class="bt btn-success">Active</span>
                    @else
                    <span class="bt btn-danger">Active</span>

                    @endif
                      <span>Hot New </span>
                    </label>

                    </div> <!-- col-4 -->


                    {{-- <div class="col-lg-4">
                    <label class="ckbox">
                      <input type="checkbox" name="buyone_getone" value="1">
                      <span>Buyone Getone</span>
                    </label>

                    </div> <!-- col-4 --> --}}


                      </div><!-- end row -->
            <br><br>

                      </div><!-- form-layout -->
                    </div><!-- card -->
        </div>
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->

      @endsection
