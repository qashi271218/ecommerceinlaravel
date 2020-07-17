<?php

namespace App\Http\Controllers;

use App\Model\Admin\Category;
use App\Model\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cart;

class ProductController extends Controller
{
    public function index($id, $product_name)
    {
        $products = Product::findOrfail($id);
        $color = $products->product_color;
        $product_color = explode(',', $color);
        $size = $products->product_size;
        $product_size = explode(',', $size);
        return view('pages.product_details', compact('products', 'product_color', 'product_size'));
    }
    public function store(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        $data = array();
        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            $data['options']['image'] = $product->image_one;;
            Cart::add($data);
            $notification = array(
                'messege' => 'successfully added to you cart',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
            $data['options']['image'] = $product->image_one;
            Cart::add($data);
            $notification = array(
                'messege' => 'successfully added to you cart',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function subcatview($id)
    {
        $categories = Category::all();
        $product = Product::where('subcategory_id', $id)->get();
        $brands = Product::where('subcategory_id', $id)->select('brand_id')->groupBy('brand_id')->get();
        return view('pages.all_product', compact('product', 'categories', 'brands'));
    }

    public function categoryview($id)
    {
       $category_all=Product::where('category_id',$id)->get();
       return view('pages.category',compact('category_all'));
    }
}
