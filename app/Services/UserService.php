<?php


namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Mail;

class UserService
{
    /** @var $userRepository */
    private $userRepository;


    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // getting users data from the repository and send them to the controller
    public function getAll($request)
    {
        return $this->userRepository->getAll($request);
    }
    // accepting the request and pass it to the saving repository
    public function save($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }
        return $this->userRepository->save($request);
    }
    // accepting the request and pass it to the saving repository
    public function update($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }
        return $this->userRepository->update($request);
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
        return $this->userRepository->delete($request);
    }
    public function register($request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => 3,
            'password' => Hash::make($request->password),
        ]);

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "id" => $request->id,
        ];

        try {
            Mail::send('sendContact', $data, function ($message) use ($data) {
                $message->to("jelovacmladen@gmail.com")->subject("Novi korisnik");
                $message->from('no-reply@test.me', 'library.me');
            });
            return response()->json(["success" => true, "message" => "Poruka poslata"]);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => "Mail nije poslat"]);
        }
    }
    public function activate($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->messages()]);
        }
        $user = User::find($request->id);
        if (!$user) {
            return response()->json(["success" => false, "message" => "Korisnik ne postoji"]);
        }
        $user->activation = 1;
        $user->save();

        $data = [
            "name" => $user->name,
            "email" => $user->email,
            "id" => $user->id,
        ];
        try {
            Mail::send('confirmUser', $data, function ($message) use ($data) {
                $message->to($data["email"])->subject("Potvrda naloga");
                $message->from('no-reply@test.me', 'library.me');
            });
            return response()->json(["success" => true, "message" => "Poruka poslata"]);
        } catch (\Exception $e) {
            return response()->json(["success" => false, "message" => "Mail nije poslat"]);
        }
    }
}
