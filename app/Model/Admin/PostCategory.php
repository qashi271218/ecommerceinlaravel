<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = ['category_name_en', 'category_name_in'];
}
