<?php

namespace App\Services;


use Illuminate\Http\Request;
use App\Models\User;
use App\DTOs\User\UserDto;
use App\Interfaces\IUserService;
use App\Helpers\ResponseBody as Result;
use App\Repositories\UserRepository;
use App\Repositories\CartRepository;

class UserService
{
    protected $_userRepository;
    protected $_cartRepository;


    public function __construct(UserRepository $userRepository,
    CartRepository $cartRepository)
    {
        $this->_userRepository = $userRepository;
        $this->_cartRepository = $cartRepository;
    }

    public function Add(Request $request)
    {
        $user = $this->_userRepository->Select([["email","=",$request->input("email")]]);
        if(!$user)
        {
            //Создаём пользователя если пользователя с таким email не существует

        $dto = UserDto::forCreation($request);

        $dto->validate();

        $user = $this->_userRepository->Insert($dto->toArray());
           //Создаём корзину для этого пользователя
           $this->_cartRepository->Insert([
            'user_id' => $user->user_id
           ]);
        }
        else{
            throw new Result(409,'Already exists',null);
        }

        return new Result(200, "Successful", UserDto::forResult($user));
    }


    // Возвращает пользователя по заданному id
    public function GetById($id)
    {
        $user = $this->_userRepository->Select([["id","=",$id]]);
        $result;
        if($user != null)
        {
            $result = new Result(200,"Successful",UserForCreationDto::forResult($user));
        }
        else{
            $result = new Result(404,"Not Found",null);
        }

        return $result;
    }

    // Возвращает всех пользователей
    public function GetAll()
    {
        try{
            return $this->_userRepository->SelectAll();
        }
        catch(Exception $e){
            throw new Exception($e->message);
        }
        
    }

    //Обновляет пользователя
    public function Modify(Request $request, $id)
    {
        $user = $this->_userRepository->Select([['id','=',$id]]);

        if($user){
            return new Result(200,"Successful",$this->_userRepository->Update($id,UserDto::forCreation($request)));
        }
        else{
            throw new Result(404,"Not Found",null);
        }
    }

    //Удаляет пользователя
    public function Delete($id)
    {
        $user = $this->_userRepository->Delete($id);

        return new Result(200,"Successful",UserDto::forRequest($user));
    }
}