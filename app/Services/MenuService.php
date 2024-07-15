<?php

namespace App\Services;


use App\Services\Interfaces\MenuServiceInterface;
use App\Repositories\Interfaces\MenuRepositoryInterface as MenuRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
/**
 * Class MenuService
 * @package App\Services
 */
class MenuService implements MenuServiceInterface
{

    protected $menuRepository;
    

    public function __construct(
        MenuRepository $menuRepository
    ){
        $this->menuRepository = $menuRepository;
    }

    

    public function paginate($request){

        // $condition['keyword'] = addslashes($request->input('keyword'));
        // $condition['publish'] = $request->integer('publish');
        // $perPage = $request->integer('perpage');
        // $menus = $this->menuRepository->pagination(
        //     $this->paginateSelect(), 
        //     $condition, 
        //     $perPage, 
        //     ['path' => 'menu/index'], 
        // );
        return [];
    }

    public function create($request){
        DB::beginTransaction();
        try{

            $payload = $request->except(['_token','send','re_password']);
            // if($payload['birthday'] != null){
            //     $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
            // }
            $payload['password'] = Hash::make($payload['password']);
            $menu = $this->menuRepository->create($payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function update($id, $request){
        DB::beginTransaction();
        try{

            $payload = $request->except(['_token','send']);
            $menu = $this->menuRepository->update($id, $payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try{
            $menu = $this->menuRepository->delete($id);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function updateStatus($post = []){
        DB::beginTransaction();
        try{
            $payload[$post['field']] = (($post['value'] == 1)?2:1);
            $menu = $this->menuRepository->update($post['modelId'], $payload);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function updateStatusAll($post){
        DB::beginTransaction();
        try{
            $payload[$post['field']] = $post['value'];
            $flag = $this->menuRepository->updateByWhereIn('id', $post['id'], $payload);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }
    
    private function paginateSelect(){
        return [
            'id', 
            // 'email', 
            // 'phone',
            // 'address', 
            // 'name',
            // 'publish',
            // 'Menu_catalogue_id'
        ];
    }



}
