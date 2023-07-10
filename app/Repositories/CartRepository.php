<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartRepository
{
    public function Insert(array $data)
    {
        $cart = Cart::create($data);

        return $cart;
    }
    public function Select(array $filters = [], array $relations = [])
    {
        $query = Cart::query();

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
        $query = Cart::query();

        if (!empty($filters)) {

                $query->where($filters);
        }

        if (!empty($relations)) {

            $query->with($relations);
        }

        return !empty($filters) ? $query->get() : Cart::all();
    }

    public function Update($id, array $data)
    {
        $cart = Cart::find($id);

        if (!$object) {
            throw new Exception("Cart by given id doesn't exist");
        }

        $cart->update($data);

        return $cart;
    }

    public function Delete($id)
    {
        $cart = Cart::find($id);

        if($cart == null){
            throw new Exception("Cart by given doesn't exist");
        }

        $cart->delete();

        return $cart;
    }
}