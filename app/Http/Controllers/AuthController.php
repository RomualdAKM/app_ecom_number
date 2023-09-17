<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
            'regex:/^\+[0-9]{10,15}$/',
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
                $response, 400
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
            'message' => "User register successfully"
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
                $success['name'] = $user->name;
    
                $response = [
                    'success' => true,
                    'data' => $success,
                    'message' => "Login successfully"
                ];
                return response()->json($response, 200);
            }else {
                $response = [
                    'success' => false,
                    'message' => "Coordinate not found"
                ];
                return response()->json($response);
            }
                
        }


     
}
