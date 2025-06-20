<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
       
        $size = $request->query('size', 12)? $request->query('size'): 12;
        $o_column = "";  
        $o_order = ""; 
        $order = $request->query('order') ?$request->query('order') :-1;
        $f_brands = $request->query('brands');
        $f_categories = $request->query('categories');
        // $min_price = $request->query('min') ? $request->query('min') :1;
        // $max_price = $request->query('min') ? $request->query('max') :500;

        switch ($order) {
            case 1:
                $o_column = 'created_at';
                $o_order = 'DESC';
                break;
            case 2:
                $o_column = 'updated_at';
                $o_order = 'ASC';
                break;
            case 3:
                $o_column = 'sale_price';
                $o_order = 'ASC';
                break;
            case 4:
                $o_column = 'sale_price';
                $o_order = 'DESC';
                break;
            default:
            $o_column = 'id';
            $o_order = 'DESC';

        }
 
       
        $brands = Brand::orderBy('name', 'ASC')->get();       
        $categories= Category::orderBy('name','ASC')->get();
        $products = Product::where(function ($query) use ($f_brands) {
                $query->whereIn('brand_id',explode(',',$f_brands))-> orWhereRaw("'".$f_brands."'=''"); 
        })
        ->where(function ($query) use ($f_categories) {
            $query->whereIn('category_id',explode(',',$f_categories))-> orWhereRaw("'".$f_categories."'=''"); 
  })
            ->orderBy($o_column,$o_order)->paginate($size);
        return view('shop', compact('products', 'size', 'order', 'brands', 'f_brands', 'categories', 'f_categories'));
    }

    public function product_details($product_slug)
    {
        
        $product = Product::where('slug', $product_slug)->first();

        $rproducts = Product::where('slug', '<>', $product_slug)->take(8)->get();

        return view('details', compact('product', 'rproducts'));
    }
}
