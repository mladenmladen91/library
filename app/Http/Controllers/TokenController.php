<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class TokenController extends Controller
{
    public function token()
    {
        /** @var User $user */
        $user = auth()->user();
        $accessToken = $user->createToken('authToken');

        return response()->json(["accessToken" => $accessToken->accessToken]);
    }
}
