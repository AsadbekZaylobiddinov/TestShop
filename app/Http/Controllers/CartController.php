<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Interfaces\ICartService;

class CartController extends Controller
{
    protected $_cartService;

    public function __construct(ICartService $cartService)
    {
        $this->_cartService = $cartService;
    }
    /**
     * Display a listing of the resource.
     */


    public function show($userId)
    {
        return response()->json($this->_cartService->GetByUserId($userId));
    }

    public function store(Request $request)
    {
        return response()->json($this->_cartService->AddProductToCart($request->input('cartId'),$request->input('productId')));
    }

    public function destroy(Request $request)
    {
        return response()->json($this->_cartService->DeleteProductToCart($request->input('cartId'),$request->input('productId')));
    }
}
