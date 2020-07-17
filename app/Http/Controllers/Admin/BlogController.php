<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Post;
use App\Model\Admin\PostCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $postcategory = PostCategory::all();
        return view('admin.blogcategory.index', compact('postcategory'));
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'category_name_en' => 'required|unique:post_categories',
            'category_name_in' => 'required|unique:post_categories',

        ]);
        $input = $request->all();
        $input['category_name_en'] = $request->category_name_en;
        $input['category_name_in'] = $request->category_name_in;
        PostCategory::create($input);
        $notification = array(
            'messege' => 'post category updated successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function delete($id)
    {
        $blog = PostCategory::findOrfail($id);
        $blog->delete();
        $notification = array(
            'messege' => 'post category deleted successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function edit($id)
    {
        $blog = PostCategory::findOrfail($id);
        return view('admin.blogcategory.edit', compact('blog'));
    }
    public function update(Request $request, $id)
    {
        $blog = PostCategory::findOrfail($id);
        $input = $request->all();
        $input['category_name_en'] = $request->category_name_en;
        $input['category_name_in'] = $request->category_name_in;
        $blog->update($input);
        $notification = array(
            'messege' => 'post category updated successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('blog.category')->with($notification);
    }


}
