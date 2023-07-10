<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface ICartService{

    public function GetByUserId($userId);

    public function AddProductToCart($cartId, $productId);

    public function DeleteProductFromCart($cartId, $productId);
}