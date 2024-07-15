<div class="card rounded-0 shadow-lg">
    <div class="card-header">
        <h3 class="card-title text-uppercase  text-gray font-weight-600">
            Sản phẩm có nhiều phiên bản
        </h3>
        <div class="description d-inline-block text-sm">Cho phép bạn bán các phiên bản khác nhau của sản phẩm, ví dụ: :
            quần, áo thì có các <strong class="text-danger">màu sắc</strong> và <strong class="text-danger">size</strong>
            số khác nhau. Mỗi phiên bản sẽ là 1 dòng trong mục danh sách phiên bản phía dưới</div>
    </div>
    <div class="card-body">
        <div class="icheck-success d-inline variant-checkbox">
            <input type="checkbox" 
            id="variantCheckbox" 
            value="1" name="accept" 
            class="variantInputCheckbox"
                {{  
                    ( 
                        old('accept') == 1
                        ||
                        (
                            isset($product)
                            &&
                            count($product->product_variants) > 0
                        )
                    ) ? 'checked' : '' }}
            >
            <label for="variantCheckbox" class="turnOnVariant text-muted font-weight-normal no-select">
                Sản phẩm này có nhiều biến thể. Ví dụ như khác nhau về màu sắc, kích thước, hình dạng
            </label>
        </div>

        @php
            $variantCatalogue = old('attributeCatalogue', (isset($product->attributeCatalogue) ? json_decode($product->attributeCatalogue, TRUE) : []));
        @endphp

        <div class="variant-wrapper mt-3 {{ (count($variantCatalogue)) ? '' : 'hidden' }}">
            <div class="row variant-container">
                <div class="col-lg-3">
                    <div class="attribute-title text-primary">Chọn thuộc tính</div>
                </div>
                <div class="col-lg-9">
                    <div class="attribute-title text-primary">Chọn giá trị của thuộc tính (nhập 2 từ để tìm kiếm)</div>
                </div>
            </div>
            <div class="variant-body mt-3 ">
                @if ($variantCatalogue && count($variantCatalogue))
                    @foreach ($variantCatalogue as $keyAttr => $valAttr)
                        <div class="row variant-item mb-2">
                            <div class="col-lg-3">
                                <div class="attribute-catalogue">
                                    <select name="attributeCatalogue[]" id=""
                                        class="choose-attribute rounded-0 niceSelect">
                                        <option value="">Chọn nhóm thuộc tính</option>
                                        @foreach ($attributeCatalogue as $key => $val)
                                            <option {{ $valAttr == $val->id ? 'selected' : '' }}
                                                value="{{ $val->id }}">
                                                {{ $val->attribute_catalogue_language->first()->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <select multiple 
                                    class="selectVariant variant-{{$valAttr}} form-control select2"
                                    name="attribute[{{$valAttr}}][]" multiple
                                    data-catid="{{$valAttr}}">
                                </select>

                            </div>
                            <div class="col-lg-1">
                                <button type="button" class=" remove-attribute btn btn-danger rounded-0"><i
                                        class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="variant-foot mt-3">
                <button type="button" class=" add-variant btn btn-outline-info btn-flat"><i
                        class="fas fa-plus mr-3"></i> Thêm phiên bản mới</button>
            </div>
        </div>


    </div><!-- /.card-body -->
</div>

<div class="card rounded-0 shadow-lg product-variant">
    <div class="card-header">
        <h3 class="card-title text-uppercase  text-gray font-weight-600">
            Danh sách phiên bản
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered text-wrap variantTable">
                <thead class="bg-cyan">

                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div><!-- /.card-body -->
</div>

@php
    $productAttribute = old('attribute') ?? (isset($product->attribute) ? json_decode($product->attribute, TRUE) : []);
    $productVariant = old('variant') ?? (isset($product->variant) ? json_decode($product->variant, TRUE) : []);
@endphp


<script>
    var attributeCatalogue = @json(
        $attributeCatalogue->map(function ($item) {
                $name = $item->attribute_catalogue_language->first()->name;
                return [
                    'id' => $item->id,
                    'name' => $name,
                ];
            })->values());

   
            var attribute = '{{ base64_encode(json_encode($productAttribute)) }}';
            var variant = '{{ base64_encode(json_encode($productVariant)) }}';
   
</script>
