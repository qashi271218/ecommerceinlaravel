<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function wishlist($id)
    {
        $userid = Auth::id();
        $check = DB::table('wishlists')->where('user_id', $userid)->where('product_id', $id)->first();

        $data = array(
            'user_id' => $userid,
            'product_id' => $id,

        );

        if (Auth::Check()) {

            if ($check) {
                return \Response::json(['error' => 'already in your wishlist']);
            } else {
                DB::table('wishlists')->insert($data);
                return \Response::json(['success' => 'successfully added to your wishlist']);
            }
        } else {
            return \Response::json(['error' => 'first login in your account']);
        }
    }
}
