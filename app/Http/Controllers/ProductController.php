<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Sale;
use App\Models\User;
//use Illuminate\Validation\Validator;
use App\Mail\SaleMail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'price' => 'required',
            'category_id' => 'required|integer|exists:categories,id',
            'description' => 'required',
            'file' => 'nullable|mimes:txt',
            'hover_image' => 'required|mimes:png,jpg,jpeg',
        ]);

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;

            //upload de hover_image
            if ($request->hasFile('hover_image')) {
                $hoverImage = $request->file('hover_image');
                $hoverImageName= time() . '_' . $hoverImage->getClientOriginalName();
                $hoverImagePath = $hoverImage->storeAs('uploads/hoverImages', $hoverImageName, 'public');
                $product->hover_image = $hoverImagePath;
            }

            // upload de file
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName= time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/files', $fileName, 'public');
                $product->file = $filePath;
            }


            $product->save();

            return response()->json([
                'success' => 'Produit ajouté avec succès.'
            ],200);
        } catch (\Throwable $th){
            Log::error('Store Product error : '. $th->getMessage());
            return response()->json([
                'error' => 'Une erreur s\'est produite , réessayer.'
            ],500);
        }
    }

    public function update(Request $request, $id){
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'price' => 'required',
            'category_id' => 'required|integer|exists:categories,id',
            'description' => 'required',
            'file' => 'nullable|mimes:txt',
            'hover_image' => 'nullable|mimes:png,jpg,jpeg',
        ]);

        try {
            $product->name = $request->name;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->description = $request->description;

            if ($request->hasFile('hover_image')) {
                Storage::disk('public')->delete($product->hover_image);
                $hoverImage = $request->file('hover_image');
                $hoverImageName= time() . '_' . $hoverImage->getClientOriginalName();
                $hoverImagePath = $hoverImage->storeAs('uploads/hoverImages', $hoverImageName, 'public');
                $product->hover_image = $hoverImagePath;
            }

            // update file
            if ($request->hasFile('file')) {
                Storage::disk('public')->delete($product->file);
                $file = $request->file('file');
                $fileName= time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/files', $fileName, 'public');
                $product->file = $filePath;
            }

            $product->save();

            return response()->json([
                'success' => 'Produit modifié avec succès.'
            ],200);
        } catch (\Throwable $th){
            Log::error('Update Product error : '. $th->getMessage());
            return response()->json([
                'error' => 'Une erreur s\'est produite , réessayer.'
            ],500);
        }
    }

    public function destroy($id){
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json([
                'success' => 'Produit supprimé avec succès.'
            ],200);
        } catch (\Throwable $th){
            Log::error('Delete Product error : '. $th->getMessage());
            return response()->json([
                'error' => 'Une erreur s\'est produite , réessayer.'
            ],500);
        }
    }

    public function store_user_products(Request $request){

        //dd($request->all());

        if($request->promoCode != null){

            $code = Code::where('name', '=', $request->promoCode)->first();

            $sale = new Sale();
            $sale->total = $request->total;
            $sale->user_id = Auth::user()->id;
            $sale->code_id = $code->id;
            $sale->save();

            Mail::to($code->email)->send(new SaleMail($code->full_name,$request->total,$code->code,$code->percentage));

        }else{

            $sale = new Sale();
            $sale->total = $request->total;
            $sale->user_id = Auth::user()->id;
            $sale->save();
        }


       $user = User::find(Auth::user()->id);


        foreach ($request->items as $value) {

           // dd($value);

            $product = Product::find($value['id']);

            $user->products()->attach($product);

        }
    }

    public function getBuyerProducts()
    {
        $userId = Auth::id();
        $products = User::find($userId)->products;

        return response()->json([
            'products' => $products,
        ]);
    }

    public function filterProductsByPrice(Request $request, $category)
    {
        $critere = $request->critere;
        $query = Product::query()->whereHas('category', function ($query) use ($category){
            $query->where('name',$category);
        });

        dd($query->get());
    }
}
