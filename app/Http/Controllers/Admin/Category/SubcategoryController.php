<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function subcategory()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.category.subcategory', compact('subcategories', 'categories'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required|unique:subcategories',
        ]);
        $input = $request->all();
        $input['category_id'] = $request->category_id;
        $input['subcategory_name'] = $request->subcategory_name;
        Subcategory::create($input);
        $notification = array(
            'messege' => 'subcategory created successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function Deletesubcategory($id)
    {
        $subcategory = Subcategory::findOrfail($id);
        $subcategory->delete();
        $notification = array(
            'messege' => 'subcategory deleted successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function Editsubcategory($id)
    {
        $categories = Category::all();
        $subcategory = Subcategory::findOrfail($id);
        return view('admin.category.edit_subcategory', compact('subcategory', 'categories'));
    }
    public function Updatesubcategory(Request $request, $id)
    {
        $subcategory = Subcategory::findOrfail($id);
        $input = $request->all();
        $input['category_id'] = $request->category_id;
        $input['subcategory_name'] = $request->subcategory_name;
        $subcategory->update($input);
        $notification = array(
            'messege' => 'subcategory updated successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('sub.categories')->with($notification);
    }
}
