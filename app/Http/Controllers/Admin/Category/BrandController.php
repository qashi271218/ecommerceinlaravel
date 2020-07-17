<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function brand()
    {
        $brands = Brand::all();
        return view('admin.category.brand', compact('brands'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands',
            'brand_logo' => 'required',
        ]);
        $input = $request->all();
        if ($file = $request->file('brand_logo')) {
            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $input['brand_logo'] = $name;
        }
        $input['brand_name'] = $request->brand_name;
        Brand::create($input);
        $notification = array(
            'messege' => 'Brand created successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function Deletebrand($id)
    {
        $brand = Brand::findOrFail($id);
        unlink("images/" . $brand->brand_logo);
        $brand->delete();
        $notification = array(
            'messege' => 'Brand deleted successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function Editbrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.category.edit_brand', compact('brand'));
    }
    public function Updatebrand(request $request, $id)
    {
        $brand = Brand::findOrFail($id);



        $input = $request->all();

        if ($file = $request->file('brand_logo')) {
            unlink("images/" . $request->old_logo);

            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $input['brand_logo'] = $name;
        }
        $brand->update($input);
        $notification = array(
            'messege' => 'Brand updated successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('brands')->with($notification);
    }
}
