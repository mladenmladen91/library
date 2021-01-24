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
        $this->middleware(['higher'])->except(['all', 'store', 'update', 'delete', 'getBook']);
        $this->middleware(['higherApi'])->except(['all', 'index', 'create', 'edit', 'getBook']);
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
     *   @OA\Parameter(
     *      name="phrase",
     *      in="query",
     *      required=true,
     *   description = "enter just a blank '' if you want all users, when you type another word you get book that has that word in the title",
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="status",
     *      in="query",
     *      required=true,
     *      description = "if you enter 2 you get all the books, 1 is for available and 0 is for rented books",
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
     *      path="/api/book/store",
     *      operationId="storeBook",
     *      tags={"Books"},
     *      summary="creating book",
     *      description="route for creating book",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *      name="title",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="author",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="category_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="publisher",
     *      in="query",
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="print",
     *      in="query",
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
        $result = $this->bookService->save($request);
        return $result;
    }

    /**
     * @OA\Post(
     *      path="/book/get",
     *      operationId="getBook",
     *      tags={"Books"},
     *      summary="get data for particular book",
     *      description="book data route",
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
     *      path="/api/book/update",
     *      operationId="updateBook",
     *      tags={"Books"},
     *      summary="updating book",
     *      description="route for updating book",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *      name="title",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="category_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
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
    public function update(Request $request)
    {
        $result = $this->bookService->update($request);
        return $result;
    }

    /**
     * @OA\Post(
     *      path="/api/book/delete",
     *      operationId="deleteBook",
     *      tags={"Books"},
     *      summary="delete book",
     *      description="delete book",
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

        $result = $this->bookService->delete($request);
        return $result;
    }
}
