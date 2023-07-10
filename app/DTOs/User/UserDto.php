<?php

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserDto extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $password;
    public int $role_id;

    
    public static function forCreation(Request $request): self
    {
        return new self([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role-id' => $request->input('role_id'),

        ]);
    } 

    public static function forResult(User $user): self
    {
    return new self([
        'name' => $user->name,
        'email' => $user->email,
        'password' => $user->password,
        'role_id' => $user->role_id,
    ]);
    } 

    public function validate(): ValidationResult
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'role_id' => 'required|int'
        ];

        $validator = validator()->make($this->toArray(), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return new ValidationResult();
    }
}