<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Helpers\ResponseBody as Result;

class SubCategoryRepository
{
    public function Insert(array $data)
    {
        $subCategory = SubCategory::create($data);

        return $subCategory;
    }
    public function Select(array $filters = [], array $relations = [])
    {
        $query = SubCategory::query();

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
            $query = SubCategory::query();

        if (!empty($filters)) {

                $query->where($filters);
        }

        if (!empty($relations)) {

            $query->with($relations);
        } 

        return !empty($filters) ? $query->get() : SubCategory::all();
        
    }

    public function Update($id, array $data)
    {
        $subCategory = SubCategory::find($id);

        if (!$subCategory) {
            throw new Exception("SubCategory by given id doesn't exist");
        }

        $subCategory->update($data);

        return $subCategory;
    }

    public function Delete($id)
    {
        $subCategory = SubCategory::find($id);

        if($subCategory == null){
            throw new Exception("SubCategory by given doesn't exist");
        }

        $subCategory->delete();

        return $subCategory;
    }
}