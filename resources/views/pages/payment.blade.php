@extends('layouts.app')
@section('content')
@include('layouts.menubar')
@php
    $setting=DB::table('settings')->first();
    $charge=$setting->shipping_charge;
@endphp
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_styles.css') }} ">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_responsive.css') }}">

<div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-7" style="border: 1px solid grey; padding: 20px; border-radius: 25px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">Product Details</div>
                        @foreach($carts as $cart)
                        <ul class="list-group">
                            <li class="list-group-item">Image:<span style="float:right;"><img src="{{ url('public/images/product/'.$cart->options->image) }}" alt="" style="width:50px;height:50px;"></span></li>
                            <li class="list-group-item">Name:<span style="float:right;">{{ $cart->name }}</span></li>
                            @if($cart->options->color==NULL)
                            @else
                            <li class="list-group-item">Color:<span style="float:right;">{{ $cart->options->color }}</span></li>
                            @endif
                            @if($cart->options->size==NULL)
                            @else
                            <li class="list-group-item">Size:<span style="float:right;">{{ $cart->options->size }}</span></li>
                            @endif
                            <li class="list-group-item">Quantity:<span style="float:right;">{{ $cart->qty}}</span></li>
                            <li class="list-group-item">Price:<span style="float:right;">${{ $cart->price }}</span></li>
                            @if(Session::has('coupon'))
                        <li class="list-group-item">subtotal:<span style="float:right;">${{Session::get('coupon')['balance']}}</span></li>
                        <li class="list-group-item">Coupon:({{Session::get('coupon')['name']}})
                            <a href="{{ route('coupon.remove') }}" class="btn btn-danger btn-sm">x</a>
                            <span style="float:right;">${{Session::get('coupon')['discount']}}</span></li>
                        @else
                        <li class="list-group-item">Total:<span style="float:right;">${{Cart::Subtotal()}}</span></li>
                        @endif
                 <li class="list-group-item">Shipping charge:<span style="float:right;">${{ $charge }}</span></li>
                  <li class="list-group-item">weight:<span style="float:right;">{{ $setting->weight }}</span></li>
                  @if(Session::has('coupon'))
                  <li class="list-group-item">total:<span style="float:right;">${{Session::get('coupon')['balance'] + $charge}}</span></li>
                  @else
                  <li class="list-group-item">total:<span style="float:right;">${{ Cart::Subtotal() + $charge }}</span></li>
                  @endif
                  @if(Session::has('coupon'))
                        @else
                  <form method="POST" action="{{ route('apply.coupon') }}">
                    @csrf
                <div class="input-group mt-2">
                    <input type="text" name="coupon" class="form-control" required placeholder="coupon" id="inlineFormInputGroup">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-success input-group-text">Apply</button>
                    </div>
                  </div>
                </form>
                @endif
                        </ul>
                        @endforeach


                    </div>
                </div>


                <div class="col-lg-5" style="border: 1px solid grey; padding: 20px; border-radius: 25px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">Shipping Address</div>

         <form action="{{ route('payment.process') }}" id="contact_form" method="post">
             @csrf

          <div class="form-group">
    <label for="exampleInputEmail1">Full Name</label>
    <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Your Full Name " name="name" required="">
         </div>


         <div class="form-group">
    <label for="exampleInputEmail1">Phone</label>
    <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Your Phone " name="phone" required="">
         </div>


         <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Your Email " name="email" required="">
         </div>


         <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Your Address" name="address" required="">
         </div>



         <div class="form-group">
    <label for="exampleInputEmail1">City</label>
    <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Your City" name="city" required="">
         </div>

    <div class="contact_form_title text-center"> Payment By </div>
    <div class="form-group">
        <ul class="logos_list">
            <li><input type="radio" name="payment" value="stripe"><img src="{{ asset('public/frontend/images/mastercard.png') }}" style="width: 100px; height: 60px;"> </li>

             <li><input type="radio" name="payment" value="paypal"><img src="{{ asset('public/frontend/images/paypal.png') }}" style="width: 100px; height: 60px;"> </li>

              <li><input type="radio" name="payment" value="ideal"><img src="{{ asset('public/frontend/images/mollie.png') }}" style="width: 100px; height: 60px;"> </li>

        </ul>

    </div>


                            <div class="contact_form_button text-center">
        <button type="submit" class="btn btn-info">Pay Now</button>
                            </div>
                        </form>

                    </div>
                </div>







            </div>
        </div>
        <div class="panel"></div>
    </div>












@endsection
