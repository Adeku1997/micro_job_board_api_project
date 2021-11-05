<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Json;

class LoginController extends Controller
{

    /**
     * log the user in
     *
     */
   public function login(Request $request): JsonResponse
   {
       $fields = $request->validate([
           'email' => 'required|string',
           'password' => 'required|string'
       ]);

       $user=User::where('email',$fields['email'])->first();

       if(!$user || !Hash::check($fields['password'],$user->password)) {
           return new JsonResponse(['message'=>'wrong credentials'],400);
       }
       $token = $user->createToken('my-app-token')->plainTextToken;

       $response =[
           'user' =>$user,
           'token' => $token
       ];

       return new JsonResponse($response,200);
   }

}
