<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Récupérer les produits dans l'ordre du plus récent
 *
 */
class ProductController extends Controller
{
    public function get_products(){

        $products = Product::orderBy('created_at', 'desc')->get();
        return response()->json([
            'products' => $products
        ]);
    }

    public function get_product($id){

        $product = Product::with('category')->findOrFail($id);
        return response()->json([
            'product' => $product
        ]);
    }

    /**
     * Récupérer 4 produits similaires à un produits
     *
     * @param $categoryId
     * @param $currentProductId
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_related_products($categoryId, $currentProductId){

        $relatedProducts = Product::where('category_id', $categoryId)
            ->where('id', '!=', $currentProductId)
            ->limit(4)
            ->inRandomOrder()
            ->get();

        return response()->json([
            'relatedProducts' => $relatedProducts,
        ]);
    }

    //public function get_pro
}
