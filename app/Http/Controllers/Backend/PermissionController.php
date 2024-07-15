<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\PermissionServiceInterface  as PermissionService;
use App\Repositories\Interfaces\PermissionRepositoryInterface  as PermissionRepository;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
    protected $permissionService;
    protected $permissionRepository;

    public function __construct(
        PermissionService $permissionService,
        PermissionRepository $permissionRepository
    ){
        $this->permissionService = $permissionService;
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'permission.index');
        $permissions  = $this->permissionService->paginate($request);

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
            'model' => 'Permission',
        ];
        $config['seo'] = __('messages.permission');
        return view('backend.permission.index', compact(
            'config',
            'permissions'
        ));
    }

    public function create(){
        $this->authorize('modules', 'permission.create');
        $config = $this->configData();
        $config['seo'] = __('messages.permission');
        $config['method'] = 'create';
        $config['model'] = 'Permission';
        return view('backend.permission.store', compact(
            'config',
        ));
    }

    public function store(StorePermissionRequest $request){
        if($this->permissionService->create($request)){
            return redirect()->route('permission.create')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('permission.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){
        $this->authorize('modules', 'permission.edit');
        $permission = $this->permissionRepository->findById($id);
        $config = $this->configData();
        $config['seo'] = __('messages.permission');
        $config['method'] = 'edit';
        $config['model'] = 'Permission';
        return view('backend.permission.store', compact(
            'config',
            'permission',
        ));
    }

    public function update($id, UpdatePermissionRequest $request){
        if($this->permissionService->update($id, $request)){
            return redirect()->route('permission.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('permission.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){
        $this->authorize('modules', 'permission.delete');
        $config['seo'] = __('messages.permission');
        $permission = $this->permissionRepository->findById($id);
        return view('backend.permission.delete', compact(
            'permission',
            'config',
        ));
    }

    public function destroy($id){
        if($this->permissionService->destroy($id)){
            return redirect()->route('permission.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('permission.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function configData(){
        return [
           
          
        ];
    }

   

}
