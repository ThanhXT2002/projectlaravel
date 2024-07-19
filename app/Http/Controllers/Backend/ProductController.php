<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\ProductServiceInterface  as ProductService;
use App\Repositories\Interfaces\ProductRepositoryInterface  as ProductRepository;
use App\Repositories\Interfaces\AttributeCatalogueRepositoryInterface  as AttributeCatalogueRepository;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Classes\Nestedsetbie;
use App\Models\Language;

class ProductController extends Controller
{
    protected $productService;
    protected $productRepository;
    protected $languageRepository;
    protected $language;
    protected $attributeCatalogue;


    public function __construct(
        ProductService $productService,
        ProductRepository $productRepository,
        AttributeCatalogueRepository $attributeCatalogue,
    ){
        $this->middleware(function($request, $next){
            $locale = app()->getLocale(); // vn en cn
            $language = Language::where('canonical', $locale)->first();
            $this->language = $language->id;
            $this->initialize();
            return $next($request);
        });

        $this->productService = $productService;
        $this->productRepository = $productRepository;
        $this->attributeCatalogue = $attributeCatalogue;
        $this->initialize();
        
    }

    private function initialize(){
        $this->nestedset = new Nestedsetbie([
            'table' => 'product_catalogues',
            'foreignkey' => 'product_catalogue_id',
            'language_id' =>  $this->language,
        ]);
    } 

    public function index(Request $request){
        $this->authorize('modules', 'product.index');
        $products = $this->productService->paginate($request, $this->language);
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
            'model' => 'Product'
        ];
        $config['seo'] = __('messages.product');
        $dropdown  = $this->nestedset->Dropdown();
        return view('backend.product.product.index', compact(
            'config',
            'dropdown',
            'products'
        ));
    }

    public function create(){
        $this->authorize('modules', 'product.create');
        $attributeCatalogue = $this->attributeCatalogue->getAll($this->language);
        $config = $this->configData();
        $config['seo'] = __('messages.product');
        $config['method'] = 'create';
        $dropdown  = $this->nestedset->Dropdown();
        return view('backend.product.product.store', compact(
            'dropdown',
            'config',
            'attributeCatalogue',
        ));
    }

    public function store(StoreProductRequest $request){
        if($this->productService->create($request, $this->language)){
            return redirect()->route('product.index')->with('success','Thêm mới bản ghi thành công');
        }
        return redirect()->route('product.index')->with('error','Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    public function edit($id){
        $this->authorize('modules', 'product.edit');
        
        $product = $this->productRepository->getProductById($id, $this->language);
       
        $attributeCatalogue = $this->attributeCatalogue->getAll($this->language);
        $config = $this->configData();
        $config['seo'] = __('messages.product');
        $config['method'] = 'edit';
        $dropdown  = $this->nestedset->Dropdown();
        $album = json_decode($product->album);
        return view('backend.product.product.store', compact(
            'config',
            'dropdown',
            'product',
            'album',
            'attributeCatalogue',
        ));
    }

    public function update($id, UpdateProductRequest $request){
        if($this->productService->update($id, $request,  $this->language)){
            return redirect()->route('product.index')->with('success','Cập nhật bản ghi thành công');
        }
        return redirect()->route('product.index')->with('error','Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    public function delete($id){
        $this->authorize('modules', 'product.delete');
        $config['seo'] = __('messages.product');
        $product = $this->productRepository->getProductById($id, $this->language);
        return view('backend.product.product.delete', compact(
            'product',
            'config',
        ));
    }

    public function destroy($id){
        if($this->productService->destroy($id, $this->language)){
            return redirect()->route('product.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('product.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    private function configData(){
        return [
            'js' => [
                'backend/plugins/ckeditor/ckeditor.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
                'backend/library/seo.js',
                'backend/library/variant.js',
                'backend/plugins/select2/js/select2.full.min.js',
                'backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js',
                'backend/plugins/nice-select/js/jquery.nice-select.min.js',
                'backend/plugins/switchery/switchery.js',
                
            ],
            'css' => [
                'backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css', 
                'backend/plugins/select2/css/select2.min.css',
                'backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                'backend/plugins/nice-select/css/nice-select.css',
                'backend/plugins/switchery/switchery.css',
               
            ]
          
        ];
    }

   

}