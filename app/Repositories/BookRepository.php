<?php

namespace App\Repositories;

use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;


class BookRepository implements BookRepositoryInterface
{
    protected $book;


    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    // function getting all users and fill the tabkle with it
    public function all($request)
    {
        $books = Book::query();
        $books = $books->select(['books.id', 'books.title', 'books.author', 'books.category_id', 'books.publisher', 'books.print', 'books.status', 'book_categories.name as category'])
            ->leftJoinSub('select id, name from book_categories', "book_categories", "book_categories.id", "=", "books.category_id");
        if ($request->get("phrase") != "") {
            $books = $books->where("title", "LIKE", "%" . $request->get("phrase") . "%");
        }
        if ($request->get("status") < 2) {
            $books = $books->where("status", "=", $request->get("status"));
        }
        $count = $books->count();
        $books = $books
            ->limit($request->get("limit"))
            ->offset($request->get("offset"))
            ->groupBy("books.id")
            ->orderBy("books.created_at", "DESC")
            ->get();
        return response()->json(["success" => true, "books" => $books]);
    }
    // saving new user data
    public function save($request)
    {
        Book::create($request->all());
        return response()->json(["success" => true, "message" => "Knjiga uspješno kreirana!"]);
    }
    // updating user data
    public function update($request)
    {
        $input = $request->except(['id']);
        $book = Book::find($request->id);
        $book->update($input);
        return response()->json(["success" => true, "message" => "Knjiga uspješno updejtovana!"]);
    }
    // deleting user
    public function delete($request)
    {
        $book = Book::find($request->id);
        $book->delete();
        return response()->json(["success" => true, "message" => "Knjiga obrisana"]);
    }
    public function getBook($request)
    {
        $book = Book::find($request->id);
        return response()->json(["success" => true, "book" => $book]);
    }
}
