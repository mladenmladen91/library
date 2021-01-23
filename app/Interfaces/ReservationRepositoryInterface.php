<?php


namespace App\Interfaces;


use Illuminate\Http\Request;


interface ReservationRepositoryInterface
{

    public function save(Request $request);

    public function all(Request $request);

    public function delete(Request $request);
}
