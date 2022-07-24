<?php

namespace Modules\Products\Http\Controllers;

use App\Models\product_categories;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductsController extends Controller
{
    public function index()
    {
        $productCategory = product_categories::select('gender')->groupBy('gender')->get();
        return view('products::categorySelect',compact('productCategory'));
    }
    public function addProduct(Request $request)
    {
        $result = product_categories::select('category_name')->where('gender',$request->gender)->get();
        $product_category = [];
        foreach ($result as $value) {
            $product_category[] = $value->category_name;
        }
        return view('products::addProduct',compact('product_category'));
    }
}
