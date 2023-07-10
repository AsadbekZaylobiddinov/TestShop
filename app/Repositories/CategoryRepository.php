<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Helpers\ResponseBody as Result;

class CategoryRepository
{
    public function Insert(array $data)
    {
        $category = Category::create($data);

        return $category;
    }
    
    public function Select(array $filters = [], array $relations = [])
    {
        $query = Category::query();

        if (!empty($filters)) {

            $query->where($filters);
        }

        if (!empty($relations)) {

            $query->with($relations);
        }

        return $query->first();
    }

    public function SelectAll(array $filters = [],  array $relations = [])
    {
            $query = Category::query();

        if (!empty($filters)) {

                $query->where($filters);
        }

        if (!empty($relations)) {

            $query->with($relations);
        } 

        return !empty($filters) ? $query->get() : Category::all();
        
    }

    public function Update($id, array $data)
    {
        $category = Category::find($id);

        if (!$category) {
            throw new Exception("Category by given id doesn't exist");
        }

        $category->update($data);

        return $category;
    }

    public function Delete($id)
    {
        $category = Category::find($id);

        if($category == null){
            throw new Exception("Category by given doesn't exist");
        }

        $category->delete();

        return $category;
    }
}