<?php

namespace App\Repositories;

use App\Interfaces\ReservationRepositoryInterface;
use App\Models\Reservation;


class ReservationRepository implements ReservationRepositoryInterface
{
    protected $reservation;


    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    // function getting all reservations and fill the table with it
    public function all($request)
    {
        $reservation = Reservation::query();
        $reservation = $reservation->select(['reservations.id', 'reservations.date', 'reservations.period', 'reservations.user_id', 'reservations.book_id', 'reservations.approved', 'users.name', 'books.title'])
            ->leftJoinSub('select id,name from users', "users", "users.id", "=", "reservations.user_id")
            ->leftJoinSub('select id,title from books', "books", "books.id", "=", "reservations.book_id");

        $reservation = $reservation
            ->limit($request->get("limit"))
            ->offset($request->get("offset"))
            ->groupBy("reservations.id")
            ->orderBy("reservations.created_at", "DESC")
            ->get();
        return response()->json(["success" => true, "reservations" => $reservation]);
    }
    // saving new reservation data
    public function save($request)
    {
        $input = $request->all();
        $input["approved"] = 1;
        $input["date"] = date('Y-m-d');
        Reservation::create($input);
        return response()->json(["success" => true, "message" => "Rezervacija uspješno kreirana!"]);
    }

    // deleting reservation
    public function delete($request)
    {
        $reservation = Reservation::find($request->id);
        $reservation->delete();
        return response()->json(["success" => true, "message" => "Rezervacija obrisana"]);
    }

    // function getting all reservations and fill the table with it
    public function history($request)
    {
        $reservation = Reservation::query();
        $reservation = $reservation->select(['reservations.id', 'reservations.date', 'reservations.period', 'reservations.user_id', 'reservations.book_id', 'reservations.approved', 'users.name', 'books.title'])
            ->leftJoinSub('select id,name from users', "users", "users.id", "=", "reservations.user_id")
            ->leftJoinSub('select id,title from books', "books", "books.id", "=", "reservations.book_id");

        $reservation = $reservation
            ->where("user_id", "=", $request->get("id"))
            ->groupBy("reservations.id")
            ->orderBy("reservations.created_at", "DESC")
            ->get();
        return response()->json(["success" => true, "reservations" => $reservation]);
    }
}
