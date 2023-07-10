<?php

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CategoryDto extends DataTransferObject
{
    public string $name;
    
    public static function forCreation(Request $request): self
    {
        return new self([
            'name' => $request->input('name')
        ]);
    } 

    public static function forResult(Category $category): self
    {
    return new self([
        'name' => $category->name
    ]);
    } 

    public function validate(): ValidationResult
    {
        $rules = [
            'name' => 'required|string'
        ];

        $validator = validator()->make($this->toArray(), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return new ValidationResult();
    }
}