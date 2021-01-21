<?php


namespace App\Interfaces;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{

    public function save(Request $request);

    public function update(Request $request);

    public function getAll(Request $request);

    public function delete(Request $request);
}
