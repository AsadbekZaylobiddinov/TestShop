<?php

namespace App\Services;


use Illuminate\Http\Request;
use App\Interfaces\ICartService;
use App\Repositories\CartRepository;
use App\Helpers\ResponseBody as Result;

class CartService implements ICartService
{
    private $_cartRepository;
    private $_cartProductRepository;

    public function __construct(CartRepository $cartRepository,
    CartProductRepository $cartProductRepository)
    {
        $_cartRepository = $cartRepository;
        $_cartProductRepository = $cartProductRepository;
    }

    public function GetByUserId($userId)
    {
        $cart = $_cartRepository->Select([["user_id","=",$userId]]);
        $result;
        if($cart != null)
        {
            $result = new Result(200,"Successful",$cart);
        }
        else{
            $result = new Result(404,"Not Found",null);
        }

        return $result;
    }

    public function AddProductToCart($cartId, $productId)
    {
        $cartProduct = $_cartProductRepository->Select([
            ['cart_id','=',$userId],
            ['product_id','=',$productId]
        ]);


        if(!$cartProduct)
        {
            return new Result(200,'Successful',$_cartProductRepository->Insert([
                'cart_id' => $cartId,
                'product_id' => $productId
            ]));
        }else{
            throw new Result(409, "Already Exists", null);
        }
    }

    public function DeleteProductFromCart($cartId, $productId)
    {
        $cartProduct = $_cartProductRepository->Select([
            ['cart_id','=',$userId],
            ['product_id','=',$productId]
        ]);

        if($cartProduct)
        {
            return new Result(200,'Successful',$_cartProductRepository->Delete($cartProduct->id));
        }else{
            throw new Result(404,"Not Found",null);
        }
    }
}