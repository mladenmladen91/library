<?php


namespace App\Interfaces;


use Illuminate\Http\Request;


interface BookCategoryRepositoryInterface
{

    public function save(Request $request);

    public function update(Request $request);

    public function all();

    public function delete(Request $request);
}
