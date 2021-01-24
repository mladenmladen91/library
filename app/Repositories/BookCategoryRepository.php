<?php

namespace App\Repositories;

use App\Interfaces\BookCategoryRepositoryInterface;
use App\Models\BookCategory;


class BookCategoryRepository implements BookCategoryRepositoryInterface
{
    protected $bookCategory;
    /**
     * Save a job.
     *
     * @param User $user
     * @return mixed
     */
    public function __construct(BookCategory $bookCategory)
    {
        $this->bookCategory = $bookCategory;
    }

    // function getting all users and fill the tabkle with it
    public function all()
    {
        $bookCategory = BookCategory::all();
        return response()->json(["success" => true, "categories" => $bookCategory]);
    }
    // saving new user data
    public function save($request)
    {
        BookCategory::create(["name" => $request->name]);
        return response()->json(["success" => true, "message" => "Kategorija uspješno kreirana!"]);
    }
    // updating user data
    public function update($request)
    {
        $bookCategory = BookCategory::find($request->id);
        $bookCategory->name = $request->name;
        $bookCategory->save();
        return response()->json(["success" => true, "message" => "Kategorija uspješno izmijenjena!"]);
    }
    // deleting user
    public function delete($request)
    {
        $bookCategory = BookCategory::find($request->id);
        $bookCategory->delete();
        return response()->json(["success" => true, "message" => "Kategorija obrisana"]);
    }
}
