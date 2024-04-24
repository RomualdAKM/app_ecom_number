<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function get_codes(){

        $codes = Code::all();

        return response()->json([

            'codes' =>  $codes

        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:codes',
            'percentage' => 'required|string|max:5',
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
        ]);

        $category = new Code([
            'name' => $request->input('name'),
            'percentage' => $request->input('percentage'),
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);
        $category->save();

        return response()->json([
            'success' => 'Code enregistré avec succès.'
        ],200);
    }

    public function edit($id){
        $code = Code::findOrFail($id);

        return response()->json([
            'code' => $code
        ]);
    }

    public function update(Request $request,  $id){
        $request->validate([
            'name' => 'required|unique:codes,name,'.$id,
            'percentage' => 'required|string|max:5',
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
        ]);

        $code = Code::findOrFail($id);
        $code->name = $request->input('name');
        $code->update();

        return response()->json([
            'success' => 'Mise à jour effectuée avec succès.'
        ],200);
    }

    public function destroy($id){
        $code = Code::findOrFail($id);

        try {
            $code->delete();
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression du Code : ' . $e->getMessage());
            return response()->json([
                'error' => 'Vous ne pouvez pas supprimez ce code.'
            ],500);
        }

        return response()->json([
            'success' => 'Code supprimé avec succès.'
        ],200);
    }
}
