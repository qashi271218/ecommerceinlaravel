@extends('layouts.app')
@section('content')
@include('layouts.menubar')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/product_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/product_responsive.css') }}">
	<div class="single_product">
		<div class="container">
			<div class="row">

				<!-- Images -->
				<div class="col-lg-2 order-lg-1 order-2">
					<ul class="image_list">
						<li data-image="{{url('public/images/product/'.$products->image_one) }}"><img src="{{url('public/images/product/'.$products->image_one)}}" alt=""></li>
						<li data-image="{{url('public/images/product/'.$products->image_two)}}"><img src="{{url('public/images/product/'.$products->image_two)}}" alt=""></li>
						<li data-image="{{url('public/images/product/'.$products->image_three)}}"><img src="{{url('public/images/product/'.$products->image_three)}}" alt=""></li>
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
					<div class="image_selected"><img src="{{url('public/images/product/'.$products->image_one)}}" alt=""></div>
				</div>

				<!-- Description -->
				<div class="col-lg-5 order-3">
					<div class="product_description">
						<div class="product_category">{{ $products->category->category_name }} > {{ $products->subcategory->subcategory_name }}</div>
						<div class="product_name">{{ $products->product_name }}</div>
						<div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
						<div class="product_text"><p>{!! str_limit($products->product_details,$limit=300) !!}</p></div>
						<div class="order_info d-flex flex-row">
                            <form action="{{url('add/cart/'.$products->id)}}" method="POST">
                                @csrf
                             <div class="row">
                                 <div class="col-lg-4">
                                     <div class="form-group">
                                         <label for="exampleFormControlSelect1" class="ml-4">Color</label>
                                         <select class="form-control input-lg" id="exampleFormControlSelect1" name="color">
                                             @foreach($product_color as $color)
                                             <option value="{{ $color }}">{{ $color }}</option>
                                             @endforeach
                                         </select>
                                     </div>
                                 </div>
                                 @if($products->product_size==NULL)
                                 @else
                                 <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1" class="ml-4">Size</label>
                                        <select class="form-control input-lg" id="exampleFormControlSelect1" name="size">
                                            @foreach($product_size as $size)
                                            <option value="{{ $size }}">{{ $size }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                @endif
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1" class="ml-4">Quantity</label>
                                       <input class="form-control" type="number" value="1" name="qty" >
                                    </div>
                                </div>
                             </div>

								<div class="product_price">
                                    @if($products->discount_price===NULL)
                                    ${{ $products->selling_price }}
                                    @else
                                    <div>${{ $products->discount_price }}<span><del>${{ $products->selling_price }}</del></span></div>
                                    @endif
                                </div>
								<div class="button_container">
									<button type="submit" class="button cart_button">Add to Cart</button>
									<div class="product_fav"><i class="fas fa-heart"></i></div>
								</div>
<br><br>
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>

							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

    <div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Product Overview</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Video</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                              Review
                            </a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">{!! $products->product_details !!}</div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">{{ $products->video_link }}</div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="fb-comments" data-href="{{ Request::url() }}" data-numposts="5" data-width=""></div>
                        </div>
                      </div>

					</div>
				</div>
			</div>
		</div>
    </div>
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v7.0" nonce="HFvPcoE7"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f0d4abd0025ebe1"></script>

@endsection
