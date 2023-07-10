<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\CartProduct;

class CartProductRepository
{
    public function Insert(array $data)
    {
        $cartProduct = CartProduct::create($data);

        return $cartProduct;
    }
    public function Select(array $filters = [], array $relations = [])
    {
        $query = CartProduct::query();

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
        $query = CartProduct::query();

        if (!empty($filters)) {

                $query->where($filters);
        }

        if (!empty($relations)) {

            $query->with($relations);
        }

        return !empty($filters) ? $query->get() : CartProduct::all();
    }

    public function Update($id, array $data)
    {
        $cartProduct = CartProduct::find($id);

        if (!$object) {
            throw new Exception("CartProduct by given id doesn't exist");
        }

        $user->update($data);

        return $user;
    }

    public function Delete($id)
    {
        $cartProduct = CartProduct::find($id);

        if($cartProduct == null){
            throw new Exception("CartProduct by given doesn't exist");
        }

        $cartProduct->delete();

        return $cartProduct;
    }
}