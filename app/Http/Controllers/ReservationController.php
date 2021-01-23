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
        $this->middleware(['higher'])->except(['all', 'store', 'delete', 'activate', 'userBooks']);
        $this->middleware(['higherApi'])->except(['index']);
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
     * security={
     *  {"passport": {}},
     *   },
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
     *      tags={"reservationss"},
     *      summary="creating reservation",
     *      description="route for creating reservation",
     * security={
     *  {"passport": {}},
     *   },
     * @OA\Parameter(
     *      name="user_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="book_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="period",
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
        $result = $this->reservationService->delete($request);
        return $result;
    }
    /**
     * @OA\Post(
     *      path="/api/reservation/activate",
     *      operationId="activateReservation",
     *      tags={"Users"},
     *      summary="activate reservation",
     *      description="activate reservation",
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
     * @OA\Parameter(
     *      name="book_id",
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
    public function activate(Request $request)
    {
        $result = $this->reservationService->activate($request);
        return $result;
    }
}
