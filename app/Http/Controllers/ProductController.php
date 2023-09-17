<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function get_products(){        

            $products = Product::inRandomOrder()->get();
 
            return response()->json([
                'products' => $products
            ]);
       }
 
    public function get_product($nameProduct){

        $product = Product::where('name',$nameProduct)->first();
        return response()->json([
            'product' => $product
        ]);
        
    }
   
}
