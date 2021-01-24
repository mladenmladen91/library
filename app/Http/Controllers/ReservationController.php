<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Services\ReservationService;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{

    private $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->middleware(['higher'])->except(['all', 'store', 'delete', 'activate', 'userBooks', 'book', 'history']);
        $this->middleware(['higherApi'])->except(['index', 'book', 'history']);
        $this->reservationService = $reservationService;
    }

    public function index()
    {
        return view("frontend.reservations.index");
    }
    /**
     * @OA\Post(
     *      path="/api/reservation/all",
     *      operationId="getReservationList",
     *      tags={"Reservations"},
     *      summary="Get reservation list",
     *      description="Returns list of reservations",
     * security={{ "apiAuth": {} }},
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
        $result = $this->reservationService->all($request);
        return $result;
    }
    /**
     * @OA\Get(
     *      path="/api/reservation/users-and-books",
     *      operationId="getAvailableUsersBooksList",
     *      tags={"Reservations"},
     *      summary="Get users and books list",
     *      description="Returns list of books and users",
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
    public function usersBooks()
    {
        $result = $this->reservationService->usersBooks();
        return $result;
    }

    /**
     * @OA\Post(
     *      path="/api/reservation/store",
     *      operationId="storeReservation",
     *      tags={"Reservations"},
     *      summary="creating reservation",
     *      description="route for creating reservation",
     * security={{ "apiAuth": {} }},
     * @OA\Parameter(
     *      name="user_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="book_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="period",
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
        $result = $this->reservationService->save($request);
        return $result;
    }

    /**
     * @OA\Post(
     *      path="/api/reservation/delete",
     *      operationId="deletereservation",
     *      tags={"Reservations"},
     *      summary="delete reservation",
     *      description="delete reservation",
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
        $result = $this->reservationService->delete($request);
        return $result;
    }
    /**
     * @OA\Post(
     *      path="/api/reservation/activate",
     *      operationId="activateReservation",
     *      tags={"Reservations"},
     *      summary="activate reservation",
     *      description="activate reservation",
     * security={{ "apiAuth": {} }},
     *   @OA\Parameter(
     *      name="id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="book_id",
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
        $result = $this->reservationService->activate($request);
        return $result;
    }
    /**
     * @OA\Post(
     *      path="/api/reservation/book",
     *      operationId="bookReservation",
     *      tags={"Reservations"},
     *      summary="book reservation",
     *      description="book reservation",
     * security={{ "apiAuth": {} }},
     * @OA\Parameter(
     *      name="book_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="user_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="object"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="period",
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
    public function book(Request $request)
    {
        $result = $this->reservationService->book($request);
        return $result;
    }

    public function history(Request $request)
    {
        $result = $this->reservationService->history($request);
        return $result;
    }
}
