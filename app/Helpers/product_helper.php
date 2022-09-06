<?php

use App\Models\options;
use App\Models\product_categories;
use App\Models\Products;

use function PHPUnit\Framework\isEmpty;

if (!function_exists('getProductCategory')) {
    function getProductCategory($productId)
    {
        $ProductCategoryId = Products::select('product_category')->where('id',$productId)->first();
        $productCategory = product_categories::select('category_name')->where('id',$ProductCategoryId->product_category)->first();    
        return $productCategory->category_name;
    }
}
