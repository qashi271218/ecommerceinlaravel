<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['brand_name', 'brand_logo'];
    public function product()
    {
        return $this->hasMany('App\Model\Admin\Product');
    }
}
