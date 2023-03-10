<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\User;
class AuthController extends Controller
{
    public function register(Request $request){
        $token = csrf_token();
        $validator =  Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'csrf' => ["required","in:$token"]
        ]);
        if($validator->fails()){
            $response =[
                'success'=>false,
                'message'=>$validator->errors(),
            ];
            return response()->json($response,400);

        }

            $input=$request->all();
            
            

            $input['password'] = hash("sha512",$input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken($user->name)->plainTextToken;
            $success['name']=$user->name;

            $response=[
                'success'=>true,
                'data'=>$success,
                'message' => 'User Registered Successfully'
            ];
         return response()->json($response, 200);

      
    }

    public function login(Request $request){
        $token = csrf_token();
        $validator =  Validator::make($request->all(),[
           
            'email' => 'required|email',
            'password' => 'required',
         
            'csrf' => ["required","in:$token"]
        ]);
        if($validator->fails()){
            $response =[
                'success'=>false,
                'message'=>$validator->errors(),
            ];
            return response()->json($response,400);

        }
// echo $request->email;
// echo $request->password;
// die;
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user= Auth::user();
            $success['token'] = $user->createToken($user->name)->plainTextToken;
            $success['name']=$user->name;

            $response=[
                'success'=>true,
                'data'=>$success,
                'message' => 'User Login Successfully'
            ];
         return response()->json($response, 200);

        }else{
            $response =[
                'success'=>false,
                'message'=>"Un Autherized User",
            ];
            return response()->json($response,400);
        }
    }
}
