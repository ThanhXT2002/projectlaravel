<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Str;


class DashboardController extends Controller
{
    protected $language;

    public function __construct(
       
    ){
        $this->middleware(function($request, $next){
            $locale = app()->getLocale(); // vn en cn
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
          
            return $next($request);
        });
    }



    public function changeStatus(Request $request){
        $post = $request->input();
        $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        $flag = $serviceInstance->updateStatus($post);

        return response()->json(['flag' => $flag]); 
        
    }

    public function changeStatusAll(Request $request){
        $post = $request->input();
        $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        $flag = $serviceInstance->updateStatusAll($post);
        return response()->json(['flag' => $flag]); 

    }

    public function getMenu(Request $request){
        $model= $request->input('model');
        $serviceInterfaceNamespace = '\App\Repositories\\' . ucfirst($model) . 'Service';
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        // $object = $serviceInterfaceNamespace->pagination($request, $this->language);
        $agruments = $this->paginationArgrument($model);
    }

    private function paginationArgrument(string $model = ''):array{
        $model = Str::snake($model);
        return [
            'select' => ['id', 'name'],
            'condition' => [
                'where' => [
                    ['tb2,language_id', '=', $this->language],
                ]
            ],
            'perpage' =>10,
            'paginationConfig' => [
                'path'=>$model.'/index',
                'groupBy' => ['id', 'name']
                
            ],
            'orderBy' => [$model.'s.id', 'DESC'],
            'relations' => [],
            'join' => [
                [$model.'_language as tb2', 'tb2,post_id', '=', $model.'s.id'],
                ['post_catalogue_post as tb3', 'post.id', '=', ' tb3.pist_id'],
            ],
        ];
    }


   
   
}
