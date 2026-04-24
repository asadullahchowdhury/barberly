<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\Categories;

use App\Models\Customers;

use App\Models\ServiceMembers;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoriesRepository
{


    /**
     * @param array $filter
     *
     * @return mixed
     * @throws Exception
     */
    public static function listOrSingle(array $filter):mixed
    {
        $rv = Categories::with(['services' => function ($query) use ($filter) {
            if(!empty($filter['member_id'])){
                $service_ids = ServiceMembers::where('member_id', $filter['member_id'])->pluck('service_id');
                $query->whereIn('id', $service_ids);
            }
        }])->where('company_user_id', $filter['user_id'])->orderBy('sort', 'asc');

        // If ID exist then return single data
        if(isset($filter['id']) && !empty($filter['id'])){
            $service = $rv->find($filter['id']);
            if($service == null){
                throw new Exception('Cannot find Category', 404);
            }
            return $service;
        }
        $rv->orderBy($filter['sort_by'], $filter['sort_mode']);
        // If keyword is not empty then return based on keyword
        if (!empty($filter['keyword'])) {
            $rv->where(function ($q) use ($filter) {
                $q->where('name', 'LIKE', '%' . $filter['keyword'] . '%');
                $q->orWhere('color', 'LIKE', '%' . $filter['keyword'] . '%');
                $q->orWhere('description', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }

        return $rv->paginate($filter['limit']);
    }


    /**
     * @param array $categoryData
     * @return Categories
     * @throws Exception
     */
    public static function create(array $categoryData):Categories
    {
        $categories = new Categories();
        $categories->name = $categoryData['name'];
        $categories->color = $categoryData['color'];
        $categories->description = $categoryData['description'];
        $categories->company_user_id = $categoryData['user_id'];
        $categories->company_id = $categoryData['company_id'];
        if (!$categories->save()){
            throw new Exception('Cannot save category', 422);
        };
        return $categories;
    }

    /**
     * @param array $categoryData
     * @param Categories $category
     * @return Categories
     * @throws Exception
     */
    public static function update(array $categoryData, Categories $category):Categories
    {
        $category->name = $categoryData['name'];
        $category->color = $categoryData['color'];
        $category->description = $categoryData['description'];
        if (!$category->save()){
            throw new Exception('Cannot update category', 422);
        };
        return $category;
    }


    /**
     * @param array $sortData
     * @return bool
     * @throws Exception
     */
    public static function sort(array $sortData):bool
    {
        foreach ($sortData['sort'] as $each){
            $category = Categories::where('id', $each['id'])->first();
            if($category == null){
                throw new Exception('Cannot find category', 404);
            }
            $category->sort = $each['sort'] ?? 0;
            if(!$category->save()){
                throw new Exception('Cannot save category', 422);
            };
        }
        return  true;
    }
}
