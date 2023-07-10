<?php

namespace App\Services;


use Illuminate\Http\Request;
use App\Interfaces\IProductService;
use App\Helpers\ResponseBody as Result;
use App\DTOs\Product\ProductDto;
use App\DTOs\Product\ProductImageDto;
use App\Repositories\ProductRepository;
use App\Repositories\ProductImageRepository;

class ProductService implements IProductService
{
    protected $_productRepository;
    protected $_productImageRepository;

    public function __construct(ProductRepository $productRepository,
    ProductImageRepository $productImageRepository)
    {
        $_productRepository = $productRepository;
        $_productImageRepository = $productImageRepository;
    }

    //Создаёт продукт
    public function Add(Request $request)
    {
        $dto = ProductDto::forCreation($request);

        ProductDto::validate();

        $product = $_productRepository->Insert($dto->toArray());

        return new Result(200, "Successful", ProductDto::forResult($product));
    }

    //Возвращает продукт по заданному id
    public function GetById($id)
    {
        $product = $_productRepository->Select([["id","=",$id]]);
        $result;
        if($product != null)
        {
            $result = new Result(200,"Successful",ProductDto::forResult($product));
        }
        else{
            $result = new Result(404,"Not Found",null);
        }

        return $result;
    }

    //Возвращает все продукты
    public function GetAll()
    {
        return new Result(200,"Successful",ProductDto::forResult($this->_productRepository->Select()));
    }

    //Обновляет продукт
    public function Modify(Request $request, $id)
    {
        $product = $_productRepository->Select([['id','=',$id]]);

        if($product){
            return new Result(200,"Successful",$_productRepository->Update($id,ProductDto::forCreation($request)));
        }
        else{
            throw new Result(404,"Not Found",null);
        }
    }

    //Удаляет продукт по заданному id
    public function Delete($id)
    {
        $product = $_productRepository->Delete($id);

        return new Result(200,"Successful",ProductDto::forResult($product));
    }


    //Загружает фото продукты
    public function UploadProductImage(Request $request)
    {
        if ($request->hasFile('productImage')) {
            $file = $request->file('file'); 
        
            if ($file->isValid()) {

                $path = $file->store('uploads'); //Сохраняем файл в локальном диске

                if ($path) {

                    $dto = ProductImageDto::forCreation($request);

                    ProductImageDto::validate();

                    return new Result(200,"Successful",$_productImageRepository->Insert($dto->toArray()));

                }else{
                    echo 'Ошибка при сохранении файла.';
                }

            } else {
                echo 'Ошибка загрузки файла.';
            }
        }
    }


    // Удаляет фото продукта
    public function DeleteProductImage($id)
    {
        return new Result(200,"Successful",ProductImageDto::forResult($_productImageRepository->Delete($id)));
    }
}