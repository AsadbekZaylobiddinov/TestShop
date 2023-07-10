<?php

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProductDto extends DataTransferObject
{
    public string $title;
    public int $price;
    public string $desciption;
    public bool $does_exist;
    public int $category_id;
    public int $sub_category_id;

    
    public static function fromRequest(Request $request): self
    {
        return new self([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'does_exist' => $request->input('does_exist'),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id')

        ]);
    } 

    public static function fromModel(Product $product): self
    {
    return new self([
        'title' => $product->title,
        'price' => $product->price,
        'description' => $product->description,
        'does_exist' => $product->does_exist
    ]);
    } 

    public function validate(): ValidationResult
    {
        $rules = [
            'title' => 'required|string',
            'price' => 'required|int',
            'description' => 'required|string',
            'does_exist' => 'required|boolean',
            'category_id' => 'required|int',
            'sub_category_id' => 'required|int'
        ];

        $validator = validator()->make($this->toArray(), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return new ValidationResult();
    }
}