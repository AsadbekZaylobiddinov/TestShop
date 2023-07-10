<?php

namespace App\Services;

use App\Helpers\ResponseBody as Result;

class AuthService
{
    protected $_userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $_userRepository = $userRepository;
    }

    public function CheckUser($email)
    {
        $result;
        $user = $_userRepository->Select([["email","=",$email]]);

        if($user)
        {
            $result = new Result(200,"User Found",$user);
        }
        else{
            $result  = new Result(404,"Not Found",null);
        }

        return $result;
        
    } 
}