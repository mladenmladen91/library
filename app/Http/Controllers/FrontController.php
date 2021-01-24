<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;


class FrontController extends Controller
{
    public function index()
    {
        return view("frontend.index");
    }

    public function details($id)
    {
        return view("frontend.details", compact("id"));
    }

    public function register()
    {
        return view('frontend.register');
    }
    /**
     * @OA\Post(
     *      path="/front/doLogin",
     *      operationId="loginUser",
     *      tags={"Users"},
     *      summary="login user from front",
     *      description="login user from front",
     * @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     *  @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   )
     * 
     *     )
     */
    public function doLogin(Request $request)
    {
        $validator = $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);
        if (Auth::attempt($validator)) {
            if (Auth::user()->activation == 0) {
                Auth::logout();
                return response()->json(["success" => false, "message" => "Korisnik nije aktiviran"]);
            }
            $user = Auth::user();
            $accessToken = $user->createToken('authToken');
            return response()->json(["success" => true, "accessToken" => $accessToken->accessToken, "user" => auth()->user()]);
        } else {
            return response()->json(["success" => false, "message" => "Pogrešni podaci"]);
        }
    }
    /**
     * @OA\Post(
     *      path="/front/logout",
     *      operationId="logoutUser",
     *      tags={"Users"},
     *      summary="logout user from",
     *      description="logout user",
     * @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   )
     * 
     *     )
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(["success" => true, "message" => "Uspješan logout"]);
    }
}
