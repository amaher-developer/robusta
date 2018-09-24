<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login()
    {

        if(!request('email') || !request('password')){
            return response([
                'error' => 'Please enter password or email correctly.',
            ],400);
        }
        $user = (Auth::attempt(request(['email', 'password']))) ? Auth::getLastAttempted() : FALSE;

        if(!$user){
            return response([
                'error' => 'User not found.',
                404
            ]);
        }
        $apiToken = str_random(10);

        $user->api_token = $apiToken;
        $user->save();
        return response([
            'admin' => $user
        ]);
    }

}
