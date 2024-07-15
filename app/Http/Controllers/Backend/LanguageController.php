<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\LanguageServiceInterface  as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface  as LanguageRepository;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Http\Requests\TranslateRequest;
use Illuminate\Support\Facades\App;


class LanguageController extends Controller
{
    protected $languageService;
    protected $languageRepository;

    public function __construct(
        LanguageService $languageService,
        LanguageRepository $languageRepository
    ){
        $this->languageService = $languageService;
        $this->languageRepository = $languageRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'language.index');
        $languages = $this->languageService->paginate($request);

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
            'model' => 'Language',
        ];
        $config['seo'] = __('messages.language');
        return view('backend.language.index', compact(
            'config',
            'languages'
        ));
    }

    public function create(){
        $this->authorize('modules', 'language.create');
        $config = $this->configData();
        $config['seo'] = __('messages.language');
        $config['method'] = 'create';
        $config['model'] = 'Language';
        return view('backend.language.store', compact(
            'config',
        ));
    }

    public function store(StoreLanguageRequest $request){
        if($this->languageService->create($request)){
            return redirect()->route('language.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('language.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){
        $this->authorize('modules', 'language.edit');
        $language = $this->languageRepository->findById($id);
        $config = $this->configData();
        $config['seo'] = __('messages.language');
        $config['method'] = 'edit';
        $config['model'] = 'Language';
        return view('backend.language.store', compact(
            'config',
            'language'
        ));
    }

    public function update($id, UpdateLanguageRequest $request){
        if($this->languageService->update($id, $request)){
            return redirect()->route('language.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('language.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){
        $this->authorize('modules', 'language.delete');
        $config['seo'] = __('messages.language');
        $language = $this->languageRepository->findById($id);
        return view('backend.language.delete', compact(
            'language',
            'config',
        ));
    }

    public function destroy($id){
        if($this->languageService->destroy($id)){
            return redirect()->route('language.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('language.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function configData(){
        return [
            'js' => [
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
            ],
          
        ];
    }

    public function swicthBackendLanguage($id){
        $language = $this->languageRepository->findById($id);
        if($this->languageService->switch($id)){
            session(['app_locale' => $language->canonical]);
            App::setLocale($language->canonical);
            
        }
        return redirect()->back();
    }

    public function translate($id = 0, $languageId = 0, $model = ''){
        $repositoryInstance = $this->respositoryInstance($model);
        $languageInstance = $this->respositoryInstance('Language');
        $currentLanguage = $languageInstance->findByCondition([
            ['canonical' , '=', session('app_locale')]
        ]);
        $method = 'get'.$model.'ById';
        
        $object = $repositoryInstance->{$method}($id, $currentLanguage->id);
        $objectTransate = $repositoryInstance->{$method}($id, $languageId);

        $this->authorize('modules', 'language.translate');
        $config = [
            'js' => [  
                'backend/plugins/ckeditor/ckeditor.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
                'backend/library/seo.js',
                'backend/plugins/select2/js/select2.full.min.js',
            ],
            'css' => [
                'backend/plugins/select2/css/select2.min.css',
                'backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
            ],

        ];
        $option = [
            'id' => $id,
            'languageId' => $languageId,
            'model' => $model,
        ];

        $config['seo'] = __('messages.language');
        $config['method'] = 'translate';
        return view("backend.language.translate", compact(
            'config',
            'object',
            'objectTransate',
            'option',
        ));
    }

    public function storeTranslate(TranslateRequest $request){
        $option = $request->input('option');
        if($this->languageService->saveTranslate($option, $request)){
            return redirect()->back()->with('success', 'Cập nhật bản ghi thành công');
        }
        return redirect()->back()->with('error','Có vấn đề xảy ra, Hãy Thử lại');
    }

    private function respositoryInstance($model){
        $repositoryNamespace = '\App\Repositories\\' . ucfirst($model) . 'Repository';
        if (class_exists($repositoryNamespace)) {
            $repositoryInstance = app($repositoryNamespace);
        }
        return $repositoryInstance ?? null;
    }

}
