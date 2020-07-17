<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name'];

    public function subcategory()
    {
        return $this->hasMany('App\Model\Admin\Subcategory');
    }
    public function product()
    {
        return $this->hasMany('App\Model\Admin\Product');
    }
}
