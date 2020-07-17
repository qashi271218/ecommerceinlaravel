<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function contact()
    {
    return view('contact.contactpage');
    }

    public function form(Request $request)
    {
$data=array();
$data['name']=$request->name;
$data['email']=$request->email;
$data['phone']=$request->phone;
$data['message']=$request->message;
DB::table('conatct')->insert($data);

$notification = array(
    'messege' => 'information saved successfully',
    'alert-type' => 'success'
);
return Redirect()->back()->with($notification);
    }

    public function allmessage()
    {
        $message=DB::table('conatct')->get();
return view('admin.contact',compact('message'));
    }
}
