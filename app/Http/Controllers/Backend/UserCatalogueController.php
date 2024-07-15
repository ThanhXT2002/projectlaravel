<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Services\Interfaces\UserCatalogueServiceInterface  as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface  as UserCatalogueRepository;
use App\Repositories\Interfaces\PermissionRepositoryInterface  as PermissionRepository;
use App\Http\Requests\StoreUserCatalogueRequest;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;
    protected $permissionRepository;

    public function __construct(
        UserCatalogueService $userCatalogueService,
        UserCatalogueRepository $userCatalogueRepository,
        PermissionRepository $permissionRepository
    ){
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
        $this->permissionRepository = $permissionRepository;
    }


    public function index(Request $request){
        $this->authorize('modules', 'user.catalogue.index');
        $userCatalogues = $this->userCatalogueService->paginate($request);
        $config = $this->config();
        $config['seo'] = __('messages.userCatalogue');
        return view('backend.user.catalogue.index', compact(
            'config',
            'userCatalogues'
        ));
    }

    public function create(){
        $this->authorize('modules', 'user.catalogue.create');

        $config['seo'] = __('messages.userCatalogue');
        $config['method'] = 'create';
        return view('backend.user.catalogue.store', compact(
            'config',
        ));
    }

    public function store(StoreUserCatalogueRequest $request){
        if($this->userCatalogueService->create($request)){
            return redirect()->route('user.catalogue.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){
        $this->authorize('modules', 'user.catalogue.edit');
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $config['seo'] = __('messages.userCatalogue');
        $config['method'] = 'edit';
        return view('backend.user.catalogue.store', compact(
           
            'config',
            'userCatalogue',
        ));
    }

    public function update($id, StoreUserCatalogueRequest $request){
        if($this->userCatalogueService->update($id, $request)){
            return redirect()->route('user.catalogue.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){
        $this->authorize('modules', 'user.catalogue.delete');
        $config['seo'] = __('messages.userCatalogue');
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        return view('backend.user.catalogue.delete', compact(
            'userCatalogue',
            'config',
        ));
    }

    public function destroy($id){
        try {
            if($this->userCatalogueService->destroy($id)){
                return redirect()->route('user.catalogue.index')->with('success', 'Xóa bản ghi thành công');
            }
        } catch (\Exception $e) { // Bắt tất cả các ngoại lệ
            // echo "Caught exception: " . get_class($e) . " with message: " . $e->getMessage();
            
            // Kiểm tra lỗi 1451 (ràng buộc khóa ngoại)
            if($e instanceof QueryException && $e->getCode() == 1451){
                return redirect()->route('user.catalogue.index')->with('error', 'Không thể xóa do mục này còn tồn tại bản ghi liên quan');
            }
            
            // Xử lý các lỗi khác nếu cần
            return redirect()->route('user.catalogue.index')->with('error', 'Xóa bản ghi không thành công. Hãy thử lại');
        }
        // if($this->userCatalogueService->destroy($id)){
        //     return redirect()->route('user.catalogue.index')->with('success','Xóa bản ghi thành công');
        // }
        // return redirect()->route('user.catalogue.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function config(){
        return [
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
            'model' => 'UserCatalogue',
        ];
    }

    public function permission(){
        $this->authorize('modules', 'user.catalogue.permission');
        $userCatalogues = $this->userCatalogueRepository->all(['permissions']);
        $permissions = $this->permissionRepository->all();
        $config = $this->config();
        $config['method'] = 'permission';
        $config['seo'] = __('messages.userCatalogue');
        return view('backend.user.catalogue.permission', compact(
            'userCatalogues',
            'permissions',
            'config',
        ));
    }

    public function updatePermission(Request $request){
        if($this->userCatalogueService->setPermission($request)){
            return redirect()->route('user.catalogue.index')->with('success','Cập nhật quyền thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error','Có vấn đề xảy ra, Hãy thử lại');
    }
}
