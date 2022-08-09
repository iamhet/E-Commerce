<?php

namespace Modules\Products\Http\Controllers;

use App\DataTables\ProductDatatable;
use App\Models\product_categories;
use App\Models\Products;
use App\Models\ProductsImages;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
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
        $result = product_categories::select('category_name', 'id')->where('gender', $request->gender)->get();
        return view('products::addProduct', compact('result'));
    }
    public function saveProduct(Request $request)
    {
        $product = new Products();
        $product->product_category = $request->productCategory;
        $product->product_name = $request->productName;
        $product->product_details = nl2br($request->productDetails);
        $product->product_price = $request->productPrice;
        $product->save();
        return Response::json(['success' => true, 'productId' => $product->id]);
    }
    public function saveProductImages(Request $request)
    {
        if (!empty($request->product_id) && $request->product_id !== null) {
            $productImageName = $request->file->getClientOriginalName();
            $request->file->move('ProductImages/' . $request->product_id, $productImageName);
            $productImage = new ProductsImages();
            $productImage->product_image = $productImageName;
            $productImage->productId = $request->product_id;
            $productImage->save();
        }
    }
    public function viewProducts(Request $request)
    {
        // DB::enableQueryLog();
        $products = Products::with(['productImages','productCategories'])
            // ->whereRelation('productCategories', 'gender', '=', $request->gender)
            ->get()
            ->toArray();
        // $query = DB::getQueryLog();
        // dd($query);
        return view('products::productView',compact('products'));
    }
    public function productDatatable(ProductDatatable $dataTable)
    {
        $productCategory = product_categories::select('category_name')->groupBy ('category_name')->pluck('category_name');
        return $dataTable->render('products::viewProductDatatable',compact('productCategory'));
    }
}
