<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    public function get_categories(){

        $categories = Category::latest()->get();

        return response()->json([

            'categories' =>  $categories

        ]);

    }

    public function get_category_products($nameCategory){

        $categoryProducts = Category::where('name',$nameCategory)->with('products')->first();

        return response()->json([
            'categoryProducts' =>  $categoryProducts
        ]);
    }

    public function create_category(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:categories'
        ]);

        if ($validator->fails()){
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        $category = new Category([
            'name' => $request->input('name')
        ]);

        $category->save();

        return response()->json([
            'success' => 'Catégorie enregistrée avec succès.'
        ]);
    }

    public function get_category($nameCategory){
        $category = Category::where('name', $nameCategory)->first();

        return response()->json([
            'category' => $category
        ]);
    }

    public function update_category(Request $request,  $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:categories'
        ]);

        if ($validator->fails()){
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }
        //$category->update($request->only(['name']));

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->update();

        return response()->json([
            'success' => 'Mise à jour effectuée avec succès.'
        ]);
    }

    public function delete_category($id){
        $category = Category::find($id);
        $category->delete();
    }
}
