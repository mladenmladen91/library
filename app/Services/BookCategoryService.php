<?php


namespace App\Services;

use App\Interfaces\BookCategoryRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use App\Models\BookCategory;


class BookCategoryService
{
    /** @var $userRepository */
    private $bookCategoryRepository;


    public function __construct(BookCategoryRepositoryInterface $bookCategoryRepository)
    {
        $this->bookCategoryRepository = $bookCategoryRepository;
    }

    // getting category data from the repository and send them to the controller
    public function all()
    {
        return $this->bookCategoryRepository->all();
    }
    // accepting the request and pass it to the saving repository
    public function save($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }

        return $this->bookCategoryRepository->save($request);
    }
    // accepting the request and pass it to the updating repository
    public function update($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }
        return $this->bookCategoryRepository->update($request);
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
        return $this->bookCategoryRepository->delete($request);
    }
}
