<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get_categories(){

        $categories = Category::all();

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
            'name' => 'required|unique'
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

    public function edit_category($nameCategory){
        $category = Category::findOrFail($nameCategory);

        return response()->json([
            'category' => $category
        ]);
    }

    public function update_category(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique'
        ]);

        if ($validator->fails()){
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();

        return response()->json([
            'success' => 'Mise à jour effectuée avec succès.'
        ]);
    }

    public function delete_category(Category $category){
        $category->delete();

        return response()->json([
           'success' => 'Suppression effectuée avec succès.'
        ]);
    }
}
