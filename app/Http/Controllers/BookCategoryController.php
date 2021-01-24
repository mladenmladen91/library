<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\BookCategoryService;

class BookCategoryController extends Controller
{
    private $bookCategoryService;

    public function __construct(BookCategoryService $bookCategoryService)
    {
        $this->middleware(['higher'])->except('store', 'update', 'delete');
        $this->middleware(['higherApi'])->except(['all', 'index', 'create', 'edit', 'getBook']);
        $this->bookCategoryService = $bookCategoryService;
    }

    public function index()
    {
        return view('frontend.books.categories');
    }

    /**
     * @OA\Get(
     *      path="/admin/book-category/all",
     *      operationId="getCategoriesList",
     *      tags={"Books"},
     *      summary="Get category list",
     *      description="Returns list of categories",
     * security={{ "apiAuth": {} }},
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
    public function all()
    {
        $result = $this->bookCategoryService->all();
        return $result;
    }

    /**
     * @OA\Post(
     *      path="/api/book-category/store",
     *      operationId="storeCategory",
     *      tags={"Books"},
     *      summary="creating category",
     *      description="route for creating category",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *      name="name",
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
    public function store(Request $request)
    {
        $result = $this->bookCategoryService->save($request);
        return $result;
    }

    /**
     * @OA\Post(
     *      path="/api/book-category/update",
     *      operationId="updateCategory",
     *      tags={"Books"},
     *      summary="updating category",
     *      description="route for updating category",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
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
        $result = $this->bookCategoryService->update($request);
        return $result;
    }

    /**
     * @OA\Post(
     *      path="/api/book-category/delete",
     *      operationId="deleteCategory",
     *      tags={"Books"},
     *      summary="delete category",
     *      description="delete category",
     *security={{ "apiAuth": {} }},
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
        $result = $this->bookCategoryService->delete($request);
        return $result;
    }
}
