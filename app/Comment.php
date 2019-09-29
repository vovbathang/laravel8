<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'name',
        'email',
        'content',
        'product_id',
        'rating'
    ];

    public function product() {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
