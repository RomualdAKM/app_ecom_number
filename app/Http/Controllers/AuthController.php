<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;


class AuthController extends Controller
{
   public function register(Request $request){

      //validator
      $validator = Validator::make($request->all(),[
        'name' => 'required',
        'email' => 'required|email',
        'number' => [
            'required',
            'unique:users',
            // 'regex:/^\+[0-9]{10,15}$/',
        ],
        'sex' => 'required',
        'password' => 'required',
        //'c_password' => 'required|same:password'
]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json(
                $response,400
            );
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
       // $user = User::create($input);

       $user = new User();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->number = $request->number;
       $user->coupon = $request->number;
       $user->sex = $request->sex;
       $user->password = $input['password'];
       $user->save();

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => "L'utilisateur s'est enregistré avec succès"
        ];

        return response()->json($response,200);

        }

        public function login(Request $request){

            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                 $user = $request->user();
                $success['token'] = $user->createToken('MyApp')->plainTextToken;
                $success['user'] = $user;

                $response = [
                    'success' => true,
                    'data' => $success,
                    'message' => "Connecté avec succès"
                ];
                return response()->json($response, 200);
            }else {
                $response = [
                    'success' => false,
                    'message' => "Coordonnée introuvable"
                ];
                return response()->json($response);
            }

        }


        // getAuthUser
    public function getAuthUser()
    {
        $user = Auth::user();
        $response = [
            'success' => true,
            'data' => $user,
            'message' => "User profile"
        ];
        return response()->json($response, 200);
    }

    // updateProfil
    public function updateProfil(Request $request, $user)
    {
        $user = User::findOrFail($user);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'number' => [
                'required',
                'unique:users,number,'.$user->id,
                'regex:/^\+[0-9]{10,15}$/',
            ],
            'sex' => 'required',
        ]);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->number = $request->number;
            $user->sex = $request->sex;
            $user->save();
            return response()->json(['success'=>'Mise à jour effectuée avec succes'],200);
        } catch (\Throwable $th){
            Log::error('Erreur de mise à jour du profil: '. $th);
            return response()->json(['message'=>'Une erreur s\'est produite.']);
        }
    }

    public function changePasswd(Request $request, $user){

        $request->validate([
            'password' => ['required', 'min:8','max:15', 'same:confirm_password','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
        ]);

        $user = User::findOrFail($user);
        try {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
            return response()->json(['success'=>'Mot de passe modifié avec succes'],200);
        } catch (\Throwable $th){
            Log::error('Erreur de mise à jour du profil: '. $th);
            return response()->json(['message'=>'Une erreur s\'est produite.']);
        }
    }
}
