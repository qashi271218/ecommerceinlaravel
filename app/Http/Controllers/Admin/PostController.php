<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use App\Model\Admin\Post;
use App\Model\Admin\PostCategory;
use Illuminate\Http\Request;
use Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function post()
    {

        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $blogs = PostCategory::all();
        return view('admin.post.create', compact('blogs'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'postcategory_id' => 'required',
            'post_title_en' => 'required',
            'post_title_in' => 'required',
            'details_en' => 'required',
            'details_in' => 'required',
            'post_image' => 'required',
        ]);
        $input = $request->all();
        $input['postcategory_id'] = $request->postcategory_id;
        $input['post_title_en'] = $request->post_title_en;
        $input['post_title_in'] = $request->post_title_in;
        $input['details_en'] = $request->details_en;
        $input['details_in'] = $request->details_in;
        $input['post_image'] = $request->post_image;
        if ($file = $request->file('post_image')) {
            $name = $file->getClientOriginalName();
            Image::make($file->getRealPath())->resize(300, 300)->save('public/images/post/' . $name);

            $input['post_image'] = $name;
        }

        Post::create($input);
        $notification = array(
            'messege' => 'Post created successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.post')->with($notification);
    }

    public function delete($id)
    {
        $post = Post::findOrfail($id);
        unlink(public_path() . "/images/post/" . $post->post_image);
        $post->delete();
        $notification = array(
            'messege' => 'Post deleted successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $blogs = PostCategory::all();
        $post = Post::findOrfail($id);
        return view('admin.post.edit', compact('post', 'blogs'));
    }
    public function update(Request $request, $id)
    {
        $post = Post::findOrfail($id);
        $input = $request->all();
        $input['postcategory_id'] = $request->postcategory_id;
        $input['post_title_en'] = $request->post_title_en;
        $input['post_title_in'] = $request->post_title_in;
        $input['details_en'] = $request->details_en;
        $input['details_in'] = $request->details_in;
        if ($file = $request->file('post_image')) {
            unlink(public_path() . "/images/post/" . $request->old_image);

            $name = $file->getClientOriginalName();
            Image::make($file->getRealPath())->resize(300, 300)->save('public/images/post/' . $name);

            $input['post_image'] = $name;
        }

        $post->update($input);
        $notification = array(
            'messege' => 'Post updated successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.post')->with($notification);
    }
}
