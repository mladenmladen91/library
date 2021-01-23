<?php


namespace App\Services;

use App\Interfaces\ReservationRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use App\Models\Reservation;
use App\Models\Book;
use App\Models\User;
use Mail;


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
    // service for approving reservation
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
        //return response()->json(["success" => true, "message" => "Rezervacija dozvoljena"]);

        $user = User::find($reservation->user_id);

        $data = [
            "name" => $user->name,
            "email" => $user->email,
            "id" => $user->id,
        ];

        try {
            Mail::send('activeReservation', $data, function ($message) use ($data) {
                $message->to($data["email"])->subject("Potvrda rezervacije");
                $message->from('no-reply@test.me', 'library.me');
            });
            return response()->json(["success" => true, "message" => "Poruka poslata"]);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => "Mail nije poslat, kontaktirajte korisnika ručno"]);
        }
    }
    // service for getting avilable users and books
    public function usersBooks()
    {
        $users = User::where("role_id", "=", 2)->get();
        $books = Book::where("status", "=", 1)->get();
        return response()->json(["success" => true, "users" => $users, "books" => $books]);
    }
    // service for booking by the simple user side
    public function book($request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required',
            'user_id' => 'required',
            'period' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }

        $input = $request->all();
        $input["date"] = date("Y-m-d");
        $input["approved"] = 0;

        Reservation::create($input);

        $book = Book::find($request->book_id);
        $book->status = 0;
        $book->update();

        $user = User::find($request->user_id);

        $data = [
            "name" => $user->name,
            "email" => $user->email,
            "id" => $user->id,
        ];

        try {
            Mail::send('newReservation', $data, function ($message) use ($data) {
                $message->to("jelovacmladen@gmail.com")->subject("Potvrda rezervacije");
                $message->from('no-reply@test.me', 'library.me');
            });
            return response()->json(["success" => true, "message" => "Kontaktirati admin nakon što odobri Vašu rezervaciju"]);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => "Mail nije poslat, ali će Vas kontaktirati admin nakon što odobri Vašu rezervaciju"]);
        }
    }
    // getting reservation history for particular users
    public function history($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }
        return $this->reservationRepository->history($request);
    }
}
