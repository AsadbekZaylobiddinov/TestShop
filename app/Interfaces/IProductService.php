<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface IProductService{

    public function Add(Request $request);

    public function GetById($id);

    public function GetAll();

    public function Modify(Request $request, $id);

    public function Delete($id);

    public function UploadProductImage(Request $request);

    public function DeleteProductImage($id);

}