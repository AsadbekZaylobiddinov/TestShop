<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Interfaces\ICategoryService;

class CategoryController extends Controller
{
    protected $_categoryService;

    public function __construct(ICategoryService $categoryService)
    {
        $this->_categoryService = $categoryService;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json($this->_categoryService->Add($request));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json($this->_categoryService->GetById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $name)
    {
        return response()->json($this->_categoryService->Modify($request,$name));
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        return response()->json($this->_categoryService->Delete($id));
    }


    public function addSubCategory($request)
    {
        return response()->json($this->_categoryService->AddSubCategory($request));
    }
}
