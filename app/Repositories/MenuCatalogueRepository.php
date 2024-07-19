<?php

namespace App\Repositories;

use App\Models\MenuCatalogue;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Services\Interfaces\MenuCatalogueServiceInterface;

/**
 * Class MenuCatalogueService
 * @package App\Services
 */
class MenuCatalogueRepository extends BaseRepository implements MenuCatalogueRepositoryInterface
{
    protected $model;

    public function __construct(
        MenuCatalogue $model
    ){
        $this->model = $model;
    }

    // public function getAllPaginate(){
    //     $MenuCatalogues = MenuCatalogue::paginate(20);
    //     return $MenuCatalogues = MenuCatalogue::paginate(20);
    // }
    
    // public function MenuCataloguePagination(
    //     array $column = ['*'], 
    //     array $condition = [], 
    //     int $perPage = 1,
    //     array $extend = [],
    //     array $orderBy = ['id', 'DESC'],
    //     array $join = [],
    //     array $relations = [],
    // ){

    //     $query = $this->model->select($column)->where(function($query) use ($condition){
    //         if(isset($condition['keyword']) && !empty($condition['keyword'])){
    //             $query->where('name', 'LIKE', '%'.$condition['keyword'].'%')
    //                   ->orWhere('email', 'LIKE', '%'.$condition['keyword'].'%')
    //                   ->orWhere('address', 'LIKE', '%'.$condition['keyword'].'%')
    //                   ->orWhere('phone', 'LIKE', '%'.$condition['keyword'].'%');
    //         }
    //         if(isset($condition['publish']) && $condition['publish'] != 0){
    //             $query->where('publish', '=', $condition['publish']);
    //         }
    //         return $query;
    //     })->with('MenuCatalogue_catalogues');
    //     if(!empty($join)){
    //         $query->join(...$join);
    //     }

    //     return $query->paginate($perPage)
    //                 ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    // }
}
