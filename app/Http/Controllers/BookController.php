<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Services\BookService;

class BookController extends Controller
{

    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->middleware(['higher'])->except('all');
        $this->bookService = $bookService;
    }

    public function index()
    {
        return view('frontend.books.books');
    }
    /**
     * @OA\Post(
     *      path="/book/all",
     *      operationId="getBookList",
     *      tags={"Books"},
     *      summary="Get book list",
     *      description="Returns list of books",
     * security={
     *  {"passport": {}},
     *   },
     *   @OA\Parameter(
     *      name="limit",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="offset",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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
        $result = $this->bookService->all($request);
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.books.create');
    }

    /**
     * @OA\Post(
     *      path="/admin/book/store",
     *      operationId="storeBook",
     *      tags={"Books"},
     *      summary="creating book",
     *      description="route for creating book",
     * security={
     *  {"passport": {}},
     *   },
     *   @OA\Parameter(
     *      name="title",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="category_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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
        $result = $this->bookService->save($request);
        return $result;
    }

    /**
     * @OA\Post(
     *      path="/book/get",
     *      operationId="getBookr",
     *      tags={"Books"},
     *      summary="get data for particular book",
     *      description="book data route",
     * security={
     *  {"passport": {}},
     *   },
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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
    public function getBook(Request $request)
    {
        $result = $this->bookService->getBook($request);
        return $result;
    }


    public function edit($id)
    {
        return view('frontend.books.edit', compact('id'));
    }

    /**
     * @OA\Post(
     *      path="/admin/book/update",
     *      operationId="updateBook",
     *      tags={"Books"},
     *      summary="updating book",
     *      description="route for updating book",
     * security={
     *  {"passport": {}},
     *   },
     *   @OA\Parameter(
     *      name="title",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="category_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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
        $result = $this->bookService->update($request);
        return $result;
    }

    /**
     * @OA\Post(
     *      path="/admin/book/delete",
     *      operationId="deleteBook",
     *      tags={"Books"},
     *      summary="delete book",
     *      description="delete book",
     * security={
     *  {"passport": {}},
     *   },
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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

        $result = $this->bookService->delete($request);
        return $result;
    }
}
