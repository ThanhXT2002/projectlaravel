<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\MenuServiceInterface  as MenuService;
use App\Repositories\Interfaces\MenuRepositoryInterface as MenuRepository;
use App\Repositories\Interfaces\MenuCatalogueRepositoryInterface as MenuCatalogueRepository;
use App\Services\Interfaces\MenuCatalogueServiceInterface as MenuCatalogueService;

use App\Models\Language;

class MenuController extends Controller
{

    protected $menuService;
    protected $menuRepository;
    protected $menuCatalogueRepository;
    protected $language;
    protected $menuCatalogueService;
   

    public function __construct(
        MenuService $menuService,   
        MenuRepository $menuRepository,
        MenuCatalogueRepository $menuCatalogueRepository,
        MenuCatalogueService $menuCatalogueService,


      
    ){
        $this->menuService = $menuService;
        $this->menuRepository = $menuRepository;
        $this->menuCatalogueRepository = $menuCatalogueRepository;
        $this->menuCatalogueService = $menuCatalogueService;

        $this->middleware(function($request, $next){
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            return $next($request);
        });

    }


    public function index(Request $request){ 
        $this->authorize('modules', 'menu.index');
        
        $menuCatalogues = $this->menuCatalogueService->paginate($request, 1);
        $config = [
            'js'=> [
                'backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
                'backend/plugins/select2/js/select2.full.min.js',
                'backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js',
                'backend/plugins/moment/moment.min.js',
                'backend/plugins/inputmask/jquery.inputmask.min.js',
                'backend/plugins/daterangepicker/daterangepicker.js',
                'backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js',
                'backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                
            ],
            'css'=>[
                'backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css', 
                'backend/plugins/select2/css/select2.min.css',
                'backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
            ],
            'model' => 'MenuCatalogue'
        ];
        $config['seo'] = __('messages.menu'); 
       
        return view('backend.menu.index',compact(
            'menuCatalogues',
             'config',
             
        ));
    }

    public function create(){
        $this->authorize('modules', 'menu.create');
        $menuCatalogues = $this->menuCatalogueRepository->all();
        $config = $this->config();
        $config['seo'] = __('messages.menu');
        $config['method'] = 'create';
        return view('backend.menu.store',compact(
            'config',
            'menuCatalogues'
        ));
    }

    public function store(StoreMenuRequest $request)
    {
        if($this->menuService->create($request, $this->language)){
            return redirect()->route('menu.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('menu.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){
        $this->authorize('modules', 'menu.edit');
        $menu = $this->menuRepository->findById($id);
        $config = $this->config();
        $config['seo'] = __('messages.menu');
        $config['method'] = 'edit';
        return view('backend.menu.store',compact(
            'config',
            'menu',
            'MenuCatalogues'
        ));
    }

    public function update($id, UpdateMenuRequest $request){
        if($this->menuService->update($id, $request)){
            return redirect()->route('menu.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('menu.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){
        $this->authorize('modules', 'menu.delete');
        $config['seo'] = __('messages.menu');
        $menu = $this->menuRepository->findById($id);
        return view('backend.menu.delete', compact(
            'menu',
            'config',
        ));
    }

    public function destroy($id){
        if($this->menuService->destroy($id)){
            return redirect()->route('menu.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('menu.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function config(){
        return [
            'js'=> [
                'backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
                'backend/plugins/select2/js/select2.full.min.js',
                'backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
                'backend/library/menu.js',
                
            ],
            'css'=>[
                'backend/plugins/select2/css/select2.min.css',
                'backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                
            ],
        ];
    }
}




