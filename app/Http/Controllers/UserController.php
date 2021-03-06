<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{


    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware(['admin'])->except(['register', 'all', 'store', 'getUser', 'update', 'delete', 'activate', 'particular', 'history']);
        $this->middleware(['adminApi'])->except(['index', 'create', 'edit', 'register', 'particular', 'history']);
        $this->userService = $userService;
    }


    public function index()
    {
        return view('frontend.users.user');
    }
    /**
     * @OA\Post(
     *      path="/api/user/all",
     *      operationId="getUsersList",
     *      tags={"Users"},
     *      summary="Get user list",
     *      description="Returns list of user",
     *   security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *      name="limit",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="offset",
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
    public function all(Request $request)
    {
        $result = $this->userService->getAll($request);
        return $result;
    }
    public function create()
    {
        return view('frontend.users.create');
    }
    /**
     * @OA\Post(
     *      path="/api/user/store",
     *      operationId="storeUser",
     *      tags={"Users"},
     *      summary="creating user",
     *      description="route for creating users",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     *   @OA\Parameter(
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
     * @OA\Parameter(
     *      name="role_id",
     *      in="query",
     *      required=true,
     *      description = "enter 1 for administrator, 2 for libraryman and 3 for ordinary user",
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
    public function store(Request $request)
    {
        $result = $this->userService->save($request);
        return $result;
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('frontend.users.edit', compact('user'));
    }
    /**
     * @OA\Post(
     *      path="/api/user/get",
     *      operationId="getUser",
     *      tags={"Users"},
     *      summary="get data for particular user",
     *      description="user data route",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *      name="id",
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
    public function getUser(Request $request)
    {
        $user = User::find($request->id);
        return response()->json(["success" => true, "user" => $user]);
    }
    /**
     * @OA\Post(
     *      path="/api/user/update",
     *      operationId="updateUser",
     *      tags={"Users"},
     *      summary="updating user",
     *      description="route for updating user",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *   required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="id",
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
    public function update(Request $request)
    {
        $result = $this->userService->update($request);
        return $result;
    }
    /**
     * @OA\Post(
     *      path="/api/user/delete",
     *      operationId="deleteUser",
     *      tags={"Users"},
     *      summary="delete user",
     *      description="delete user",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *      name="id",
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
    public function delete(Request $request)
    {

        $result = $this->userService->delete($request);
        return $result;
    }
    /**
     * @OA\Post(
     *      path="/admin/user/register",
     *      operationId="registerUser",
     *      tags={"Users"},
     *      summary="registering user",
     *      description="route for registering users",
     *   @OA\Parameter(
     *      name="name",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="email",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="password",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="password_confirmation",
     *      in="path",
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
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $this->userService->register($request);
        session()->put('registerOnHold', 'Dobićete obavještenje kada administrator potvrdi Vašu registraciju');
        return redirect()->back();
    }
    /**
     * @OA\Post(
     *      path="/api/user/activate",
     *      operationId="activateUser",
     *      tags={"Users"},
     *      summary="activate user",
     *      description="activate user",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *      name="id",
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

    public function activate(Request $request)
    {

        $result = $this->userService->activate($request);
        return $result;
    }
    public function particular()
    {
        return view('frontend.users.particular');
    }
    public function history()
    {
        return view('frontend.users.history');
    }
}
