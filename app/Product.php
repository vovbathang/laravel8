<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'code',
        'regular_price',
        'sale_price',
        'original_price',
        'quantity',
        'attributes',
        'image',
        'user_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'product_tag', 'product_id', 'tag_id');
    }
}
