<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\PostServiceInterface  as PostService;
use App\Repositories\Interfaces\PostRepositoryInterface  as PostRepository;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\DeletePostRequest;
use App\Classes\Nestedsetbie;
use Auth;
use App\Models\Post;
use Illuminate\Support\Facades\App;
use App\Models\Language;
class PostController extends Controller
{

    protected $postService;
    protected $postRepository;
    protected $language;
    protected $nestedset;
 

    public function __construct(
        PostService $postService,
        PostRepository $postRepository
    ){
        
        $this->middleware(function($request, $next){
            $locale = app()->getLocale(); // vn en cn
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            $this->initialize();
            return $next($request);
        });

        $this->postService = $postService;
        $this->postRepository = $postRepository;
        $this->initialize();
    }

    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' =>  $this->language,
        ]);
    } 

    public function index(Request $request){
        $this->authorize('modules', 'post.index');
        $posts = $this->postService->paginate($request, $this->language);

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
            'model' => 'Post',
        ];
        $config['seo'] = __('messages.post');
        $dropdown  = $this->nestedset->Dropdown();
       
        return view('backend.post.post.index', compact(
            'config',
            'posts',
            'dropdown',
        ));
    }

    public function create(){
        $this->authorize('modules', 'post.create');
        $config = $this->configData();
        $config['seo'] = __('messages.post');
        $config['method'] = 'create';
        $dropdown  = $this->nestedset->Dropdown();
        return view('backend.post.post.store', compact(
            'config',
            'dropdown',
        ));
    }

    public function store(StorePostRequest $request){
        if($this->postService->create($request, $this->language)){
            return redirect()->route('post.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('post.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){
        $this->authorize('modules', 'post.edit');
        $post = $this->postRepository->getPostById($id, $this->language);  
        $config = $this->configData();
        $config['seo'] = __('messages.post');
        $config['method'] = 'edit';
        $dropdown  = $this->nestedset->Dropdown();
        $album = json_decode($post->album);
        return view('backend.post.post.store', compact(
            'config',
            'post',
            'dropdown',
            'album'
        ));
    }

    public function update($id, UpdatePostRequest $request){
        if($this->postService->update($id, $request, $this->language)){
            return redirect()->route('post.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('post.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){
        $this->authorize('modules', 'post.delete');
        $post = $this->postRepository->getpostById($id, $this->language);
        $config['seo'] = __('messages.post'); 
        return view('backend.post.post.delete', compact(
            'post',
            'config',
        ));
    }

    public function destroy($id){
        if($this->postService->destroy($id)){
            return redirect()->route('post.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('post.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
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
