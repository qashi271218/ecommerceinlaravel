<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FacadesAuth;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function changePassword()
    {
        return view('auth.changepassword');
    }

    public function updatePassword(Request $request)
    {
        $password = Auth::user()->password;
        $oldpass = $request->oldpass;
        $newpass = $request->password;
        $confirm = $request->password_confirmation;
        if (Hash::check($oldpass, $password)) {
            if ($newpass === $confirm) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();
                $notification = array(
                    'messege' => 'Password Changed Successfully ! Now Login with Your New Password',
                    'alert-type' => 'success'
                );
                return Redirect()->route('login')->with($notification);
            } else {
                $notification = array(
                    'messege' => 'New password and Confirm Password not matched!',
                    'alert-type' => 'error'
                );
                return Redirect()->back()->with($notification);
            }
        } else {
            $notification = array(
                'messege' => 'Old Password not matched!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function Logout()
    {
        // $logout= Auth::logout();
        Auth::logout();
        $notification = array(
            'messege' => 'Successfully Logout',
            'alert-type' => 'success'
        );
        return Redirect()->route('login')->with($notification);
    }

    public function view($id)
    {
       $order=DB::table('orders')
            ->join('users','orders.user_id','users.id')
            ->select('orders.*','users.name','users.phone')
            ->where('orders.id',$id)->first();
        $shipping=DB::table('shipping')->where('order_id',$id)->first();

        $details=DB::table('orders_details')
               ->join('products','orders_details.product_id','products.id')
               ->select('orders_details.*','products.product_code','products.image_one')
               ->where('orders_details.order_id',$id)->get();
               return view('admin.orders.view',compact('order','shipping','details'));
    }
}
