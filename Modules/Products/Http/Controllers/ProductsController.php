<?php

namespace Modules\Products\Http\Controllers;

use App\Models\product_categories;
use App\Models\Products;
use App\Models\ProductsImages;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

class ProductsController extends Controller
{
    public function index()
    {
        $productCategory = product_categories::select('gender')->groupBy('gender')->get();
        return view('products::categorySelect', compact('productCategory'));
    }
    public function addProduct(Request $request)
    {
        $result = product_categories::select('category_name')->where('gender', $request->gender)->get();
        $product_category = [];
        foreach ($result as $value) {
            $product_category[] = $value->category_name;
        }
        return view('products::addProduct', compact('product_category'));
    }
    public function saveProduct(Request $request)
    {
        $product = new Products();
        $product->product_name = $request->productName;
        $product->product_category = $request->productCategory;
        $product->product_details = nl2br($request->productDetails);
        $product->product_price = $request->productPrice;
        $product->save();
        return Response::json(['success' => true, 'productId' => $product->id]);
    }
    public function saveProductImages(Request $request)
    {
        if (!empty($request->product_id) && $request->product_id !== null) {
            $productImageName = $request->file->getClientOriginalName().'.'.$request->file->getClientOriginalExtension();
            $request->file->move('ProductImages/'.$request->product_id,$productImageName);
            $productImage = new ProductsImages();
            $productImage->product_image = $productImageName;
            $productImage->productId = $request->product_id;
            $productImage->save();
        }
    }
}
