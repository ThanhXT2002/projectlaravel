<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\{$class}ServiceInterface  as {$class}Service;
use App\Repositories\Interfaces\{$class}RepositoryInterface  as {$class}Repository;
use App\Http\Requests\Store{$class}Request;
use App\Http\Requests\Update{$class}Request;
use App\Http\Requests\Delete{$class}Request;
use App\Classes\Nestedsetbie;
use App\Models\Language;

class {$class}Controller extends Controller
{
    protected ${module}Service;
    protected ${module}Repository;
    protected $languageRepository;
    protected $language;

    public function __construct(
        {$class}Service ${module}Service,
        {$class}Repository ${module}Repository,
    ){
        $this->middleware(function($request, $next){
            $locale = app()->getLocale(); // vn en cn
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            $this->initialize();
            return $next($request);
        });

        $this->{module}Service = ${module}Service;
        $this->{module}Repository = ${module}Repository;
        $this->initialize();
        
    }

    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => '{module}_catalogues',
            'foreignkey' => '{module}_catalogue_id',
            'language_id' =>  $this->language,
        ]);
    } 

    public function index(Request $request){
        $this->authorize('modules', '{module}.index');
        ${module}s = $this->{module}Service->paginate($request, $this->language);
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
            'model' => '{$class}'
        ];
        $config['seo'] = __('messages.{module}');
        $dropdown  = $this->nestedset->Dropdown();
        return view('backend.{module}.{module}.index', compact(
            'config',
            'dropdown',
            '{module}s'
        ));
    }

    public function create(){
        $this->authorize('modules', '{module}.create');
        $config = $this->configData();
        $config['seo'] = __('messages.{module}');
        $config['method'] = 'create';
        $dropdown  = $this->nestedset->Dropdown();
        return view('backend.{module}.{module}.store', compact(
            'dropdown',
            'config',
        ));
    }

    public function store(Store{$class}Request $request){
        if($this->{module}Service->create($request, $this->language)){
            return redirect()->route('{module}.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('{module}.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){
        $this->authorize('modules', '{module}.edit');
        ${module} = $this->{module}Repository->get{$class}ById($id, $this->language);
        $config = $this->configData();
        $config['seo'] = __('messages.{module}');
        $config['method'] = 'edit';
        $dropdown  = $this->nestedset->Dropdown();
        $album = json_decode(${module}->album);
        return view('backend.{module}.{module}.store', compact(
            'config',
            'dropdown',
            '{module}',
            'album',
        ));
    }

    public function update($id, Update{$class}Request $request){
        if($this->{module}Service->update($id, $request, $this->language)){
            return redirect()->route('{module}.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('{module}.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){
        $this->authorize('modules', '{module}.delete');
        $config['seo'] = __('messages.{module}');
        ${module} = $this->{module}Repository->get{$class}ById($id, $this->language);
        return view('backend.{module}.{module}.delete', compact(
            '{module}',
            'config',
        ));
    }

    public function destroy($id){
        if($this->{module}Service->destroy($id, $this->language)){
            return redirect()->route('{module}.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('{module}.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
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
