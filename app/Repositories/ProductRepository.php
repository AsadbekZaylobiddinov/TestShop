<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductRepository
{
    public function Insert(array $data)
    {
        $product = Product::create($data);

        return $product;
    }
    public function Select(array $filters = [], array $relations = [])
    {
        $query = Product::query();

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
        $query = Product::query();

        if (!empty($filters)) {

                $query->where($filters);
        }

        if (!empty($relations)) {

            $query->with($relations);
        }

        return !empty($filters) ? $query->get() : Product::all();
    }

    public function Update($id, array $data)
    {
        $product = Product::find($id);

        if (!$object) {
            throw new Exception("Product by given id doesn't exist");
        }

        $user->update($data);

        return $product;
    }

    public function Delete($id)
    {
        $product = Product::find($id);

        if($product == null){
            throw new Exception("Product by given doesn't exist");
        }

        $product->delete();

        return $product;
    }
}