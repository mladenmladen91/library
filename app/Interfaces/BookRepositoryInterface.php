<?php


namespace App\Interfaces;


use Illuminate\Http\Request;


interface BookRepositoryInterface
{

    public function save(Request $request);

    public function update(Request $request);

    public function all(Request $request);

    public function delete(Request $request);

    public function getBook(Request $request);
}
