<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Interfaces\IProductService;

class ProductController extends Controller
{

    protected $_productService;

    public function __construct(IProductService $productService)
    {
        $this->_productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->_productService->GetAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json($this->_productService->Add($request));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json($this->_productService->GetById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        return response()->json($this->_productService->Modify($request,$id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        return response()->json($this->_productService->Delete($id));
    }

    public function uploadProductImage(Request $request,$id)
    {
        return response()->json($this->_productService->UploadProductImage($request));
    }

    public function destroyProductImage($id)
    {
        return response()->json($this->_productService->DeleteProductImage($id));
    }
}
