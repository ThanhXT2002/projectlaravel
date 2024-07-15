<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\AttributeServiceInterface  as AttributeService;
use App\Repositories\Interfaces\AttributeRepositoryInterface  as AttributeRepository;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Http\Requests\DeleteAttributeRequest;
use App\Classes\Nestedsetbie;
use App\Models\Language;

class AttributeController extends Controller
{
    protected $attributeService;
    protected $attributeRepository;
    protected $languageRepository;
    protected $language;

    public function __construct(
        AttributeService $attributeService,
        AttributeRepository $attributeRepository,
    ){
        $this->middleware(function($request, $next){
            $locale = app()->getLocale(); // vn en cn
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            $this->initialize();
            return $next($request);
        });

        $this->attributeService = $attributeService;
        $this->attributeRepository = $attributeRepository;
        $this->initialize();
        
    }

    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => 'attribute_catalogues',
            'foreignkey' => 'attribute_catalogue_id',
            'language_id' =>  $this->language,
        ]);
    } 

    public function index(Request $request){
        $this->authorize('modules', 'attribute.index');
        $attributes = $this->attributeService->paginate($request, $this->language);
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
            'model' => 'Attribute'
        ];
        $config['seo'] = __('messages.attribute');
        $dropdown  = $this->nestedset->Dropdown();
        return view('backend.attribute.attribute.index', compact(
            'config',
            'dropdown',
            'attributes'
        ));
    }

    public function create(){
        $this->authorize('modules', 'attribute.create');
        $config = $this->configData();
        $config['seo'] = __('messages.attribute');
        $config['method'] = 'create';
        $dropdown  = $this->nestedset->Dropdown();
        return view('backend.attribute.attribute.store', compact(
            'dropdown',
            'config',
        ));
    }

    public function store(StoreAttributeRequest $request){
        if($this->attributeService->create($request, $this->language)){
            return redirect()->route('attribute.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('attribute.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){
        $this->authorize('modules', 'attribute.edit');
        $attribute = $this->attributeRepository->getAttributeById($id, $this->language);
        $config = $this->configData();
        $config['seo'] = __('messages.attribute');
        $config['method'] = 'edit';
        $dropdown  = $this->nestedset->Dropdown();
        $album = json_decode($attribute->album);
        return view('backend.attribute.attribute.store', compact(
            'config',
            'dropdown',
            'attribute',
            'album',
        ));
    }

    public function update($id, UpdateAttributeRequest $request){
        if($this->attributeService->update($id, $request, $this->language)){
            return redirect()->route('attribute.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('attribute.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){
        $this->authorize('modules', 'attribute.delete');
        $config['seo'] = __('messages.attribute');
        $attribute = $this->attributeRepository->getAttributeById($id, $this->language);
        return view('backend.attribute.attribute.delete', compact(
            'attribute',
            'config',
        ));
    }

    public function destroy($id){
        if($this->attributeService->destroy($id, $this->language)){
            return redirect()->route('attribute.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('attribute.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
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
