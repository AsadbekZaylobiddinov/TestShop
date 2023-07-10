<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface ICategoryService{

    public function Add(Request $request);

    public function GetById($id);

    public function GetAll();

    public function Modify(Request $request, $name);

    public function Delete($id);

    public function AddSubCategory(Request $request, $categoryId);
}