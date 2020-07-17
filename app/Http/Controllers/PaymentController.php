<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Config;
use Session;

class PaymentController extends Controller
{
    public function index()
    {
        $carts = Cart::Content();
        return view('pages.payment', compact('carts'));
    }
    public function payment(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['payment'] = $request->payment;
        if ($request->payment == 'stripe') {
            return view('payment.stripe', compact('data'));
        } elseif ($request->payment == 'paypal') {
        } elseif ($request->payment == 'ideal') {
        } else {
            echo "cash on delievery";
        }
    }

    public function transaction(Request $request)
    {
        $total = $request->total;
        \Stripe\Stripe::setApiKey('sk_test_51GqtrcBVGqGr4quvhjsKOpnbjkRlb2XdW8BAdMXekkvQyi2bNNNV41CWytfdRaf3vEkhBh6gEVsqY4klXIPNJ2iv00YDChQncn');
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'description' => 'Software development services',
            'shipping' => [
                'name' => 'Jenny Rosen',
                'address' => [
                    'line1' => '510 Townsend St',
                    'postal_code' => '98140',
                    'city' => 'San Francisco',
                    'state' => 'CA',
                    'country' => 'US',
                ],
            ],
            'amount' => $total * 100,
            'currency' => 'usd',
            'description' => 'Udemy charge',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        $data = array();
        $data['user_id'] = Auth::id();
        $data['payment_id'] = $charge->payment_method;
        $data['paying_amount'] = $charge->amount;
        $data['amount_transaction'] = $charge->balance_transaction;
        $data['stripe_order_id'] = $charge->metadata->order_id;
        $data['shipping'] = $request->shipping;
        $data['weight'] = $request->weight;
        $data['total'] = $request->total;
        $data['payment_type'] = $request->payment_type;
        $data['status_code'] = mt_rand(100000,999999);
        if (Session::has('coupon')) {
            $data['subtotal'] = Session::get('coupon')['balance'];
        } else {
            $data['subtotal'] = Cart::Subtotal();
        }
        $data['status'] = 0;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $order_id = DB::table('orders')->insertGetId($data);

        //     /// Insert Shipping Table

        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        DB::table('shipping')->insert($shipping);

        //Insert order details
        $cart = Cart::Content();
        $details = array();
        foreach ($cart as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['singleprice'] = $row->price;
            $details['totalprice'] = $row->qty * $row->price;
            DB::table('orders_details')->insert($details);
        }
        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notification = array(
            'messege' => 'Order Process Successfully Done',
            'alert-type' => 'success'
        );
        return Redirect()->to('/')->with($notification);
    }
}
