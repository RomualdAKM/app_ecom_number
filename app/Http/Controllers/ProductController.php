<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
//use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;


/**
 * Récupérer les produits dans l'ordre du plus récent
 *
 */
class ProductController extends Controller
{
    public function get_products(){

        $products = Product::with('category')->orderBy('created_at', 'desc')->get();
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

    /**
     * @throws ValidationException
     */
    public function create_product(Request $request){
        $validator = Validator::make ($request->all(),[
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'file' => 'nullable|mimes:txt',
            'hover_image' => 'required|mimes:png,jpg',
        ]);

        if ($validator->fails()){
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        $hover_image = '';
        if ($request->hasFile('hover_image')) {
            $img = $request->file('hover_image');
            $file_image = time() . '.' . $img->getClientOriginalName();
            $img->move(public_path('img'), $file_image);
            $hover_image = 'img/' . $file_image;
        }
        $file = '';
        if ($request->hasFile('file')) {
            $h_img = $request->file('file');
            $f = time() . '.' . $h_img->getClientOriginalName();
            $h_img->move(public_path('img'), $f);
            $file = 'img/' . $f;
        }

        $product = new Product();
        $product->hover_image = $hover_image;
        $product->file = $file;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();
    }

    public function update_product(Request $request, $id){
        $product = Product::findOrFail($id);

        $this->validate(
            $request,
            [
                'name' => 'required',
                'price' => 'required',
            ]
        );

        $hover_image = '';
        if ($request->hasFile('hover_image')) {
            $img = $request->file('hover_image');
            $file_image = time() . '.' . $img->getClientOriginalName();
            $img->move(public_path('img'), $file_image);
            $hover_image = 'img/' . $file_image;

            $product->hover_image = $hover_image;
        }
        $file = '';
        if ($request->hasFile('file')) {
            $h_img = $request->file('file');
            $f = time() . '.' . $h_img->getClientOriginalName();
            $h_img->move(public_path('file'), $f);
            $file = 'file/' . $f;

            $product->file = $file;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();
    }

    public function delete_product($id){
        $product = Product::findOrFail($id);
        $product->delete();
    }
}
