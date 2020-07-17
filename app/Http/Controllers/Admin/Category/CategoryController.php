<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function category()
    {
        $category = Category::all();
        return view('admin.category.category', compact('category'));
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories',
        ]);
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // DB::table('categories')->insert($data);
        $category = new category;
        $category->category_name = $request->category_name;
        $category->save();
        $notification = array(
            'messege' => 'Category created successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function Deletecategory($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Category deleted successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function Editcategory($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }
    public function Updatecategory(Request $request, $id)
    {
        $validateData = $request->validate([
            'category_name' => 'required',
        ]);
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $update = DB::table('categories')->where('id', $id)->update($data);
        $category = Category::find($id);
        $input['category_name'] = $request->category_name;
        $update = $category->update($input);


        if ($update) {
            $notification = array(
                'messege' => 'Category updated successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('categories')->with($notification);
        } else {
            $notification = array(
                'messege' => 'Nothing to update',
                'alert-type' => 'error'
            );
            return Redirect()->route('categories')->with($notification);
        }
    }


}
