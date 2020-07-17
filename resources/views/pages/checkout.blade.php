@extends('layouts.app')
@section('content')
@include('layouts.menubar')
@php
    $setting=DB::table('settings')->first();
    $charge=$setting->shipping_charge;
@endphp
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_responsive.css') }}">
<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart_container">
                    <div class="cart_title">Checkout Page</div>
                    <div class="cart_items">
                        <ul class="cart_list">
                            @foreach($carts as $cart)
                            <li class="cart_item clearfix">
                                <div class="cart_item_image"><img src="{{ url('public/images/product/'.$cart->options->image) }}" alt=""></div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_title">Name</div>
                                        <div class="cart_item_text">{{ $cart->name }}</div>
                                    </div>
                                    @if($cart->options->color==NULL)
                                        @else
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_title">Color</div>
                                        <div class="cart_item_text">{{ $cart->options->color }}</div>
                                    </div>
                                    @endif
                                    @if($cart->options->size==NULL)
                                        @else
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_title">Size</div>
                                        <div class="cart_item_text">{{ $cart->options->size }}</div>
                                    </div>
                                    @endif
                                    <div class="cart_item_quantity cart_info_col">
                                        <div class="cart_item_title">Quantity</div><br>
                                        <form action="{{ route('update.quantity') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="productid" value="{{ $cart->rowId}}">
                                    <input type="number" name="qty" value="{{ $cart->qty }}"style="width:50px;">
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check-square"></i></button>
                                        </form>
                                        {{-- <div class="cart_item_text">{{ $cart->qty }}</div> --}}
                                    </div>
                                    <div class="cart_item_price cart_info_col">
                                        <div class="cart_item_title">Price</div>
                                        <div class="cart_item_text">${{$cart->price}}</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title">Total</div>
                                        <div class="cart_item_text">${{ $cart->price * $cart->qty }}</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title mb-3">Action</div><br>
                                    <a href="{{url('remove/cart/'.$cart->rowId)}}" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Order Total -->
                    {{-- <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            <div class="order_total_amount">${{ Cart::total() }}</div>
                        </div>
                    </div> --}}
                    <div class="row">
                    <div class="order_total_content" style="padding:15px;">
                        @if(Session::has('coupon'))
                        @else
                        <h5 class="ml-3">Apply Coupon</h5>
                      <form method="POST" action="{{ route('apply.coupon') }}">
                        @csrf
                        <div class="form-group col-lg-8">
                            <input type="text" name="coupon" class="form-control" required placeholder="Enter coupon">

                        </div>
                        <button type="submit" class="btn btn-success ml-3">Submit</button>
                      </form>
                      @endif
                    </div>
                    <ul class="list-group col-lg-4 ml-auto">
                        @if(Session::has('coupon'))
                        <li class="list-group-item">subtotal:<span style="float:right;">${{Session::get('coupon')['balance']}}</span></li>
                        <li class="list-group-item">Coupon:({{Session::get('coupon')['name']}})
                            <a href="{{ route('coupon.remove') }}" class="btn btn-danger btn-sm">x</a>
                            <span style="float:right;">${{Session::get('coupon')['discount']}}</span></li>
                        @else
                        <li class="list-group-item">subtotal:<span style="float:right;">${{Cart::Subtotal()}}</span></li>
                        @endif
                 <li class="list-group-item">Shipping charge:<span style="float:right;">${{ $charge }}</span></li>
                  <li class="list-group-item">weight:<span style="float:right;">{{ $setting->weight }}</span></li>
                  @if(Session::has('coupon'))
                  <li class="list-group-item">total:<span style="float:right;">${{Session::get('coupon')['balance'] + $charge}}</span></li>
                  @else
                  <li class="list-group-item">total:<span style="float:right;">${{ Cart::Subtotal() + $charge }}</span></li>
                  @endif


                    </ul>
                </div>
                    <div class="cart_buttons">
                        <button type="button" class="button cart_button_clear">All Cancel</button>
                        <a href="{{ route('user.payment') }}" class="button cart_button_checkout">Payment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/frontend/js/cart_custom.js') }}"></script>
@endsection
