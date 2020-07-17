<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'subcategory_id', 'brand_id', 'product_name', 'product_code', 'product_quantity',
        'product_details', 'product_color', 'product_size', 'selling_price', 'discount_price', 'video_link',
        'main_slider', 'hot_deal', 'best_rated', 'mid_slider', 'hot_new', 'trend', 'image_one', 'image_two',
        'image_three', 'status','buyone'
    ];

    public function category()
    {
        return $this->belongsTo('App\Model\Admin\Category');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Model\Admin\Subcategory');
    }

    public function brand()
    {
        return $this->belongsTo('App\Model\Admin\Brand');
    }
}
