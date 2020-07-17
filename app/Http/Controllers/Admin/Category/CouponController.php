<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function coupon()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'coupon' => 'required|unique:coupons',
            'discount' => 'required',
        ]);

        $input = $request->all();
        $input['coupon'] = $request->coupon;
        $input['discount'] = $request->discount;
        Coupon::create($input);
        $notification = array(
            'messege' => 'coupon created successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function Deletecoupon($id)
    {
        $coupon = Coupon::findOrfail($id);
        $coupon->delete();
        $notification = array(
            'messege' => 'coupon deleted successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function Editcoupon($id)
    {
        $coupon = Coupon::findOrfail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }
    public function Updatesubcoupon(Request $request, $id)
    {
        $coupon = Coupon::findOrfail($id);
        $input = $request->all();
        $input['coupon'] = $request->coupon;
        $input['discount'] = $request->discount;
        $coupon->update($input);
        $notification = array(
            'messege' => 'coupon updated successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.coupon')->with($notification);
    }
}
