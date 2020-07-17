@extends('layouts.app')
@section('content')
@include('layouts.menubar')
@php
    $setting=DB::table('settings')->first();
    $charge=$setting->shipping_charge;
    $carts=Cart::Content();
@endphp
<style>
 /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
 .StripeElement {
  box-sizing: border-box;

  height: 40px;
  width: 100%;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}

</style>
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
                        <form action="{{ route('stripe.charge') }}" method="post" id="payment-form" class="text-center">
                            @csrf
                            <div class="form-row">
                              <label for="card-element">
                                Credit or debit card
                              </label>
                              <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                              </div>

                              <!-- Used to display form errors. -->
                              <div id="card-errors" role="alert"></div>
                            </div>
                            <br>

      <input type="hidden" name="shipping" value="{{ $charge }} ">
       <input type="hidden" name="weight" value="{{ $setting->weight}} ">
       <input type="hidden" name="total" value="{{ Cart::Subtotal() + $charge + $setting->weight }} ">

  <input type="hidden" name="ship_name" value="{{ $data['name'] }} ">
  <input type="hidden" name="ship_phone" value="{{ $data['phone'] }} ">
  <input type="hidden" name="ship_email" value="{{ $data['email'] }} ">
  <input type="hidden" name="ship_address" value="{{ $data['address'] }} ">
  <input type="hidden" name="ship_city" value="{{ $data['city'] }} ">
  <input type="hidden" name="payment_type" value="{{ $data['payment'] }} ">

                            <button class="btn btn-info mt-3">Pay Now</button>
                          </form>

                    </div>
                </div>







            </div>
        </div>
        <div class="panel"></div>
    </div>











    <script>
        // Create a Stripe client.
var stripe = Stripe('pk_test_51GqtrcBVGqGr4quvPK0fa4MaXXFUC436Fhzm8pDyWESiCd48IqnbuPMlEA80Bw3PR4ROcWcgH93hBGgdtBywHRKk00UBqsOYJ5');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
    </script>


@endsection
