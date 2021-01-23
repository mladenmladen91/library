<?php


namespace App\Services;

use App\Interfaces\ReservationRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;
use App\Models\Book;
use App\Models\User;


class ReservationService
{
    /** @var $reservationRepository */
    private $reservationRepository;


    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    // getting category data from the repository and send them to the controller
    public function all($request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required',
            'offset' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }
        return $this->reservationRepository->all($request);
    }
    // accepting the request and pass it to the saving repository
    public function save($request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'book_id' => 'required',
            'period' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }

        return $this->reservationRepository->save($request);
    }

    // delete data
    public function delete($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }
        return $this->reservationRepository->delete($request);
    }
    public function activate($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'book_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }
        $reservation = Reservation::find($request->id);
        $reservation->approved = 1;
        $reservation->update();

        $book = Book::find($request->book_id);
        $book->status = 0;
        $book->update();
        return response()->json(["success" => true, "message" => "Rezervacija dozvoljena"]);
    }
    public function usersBooks()
    {
        $users = User::where("role_id", "=", 2)->get();
        $books = Book::where("status", "=", 1)->get();
        return response()->json(["success" => true, "users" => $users, "books" => $books]);
    }
}
