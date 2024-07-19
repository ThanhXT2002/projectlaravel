<?php

namespace App\Services;


use App\Services\Interfaces\MenuCatalogueServiceInterface;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface as MenuCatalogueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * Class MenuCatalogueService
 * @package App\Services
 */
class MenuCatalogueService implements MenuCatalogueServiceInterface
{

    protected $menuCatalogueRepository;
    

    public function __construct(
        MenuCatalogueRepository $menuCatalogueRepository
    ){
        $this->menuCatalogueRepository = $menuCatalogueRepository;
    }

    

    public function paginate($request){

        // $condition['keyword'] = addslashes($request->input('keyword'));
        // $condition['publish'] = $request->integer('publish');
        // $perPage = $request->integer('perpage');
        // $menuCatalogues = $this->menuCatalogueRepository->pagination(
        //     $this->paginateSelect(), 
        //     $condition, 
        //     $perPage, 
        //     ['path' => 'MenuCatalogue/index'], 
        // );
        return [];
    }

    public function create($request){
        DB::beginTransaction();
        try{

            $payload = $request->only('name','keyword');
            $payload['keyword'] = Str::slug($payload['keyword']);
            $menuCatalogue = $this->menuCatalogueRepository->create($payload);
            DB::commit();
            return [
                'name'=>$menuCatalogue->name,
                'id' => $menuCatalogue->id
            ];
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
            $menuCatalogue = $this->menuCatalogueRepository->update($id, $payload);
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
            $menuCatalogue = $this->menuCatalogueRepository->delete($id);

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
            $menuCatalogue = $this->menuCatalogueRepository->update($post['modelId'], $payload);

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
            $flag = $this->menuCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);

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
            // 'name',
            // 'publish',
            // 'MenuCatalogue_catalogue_id'
        ];
    }



}
