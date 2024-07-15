<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Services\Interfaces\MenuServiceInterface;

/**
 * Class MenuService
 * @package App\Services
 */
class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    protected $model;

    public function __construct(
        Menu $model
    ){
        $this->model = $model;
    }

    // public function getAllPaginate(){
    //     $Menus = Menu::paginate(20);
    //     return $Menus = Menu::paginate(20);
    // }
    
    // public function MenuPagination(
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
    //     })->with('Menu_catalogues');
    //     if(!empty($join)){
    //         $query->join(...$join);
    //     }

    //     return $query->paginate($perPage)
    //                 ->withQueryString()->withPath(env('APP_URL').$extend['path']);
    // }
}
