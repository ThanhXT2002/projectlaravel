<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\{$class}CatalogueServiceInterface  as {$class}CatalogueService;
use App\Repositories\Interfaces\{$class}CatalogueRepositoryInterface  as {$class}CatalogueRepository;
use App\Http\Requests\Store{$class}CatalogueRequest;
use App\Http\Requests\Update{$class}CatalogueRequest;
use App\Http\Requests\Delete{$class}CatalogueRequest;
use App\Classes\Nestedsetbie;
use Auth;
use App\Models\Language;
use Illuminate\Support\Facades\App;
class {$class}CatalogueController extends Controller
{

    protected ${module}CatalogueService;
    protected ${module}CatalogueRepository;
    protected $nestedset;
    protected $language;

    public function __construct(
        {$class}CatalogueService ${module}CatalogueService,
        {$class}CatalogueRepository ${module}CatalogueRepository
    ){
        $this->middleware(function($request, $next){
            $locale = app()->getLocale();
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            $this->initialize();
            return $next($request);
        });


        $this->{module}CatalogueService = ${module}CatalogueService;
        $this->{module}CatalogueRepository = ${module}CatalogueRepository;
    }

    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => '{module}_catalogues',
            'foreignkey' => '{module}_catalogue_id',
            'language_id' =>  $this->language,
        ]);
    } 
 
    public function index(Request $request){
        $this->authorize('modules', '{module}.catalogue.index');
        ${module}Catalogues = $this->{module}CatalogueService->paginate($request, $this->language);
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
            'model' => '{$class}Catalogue',
        ];
        $config['seo'] = __('messages.{module}Catalogue');
        return view('backend.{module}.catalogue.index', compact(
            'config',
            '{module}Catalogues'
        ));
    }

    public function create(){
        $this->authorize('modules', '{module}.catalogue.create');
        $config = $this->configData();
        $config['seo'] = __('messages.{module}Catalogue');
        $config['method'] = 'create';
        $dropdown  = $this->nestedset->Dropdown();
        return view('backend.{module}.catalogue.store', compact(
            'dropdown',
            'config',
        ));
    }

    public function store(Store{$class}CatalogueRequest $request){
        if($this->{module}CatalogueService->create($request, $this->language)){
            return redirect()->route('{module}.catalogue.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('{module}.catalogue.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){
        $this->authorize('modules', '{module}.catalogue.edit');
        ${module}Catalogue = $this->{module}CatalogueRepository->get{$class}CatalogueById($id, $this->language);
        $config = $this->configData();
        $config['seo'] = __('messages.{module}Catalogue');
        $config['method'] = 'edit';
        $dropdown  = $this->nestedset->Dropdown();
        return view('backend.{module}.catalogue.store', compact(   
            'config',
            'dropdown',
            '{module}Catalogue',
        ));
    }

    public function update($id, Update{$class}CatalogueRequest $request){
        if($this->{module}CatalogueService->update($id, $request, $this->language)){
            return redirect()->route('{module}.catalogue.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('{module}.catalogue.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){
        $this->authorize('modules', '{module}.catalogue.delete');
        $config['seo'] = __('messages.{module}Catalogue');
        ${module}Catalogue = $this->{module}CatalogueRepository->get{$class}CatalogueById($id, $this->language);
        return view('backend.{module}.catalogue.delete', compact(
            '{module}Catalogue',
            'config',
        ));
    }

    public function destroy(Delete{$class}CatalogueRequest $request, $id){
        if($this->{module}CatalogueService->destroy($id, $this->language)){
            return redirect()->route('{module}.catalogue.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('{module}.catalogue.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function configData(){
        return [
            'js' => [
                'backend/plugins/ckeditor/ckeditor.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
                'backend/library/seo.js',
                'backend/plugins/select2/js/select2.full.min.js',
                'backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js',
                
            ],
            'css' => [

                'backend/plugins/select2/css/select2.min.css',
                'backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
               
            ]
          
        ];
    }

}
