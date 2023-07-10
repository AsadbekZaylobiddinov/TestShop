<?php

use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProductImageDto extends DataTransferObject
{
    public string $path;
    public int $product_id;

    
    public static function forCreation(Request $request): self
    {
        return new self([
            'path' => $request->input('path'),
            'product_id' => $request->input('product_id')
        ]);
    } 

    public static function forResult(ProductImage $productImage): self
    {
    return new self([
        'path' => $productImage->path
    ]);
    } 

    public function validate(): ValidationResult
    {
        $rules = [
            'path' => 'required|string',
            'product_id' => 'required|integer'
        ];

        $validator = validator()->make($this->toArray(), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return new ValidationResult();
    }
}