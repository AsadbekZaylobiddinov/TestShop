<?php

namespace App\Services;


use Illuminate\Http\Request;
use App\Helpers\ResponseBody as Result;
use App\Repositories\CategoryRepository;
use App\DTOs\Category\CategoryDto;
use App\Repositories\SubCategoryRepository;
use App\Interfaces\ICategoryService;

class CategoryService implements ICategoryService
{
    protected $_categoryRepository;
    protected $_subCategoryRepository;

    public function __construct(CategoryRepository $categoryRepository,
    SubCategoryRepository $subCategoryRepository)
    {
        $_categoryRepository = $categoryRepository;
        $_subCategoryRepository = $subCategoryRepository;
    }

    public function Add(Request $request)
    {
        $category = $this->_categoryRepository->Select([["name","=",$request->input("name")]]); 

        $dto = CategoryDto::forCreation($request);

        $dto->validate();

        if(!$category) 
        {
           $category = $this->_categoryRepository->Insert($dto->toArray());
        }
        else{
            throw new Result(409,'Already exists',null);
        }

        return new Result(200, "Successful", $category);
    }

    public function GetById($id)
    {
        $category = $this->_categoryRepository->Select([
            ["id","=",$id]
        ]);
        $result;
        if($category != null)
        {
            $result = new Result(200,"Successful",CategoryDto::forResult($category));
        }
        else{
            $result = new Result(404,"Not Found",null);
        }

        return $result;
    }

    public function GetAll()
    {
        return new Result(200, "Successful",$this->_categoryRepository->SelectAll());
    }

    public function Modify(Request $request, $name)
    {
        $category = $this->_categoryRepository->Select([['name','=',$name]]);

        if($category){
            return new Result(200,"Successful",$this->_categoryRepository->Update($id,CategoryDto::forResult($category)));
        }
        else{
            throw new Result(404,"Not Found",null);
        }
    }

    public function Delete($id)
    {
        $category = $this->_categoryRepository->Delete($id);

        return new Result(200,"Successful",$category =CategoryDto::forResult($category));
    }

    public function AddSubCategory(Request $request,$categoryId)
    {
        $category = $this->_categoryRepository->Select([["id","=",$categoryId]]);

        if($category)
        {
           $subCategories = $this->_subCategoryRepository->SelectAll([
            ['category_id','=',$categoryId]
           ]);

           if(Count($subCategories)<11)
           {
               $subCategory = $this->_subCategoryRepository->Select([
                   ["name","=",$request->input('name')],
                   ["category_id","=",$categoryId]
                ]);

                if(!$subCategory)
                {
                    return new Result(200,"Successful",$this->_subCategoryRepository->Insert([
                        'name'=>$request->input('name'),
                        'category_id'=>$categoryId
                    ]));
                }
                else{
                    return new Result(409,"SubCategory with given name for this category already exists");
                }
            }
            else{
                return new Result(500,"Too many SubCategories for this category");
            }
        }
        else{
            throw new Result(409,'Already exists',null);
        }
    }
}