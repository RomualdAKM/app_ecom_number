<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|'
        ]);

        $category = new Category([
            'name' => $request->input('name'),
        ]);

        // upload de image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName= time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/images', $fileName, 'public');
            $category->image = $filePath;
        }
        $category->save();

        return response()->json([
            'success' => 'pays enregistrée avec succès.'
        ],200);
    }

    public function edit($id){
        $category = Category::findOrFail($id);

        return response()->json([
            'category' => $category
        ]);
    }

    public function update(Request $request,  $id){
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|'
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        // update image
        if ($request->hasFile('image')) {
            // Supprimer l'image existante si elle existe
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $file = $request->file('image');
            $fileName= time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/images', $fileName, 'public');
            $category->image = $filePath;
        }
        $category->update();

        return response()->json([
            'success' => 'Mise à jour effectuée avec succès.'
        ],200);
    }

    public function destroy($id){
        $category = Category::findOrFail($id);

        try {
            $category->delete();
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de la pays : ' . $e->getMessage());
            return response()->json([
                'error' => 'Vous ne pouvez pas supprimez cette pays.'
            ],500);
        }

        return response()->json([
            'success' => 'pays supprimée avec succès.'
        ],200);
    }
}
