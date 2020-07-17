<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function seo()
    {
      $seo=DB::table('seo')->first();
      return view('admin.seo.index',compact('seo'));
    }

    public function update(Request $request)
    {
       $id=$request->id;
       $input=array();
       $input['meta_title']=$request->meta_title;
       $input['meta_author']=$request->meta_author;
       $input['meta_tag']=$request->meta_tag;
       $input['meta_description']=$request->meta_description;
       $input['google_analytics']=$request->google_analytics;
       $input['bing_analytics']=$request->bing_analytics;
       DB::table('seo')->where('id',$id)->update($input);
       $notification = array(
        'messege' => 'seo setting updated successfully',
        'alert-type' => 'success'
    );
    return Redirect()->back()->with($notification);
    }
}
