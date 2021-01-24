<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;


class UserRepository implements UserRepositoryInterface
{
    protected $user;
    /**
     * Save a job.
     *
     * @param User $user
     * @return mixed
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // function getting all users and fill the tabkle with it
    public function getAll($request)
    {
        $users = User::query();
        $users = $users->select(['users.id', 'users.name', 'users.address', 'users.role_id', 'users.activation', 'roles.name as role'])
            ->leftJoinSub('select id, name from roles', "roles", "roles.id", "=", "users.role_id");
        $count = $users->count();
        $users = $users
            ->limit($request->get("limit"))
            ->offset($request->get("offset"))
            ->groupBy("users.id")
            ->orderBy("users.created_at", "DESC")
            ->get();
        return response()->json(["success" => true, "users" => $users]);
    }
    // saving new user data
    public function save($request)
    {
        $input = $request->all();
        if ($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $input['image'] = $name;
        }

        $input['password'] = bcrypt($request->password);
        User::create($input);
        return response()->json(["success" => true, "message" => "Korisnik uspješno kreiran!"]);
    }
    // updating user data
    public function update($request)
    {
        $user = User::find($request->id);

        if ($request->password == '') {
            $input = $request->except(['password', 'id']);
        } else {
            $input = $request->except(['id']);
            $input['password'] = bcrypt($request->password);
        }


        if ($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $input['image'] = $name;
        }

        $user->update($input);
        return response()->json(["success" => true, "message" => "Korisnik uspješno updejtovan!"]);
    }
    // deleting user
    public function delete($request)
    {
        $user = User::find($request->id);
        $user->delete();
        return response()->json(["success" => true, "message" => "Korisnik obrisan"]);
    }
}
