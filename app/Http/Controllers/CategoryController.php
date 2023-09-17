<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
}
