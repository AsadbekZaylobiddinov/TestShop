<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\ProductImage;

class ProductImageRepository
{
    public function Insert(array $data)
    {
        $productImage = ProductImage::create($data);

        return $productImage;
    }
    public function Select(array $filters = [], array $relations = [])
    {
        $query = ProductImage::query();

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
        $query = ProductImage::query();

        if (!empty($filters)) {

                $query->where($filters);
        }

        if (!empty($relations)) {

            $query->with($relations);
        }

        return !empty($filters) ? $query->get() : ProductImage::all();
    }

    public function Update($id, array $data)
    {
        $productImage = ProductImage::find($id);

        if (!$object) {
            throw new Exception("ProductImage by given id doesn't exist");
        }

        $productImage->update($data);

        return $productImage;
    }

    public function Delete($id)
    {
        $productImage = ProductImage::find($id);

        if($productImage == null){
            throw new Exception("ProductImage by given doesn't exist");
        }

        $productImage->delete();

        return $productImage;
    }
}