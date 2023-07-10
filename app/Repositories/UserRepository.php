<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\ResponseBody as Result;

class UserRepository
{
    public function Insert(array $data)
    {
        $user = User::create($data);

        return $user;
    }
    public function Select(array $filters = [], array $relations = [])
    {
        $query = User::query();

        if (!empty($filters)) {

            $query->where($filters);
        }

        if (!empty($relations)) {

            $query->with($relations);
        }

        return $query->first();
    }

    public function SelectAll(array $filters = [],  array $relations = [])
    {
        try{
            $query = User::query();

        if (!empty($filters)) {

                $query->where($filters);
        }

        if (!empty($relations)) {

            $query->with($relations);
        } 

        return !empty($filters) ? $query->get() : User::all();
        }
        catch(Exception $e){
            throw new Exception($e->message);
        }
        
    }

    public function Update($id, array $data)
    {
        $user = User::find($id);

        if (!$object) {
            throw new Exception("User by given id doesn't exist");
        }

        $user->update($data);

        return $user;
    }

    public function Delete($id)
    {
        $user = User::find($id);

        if($user == null){
            throw new Exception("User by given doesn't exist");
        }

        $user->delete();

        return $user;
    }
}