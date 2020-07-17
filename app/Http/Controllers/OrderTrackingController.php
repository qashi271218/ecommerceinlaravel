<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderTrackingController extends Controller
{
    public function index(Request $request)
    {
        $code = $request->code;
        $track = DB::table('orders')->where('status_code', $code)->first();
        if ($track) {
            return view('pages.tracking', compact('track'));
        } else {
            $notification = array(
                'messege' => 'Invalid Status Code',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function success()
    {
        $order = DB::table('orders')->where('user_id', Auth::id())->where('status', 3)->orderBy('id', 'DESC')->limit(5)->get();
        return view('pages.returnorder', compact('order'));
    }

    public function return($id)
    {
DB::table('orders')->where('id',$id)->update(['return_order'=>1]);
$notification = array(
    'messege' => 'Order return request accept successfully',
    'alert-type' => 'success'
);
return Redirect()->back()->with($notification);
    }
}
