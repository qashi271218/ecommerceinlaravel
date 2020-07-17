@extends('layouts.app')
@section('content')
@include('layouts.menubar')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_responsive.css') }}">
<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart_container">
                    <div class="cart_title">Shopping Cart</div>
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
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            <div class="order_total_amount">${{ Cart::total() }}</div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <button type="button" class="button cart_button_clear">Remove from Cart</button>
                        <a href="{{ route('user.checkout') }}" class="button cart_button_checkout">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/frontend/js/cart_custom.js') }}"></script>
@endsection
