<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\IUserService;

class UserController extends Controller
{
    protected $_userService;

    public function __construct(IUserService $userService)
    {
        $this->_userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return response()->json($this->_userService->GetAll());
        }
        catch(Exception $e){
            throw new Exception($e->message);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json($_userService->Add($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json($_userService->GetById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        return response()->json($_userService->Update($request,$id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return response()->json($_userService->Delete($id));
    }
}
