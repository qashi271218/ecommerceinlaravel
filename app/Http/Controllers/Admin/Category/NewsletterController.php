<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\admin\NewsLetter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function newsletter()
    {
        $newsletters = NewsLetter::all();
        return view('admin.newsletter.index', compact('newsletters'));
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|unique:news_letters',
        ]);
        $input = $request->all();
        $input['email'] = $request->email;
        NewsLetter::create($input);
        $notification = array(
            'messege' => 'thanks for subscribing',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function Delete($id)
    {
        $news = NewsLetter::findOrfail($id);
        $news->delete();
        $notification = array(
            'messege' => 'subscriber deleted successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
