<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\GenerateServiceInterface  as GenerateService;
use App\Repositories\Interfaces\GenerateRepositoryInterface  as GenerateRepository;
use App\Http\Requests\StoreGenerateRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Http\Requests\TranslateRequest;

class GenerateController extends Controller
{
    protected $generateService;
    protected $generateRepository;

    public function __construct(
        GenerateService $generateService,
        GenerateRepository $generateRepository
    ){
        $this->generateService = $generateService;
        $this->generateRepository = $generateRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'generate.index');
        $generates = $this->generateService->paginate($request);

        $config = [ 
           'js'=> [
                'backend/plugins/select2/js/select2.full.min.js',
            ],
            'css'=>[
                'backend/plugins/select2/css/select2.min.css',
            ],
            'model' => 'Generate',
        ];
        $config['seo'] = __('messages.generate');
        
        return view('backend.generate.index', compact(
          
            'config',
            'generates'
        ));
    }

    public function create(){
        $this->authorize('modules', 'generate.create');
        $config = $this->configData();
        $config['seo'] = __('messages.generate');
        $config['method'] = 'create';
        $config['model'] = 'Generate';
        return view('backend.generate.store', compact(  
            'config',
        ));
    }

    public function store(StoreGenerateRequest $request){
        if($this->generateService->create($request)){
            return redirect()->route('dashboard.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('dashboard.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){
        $this->authorize('modules', 'generate.edit');
        $generate = $this->generateRepository->findById($id);
        $config = $this->configData();
        $config['seo'] = __('messages.generate');
        $config['method'] = 'edit';
        $config['model'] = 'Generate';
        $template = 'backend.generate.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'generate',
        ));
    }

    public function update($id, UpdateGenerateRequest $request){
        if($this->generateService->update($id, $request)){
            return redirect()->route('generate.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('generate.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){
        $this->authorize('modules', 'generate.delete');
        $config['seo'] = __('messages.generate');
        $generate = $this->generateRepository->findById($id);
        $template = 'backend.generate.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'generate',
            'config',
        ));
    }

    public function destroy($id){
        if($this->generateService->destroy($id)){
            return redirect()->route('generate.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('generate.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function configData(){
        return [
            'js'=> [
                'backend/plugins/select2/js/select2.full.min.js',
            ],
            'css'=>[
                'backend/plugins/select2/css/select2.min.css',
            ],
        ];
    }


}
