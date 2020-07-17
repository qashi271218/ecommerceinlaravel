<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Brand;
use App\Model\Admin\Category;
use App\Model\Admin\Product;
use App\Model\Admin\Subcategory;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function product()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }
    public function create()
    {
        $category = Category::all();
        $brand = Brand::all();
        return view('admin.product.create', compact('category', 'brand'));
    }

    public function getsubcategory($category_id)
    {
        $cat = Subcategory::where('category_id', $category_id)->get();
        return json_encode($cat);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $input['product_name'] = $request->product_name;
        $input['product_code'] = $request->product_code;
        $input['product_quantity'] = $request->product_quantity;
        $input['discount_price'] = $request->discount_price;
        $input['category_id'] = $request->category_id;
        $input['subcategory_id'] = $request->subcategory_id;
        $input['brand_id'] = $request->brand_id;
        $input['product_size'] = $request->product_size;
        $input['product_color'] = $request->product_color;
        $input['selling_price'] = $request->selling_price;
        $input['product_details'] = $request->product_details;
        $input['video_link'] = $request->video_link;
        $input['main_slider'] = $request->main_slider;
        $input['hot_deal'] = $request->hot_deal;
        $input['best_rated'] = $request->best_rated;
        $input['trend'] = $request->trend;
        $input['mid_slider'] = $request->mid_slider;
        $input['hot_new'] = $request->hot_new;
        $input['buyone'] = $request->buyone;
        $input['status'] = 1;


        if ($file = $request->file('image_one')) {
            $name = $file->getClientOriginalName();
            Image::make($file->getRealPath())->resize(300, 300)->save('public/images/product/' . $name);

            $input['image_one'] = $name;
        }
        if ($file = $request->file('image_two')) {
            $name = $file->getClientOriginalName();
            Image::make($file->getRealPath())->resize(300, 300)->save('public/images/product/' . $name);
            $input['image_two'] = $name;
        }
        if ($file = $request->file('image_three')) {
            $name = $file->getClientOriginalName();
            Image::make($file->getRealPath())->resize(300, 300)->save('public/images/product/' . $name);
            $input['image_three'] = $name;
        }
        Product::create($input);
        $notification = array(
            'messege' => 'Product created successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.products')->with($notification);
    }

    public function status(Request $request, $id)
    {
        $product = Product::findOrfail($id);
        $input['status'] = $request->is_active;
        $product->update($input);
        return redirect()->back();
    }

    public function delete($id)
    {
        $product = Product::findOrfail($id);
        unlink(public_path() . "/images/product/" . $product->image_one);
        unlink(public_path() . "/images/product/" . $product->image_two);
        unlink(public_path() . "/images/product/" . $product->image_three);

        $product->delete();
        $notification = array(
            'messege' => 'Product deleted successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.products')->with($notification);
    }
    public function show($id)
    {
        $product = Product::findOrfail($id);
        return view('admin.product.show', compact('product'));
    }
    public function edit($id)
    {
        $categories = Category::all();
        $subcategory = Subcategory::all();
        $brand = Brand::all();
        $products = Product::findOrfail($id);
        return view('admin.product.edit', compact('products', 'categories', 'subcategory', 'brand'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrfail($id);
        $input = $request->all();
        $input['product_name'] = $request->product_name;
        $input['product_code'] = $request->product_code;
        $input['product_quantity'] = $request->product_quantity;
        $input['discount_price'] = $request->discount_price;
        $input['category_id'] = $request->category_id;
        $input['subcategory_id'] = $request->subcategory_id;
        $input['brand_id'] = $request->brand_id;
        $input['product_size'] = $request->product_size;
        $input['product_color'] = $request->product_color;
        $input['selling_price'] = $request->selling_price;
        $input['product_details'] = $request->product_details;
        $input['video_link'] = $request->video_link;
        $input['main_slider'] = $request->main_slider;
        $input['hot_deal'] = $request->hot_deal;
        $input['best_rated'] = $request->best_rated;
        $input['trend'] = $request->trend;
        $input['mid_slider'] = $request->mid_slider;
        $input['hot_new'] = $request->hot_new;
        $input['buyone'] = $request->buyone;

        if ($file = $request->file('image_one')) {
            unlink(public_path() . "/images/product/" . $request->old_image_1);
            $name = $file->getClientOriginalName();
            Image::make($file->getRealPath())->resize(300, 300)->save('public/images/product/' . $name);

            $input['image_one'] = $name;
        }
        if ($file = $request->file('image_two')) {
            unlink(public_path() . "/images/product/" . $request->old_image_2);
            $name = $file->getClientOriginalName();
            Image::make($file->getRealPath())->resize(300, 300)->save('public/images/product/' . $name);
            $input['image_two'] = $name;
        }
        if ($file = $request->file('image_three')) {
            unlink(public_path() . "/images/product/" . $request->old_image_3);
            $name = $file->getClientOriginalName();
            Image::make($file->getRealPath())->resize(300, 300)->save('public/images/product/' . $name);
            $input['image_three'] = $name;
        }

        $product->update($input);
        $notification = array(
            'messege' => 'Product updated successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.products')->with($notification);
    }


}
