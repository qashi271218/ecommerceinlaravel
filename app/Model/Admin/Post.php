<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['postcategory_id', 'post_title_en', 'post_title_in', 'details_en', 'details_in', 'post_image'];
    public function category()
    {
        return $this->belongsTo('App\Model\Admin\Category');
    }
    public function postcategory()
    {
        return $this->belongsTo('App\Model\Admin\PostCategory');
    }
}
