<?php

namespace App\Http\Controllers\Portal\API\Repository;


use App\Models\Resources;
use App\Models\Users;
use Exception;

class ResourcesRepository
{

    /**
     * @param array $filter
     *
     * @return mixed
     * @throws Exception
     */
    public static function listOrSingle(array $filter): mixed
    {
        $rv = Resources::where('company_id', $filter['company_id']);

        // If ID exist then return single data
        if(isset($filter['id']) && !empty($filter['id'])){
            $resource = $rv->find($filter['id']);
            if($resource == null){
                throw new Exception('Cannot find resources', 404);
            }
            return $resource;
        }

        // else return list
        $rv->select('id','name', 'description')->orderBy($filter['sort_by'], $filter['sort_mode']);

        // If keyword is not empty then return based on keyword
        if (!empty($filter['keyword'])) {
            $rv->where(function ($q) use ($filter) {
                $q->where('name', 'LIKE', '%' . $filter['keyword'] . '%');
                $q->orWhere('description', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }
        return $rv->paginate($filter['limit']);
    }

    /**
     * @param array $resourceData
     *
     * @return Resources
     * @throws Exception
     */
    public static function create(array $resourceData): Resources
    {
        $resource = new Resources();
        $resource->name = $resourceData['name'];
        $resource->description = $resourceData['description'];
        $resource->company_id = $resourceData['company_id'];
        if(!$resource->save()){
            throw new Exception('Cannot save resource', 422);
        }
        return $resource;
    }

    /**
     * @param array $resourceData
     * @param Resources $resource
     * @return Resources
     * @throws Exception
     */
    public static function update(array $resourceData, Resources $resource): Resources
    {
        $resource->name = $resourceData['name'];
        $resource->description = $resourceData['description'];
        if(!$resource->save()){
            throw new Exception('Cannot update resource', 422);
        };
        return $resource;
    }

}
