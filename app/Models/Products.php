<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productCategories()
    {
        return $this->belongsTo(product_categories::class, 'product_category');
    }
    public function productImages()
    {
        return $this->hasMany(ProductsImages::class,'productId');
    }
}
