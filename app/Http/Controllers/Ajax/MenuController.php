<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\MenuRepositoryInterface  as MenuRepository;
// use App\Models\Language;
use App\Http\Requests\StoreMenuCatalogueRequest;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface  as MenuCatalogueRepository;
use App\Repositories\Interfaces\MenuCatalogueServiceInterface  as MenuCatalogueService;



class MenuController extends Controller
{
    protected $menuCatalogueRepository;
    protected $menuCatalogueService;

    // protected $language;

    public function __construct(
        MenuCatalogueRepository $menuCatalogueRepository,
        MenuCatalogueService $menuCatalogueService

    ){
        $this->menuCatalogueRepository = $menuCatalogueRepository;
        $this->menuCatalogueService = $menuCatalogueService;

        // $this->middleware(function($request, $next){
        //     $locale = app()->getLocale(); // vn en cn
        //     $language = Language::where('canonical', $locale)->first();
        //     $this->language = $language->id;
        //     return $next($request);
        // });
    }

    public function createCatalogue(StoreMenuCatalogueRequest $request){
        $menuCatalogue = $this->menuCatalogueService->create($request);
        if($menuCatalogue !== FALSE){
            return response()->json([
                'message' => 'Tao nhom menu thah cong',
                'code' => 0,
                'data' =>  $menuCatalogue,
            ]);
        }
        return response()->json([
            'message' => 'Co van de xay ra, hay thu lai',
            'code' => 1
        ]);
    }
}
