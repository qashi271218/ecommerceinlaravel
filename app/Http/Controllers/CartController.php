<?php

namespace App\Http\Controllers;

use App\Model\admin\Coupon;
use App\Model\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Cart;
use Response;
use Session;
class CartController extends Controller
{
    public function cart($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        $data = array();
        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            $data['options']['image'] = $product->image_one;;
            Cart::add($data);
            return \Response::json(['success' => 'successfully added to your cart']);
        } else {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            $data['options']['image'] = $product->image_one;
            Cart::add($data);
            return \Response::json(['success' => 'successfully added to your cart']);
        }
    }

    public function check()
    {
        $content = Cart::content();
        return response()->json($content);
    }

    public function show()
    {
        $carts = Cart::content();
        return view('pages.cart', compact('carts'));
    }
    public function remove($rowId)
    {
        Cart::remove($rowId);
        $notification = array(
            'messege' => 'successfully remove from cart',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function update(Request $request)
    {
         $rowId=$request->productid;
         $qty=$request->qty;
         Cart::update($rowId,$qty);
         $notification = array(
            'messege' => 'quantity successfully updated',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function view($id)
    {
    	$product = DB::table('products')
    			->join('categories','products.category_id','categories.id')
    			->join('subcategories','products.subcategory_id','subcategories.id')
    			->join('brands','products.brand_id','brands.id')
    			->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
    			->where('products.id',$id)
    			->first();

    	$color = $product->product_color;
    	$product_color = explode(',', $color);

    	$size = $product->product_size;
        $product_size = explode(',', $size);
        return response::json(array(
         'product'=>$product,
         'color'=>$product_color,
         'size'=>$product_size
        ));

    }

    public function insert(Request $request){
        $id = $request->product_id;
     $product = DB::table('products')->where('id',$id)->first();
     $color = $request->color;
     $size = $request->size;
     $qty = $request->qty;

   $data = array();

  if ($product->discount_price == NULL) {
      $data['id'] = $product->id;
      $data['name'] = $product->product_name;
      $data['qty'] = $request->qty;
      $data['price'] = $product->selling_price;
      $data['weight'] = 1;
      $data['options']['image'] = $product->image_one;
      $data['options']['color'] = $request->color;
      $data['options']['size'] = $request->size;
       Cart::add($data);
       $notification=array(
                         'messege'=>'Product Added Successfully',
                         'alert-type'=>'success'
                          );
                        return Redirect()->back()->with($notification);
  }else{

      $data['id'] = $product->id;
      $data['name'] = $product->product_name;
      $data['qty'] = $request->qty;
      $data['price'] = $product->discount_price;
      $data['weight'] = 1;
      $data['options']['image'] = $product->image_one;
      $data['options']['color'] = $request->color;
      $data['options']['size'] = $request->size;
       Cart::add($data);
       $notification=array(
                         'messege'=>'Product Added Successfully',
                         'alert-type'=>'success'
                          );
                        return Redirect()->back()->with($notification);

  }

    }

    public function checkout()
    {
      if(Auth::check())
      {
        $carts = Cart::content();
        return view('pages.checkout', compact('carts'));
      }
      else{
        $notification=array(
            'messege'=>'Please login first',
            'alert-type'=>'success'
             );
           return Redirect()->route('login')->with($notification);
      }
    }

    public function wishlist()
    {
        $userid = Auth::id();
        $product = DB::table('wishlists')
                ->join('products','wishlists.product_id','products.id')
                ->select('products.*','wishlists.user_id')
                ->where('wishlists.user_id',$userid)
                ->get();
               // return response()->json($product);
                return view('pages.wishlist',compact('product'));
    }

    public function coupon(Request $request)
    {
       $input=$request->coupon;
       $check=DB::table('coupons')->where('coupon',$input)->first();
       if($check)
       {
         Session::put('coupon',[
             'name'=>$check->coupon,
             'discount'=>$check->discount,
             'balance'=>Cart::Subtotal()-$check->discount,
         ]);
         $notification=array(
            'messege'=>'Coupon Applied successfully',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
       }
       else{
        $notification=array(
            'messege'=>'Invalid Coupon',
            'alert-type'=>'error'
             );
           return Redirect()->back()->with($notification);
       }
    }
    public function couponremove()
    {
       Session::forget('coupon');
       $notification=array(
        'messege'=>'Coupon Removed successfully',
        'alert-type'=>'success'
         );
       return Redirect()->back()->with($notification);
    }

    public function search(Request $request)
    {
$item=$request->search;
$products=DB::table('products')
         ->where('product_name','LIKE',"%$item%")->paginate(20);
         return view('pages.search',compact('products'));
    }
}
