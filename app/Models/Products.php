<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category_data()
    {
        return $this->belongsTo(Categories::class,'category_id','id');
    }
    public function sub_category_data()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }
    public function brand_data()
    {
        return $this->belongsTo(Brands::class,'brand_id','id');
    }
    public function media()
    {
        return $this->belongsTo(Media::class,'id','product_id');
    }
}
