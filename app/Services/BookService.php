<?php


namespace App\Services;

use App\Interfaces\BookRepositoryInterface;
use Illuminate\Support\Facades\Validator;


class BookService
{
    /** @var $userRepository */
    private $bookRepository;


    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
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
        return $this->bookRepository->all($request);
    }
    // accepting the request and pass it to the saving repository
    public function save($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }

        return $this->bookRepository->save($request);
    }
    // accepting the request and pass it to the updating repository
    public function update($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }
        return $this->bookRepository->update($request);
    }
    // delete data
    public function delete($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }
        return $this->bookRepository->delete($request);
    }
    public function getBook($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }
        return $this->bookRepository->getBook($request);
    }
}
