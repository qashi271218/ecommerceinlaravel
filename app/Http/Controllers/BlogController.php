<?php

namespace App\Http\Controllers;

use App\Model\Admin\Post;
use Session;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog()
    {
        $post=Post::all();
        return view('pages.blog',compact('post'));
    }
    public function english()
    {
  Session::get('lang');
  Session()->forget('lang');
  Session::put('lang','english');
  return redirect()->back();
    }
    public function hindi()
    {
        Session::get('lang');
  Session()->forget('lang');
  Session::put('lang','hindi');
  return redirect()->back();
    }

    public function view($id)
    {
           $post=Post::findOrfail($id);
           return view('pages.single',compact('post'));
    }

}
