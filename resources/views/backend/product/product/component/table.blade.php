<div class="card-body p-0 table-responsive">
    <table class="table table-striped table-bordered table-head-fixed text-wrap">
        <thead>
            <tr>
                <th class="text-center" width="50px">
                    <div class="icheck-success d-inline">
                        <input type="checkbox" value="" id="checkAll" class="input-checkbox">
                        <label for="checkAll"></label>
                    </div>
                </th>
                <th>{{ __('messages.tableName') }}</th>
                @include('backend.layout.component.languageTh')
                <th class="text-center" width="100px">{{ __('messages.tableOrder') }}</th>
                <th class="text-center">{{ __('messages.tableStatus') }}</th>
                <th class="text-center">{{ __('messages.tableAction') }}</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($products) && is_object($products))
                @foreach ($products as $product)
                    <tr id="{{$product->id}}">
                        <td class="text-center">
                            <div class="icheck-success">
                                <input type="checkbox" value="{{ $product->id }}" class="input-checkbox checkBoxItem" id="checkOne{{ $product->id }}">
                                <label for="checkOne{{ $product->id }}"></label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex d-flex-middle">
                                <div class="mr-3">
                                    <div class="border border-info image-post">
                                        <img class="img-cover " src="{{$product->image}}" alt="">
                                    </div>
                                </div>
                               <div class="main-info">
                                    <div class="name"> <span class="maintitle text-lg">{{ $product->name }}</span></div>
                                    <div class="catalogue">
                                        <span class="text-danger text-sm">{{ __('messages.tableGroup') }} </span>
                                        @foreach($product->product_catalogues as $val)
                                        @foreach($val->product_catalogue_language as $cat)
                                        <a href="{{ route('product.index', ['product_catalogue_id' => $val->id]) }}" title="">{{ $cat->name }}--</a>
                                        @endforeach
                                        @endforeach
                                    </div>
                               </div>
                               </div>
                        </td>
                        @include('backend.layout.component.languageTd', ['model' => $product, 'modeling' => 'product'])
                        <td>
                            <input type="text" name="order" value="{{ $product->order }}" class="form-control form-control-sm rounded-0 sort-order text-right" data-id="{{ $product->id }}" data-model="{{ $config['model'] }}">
                        </td>
                        <td class="text-center js-switch-{{ $product->id }}">
                            <input type="checkbox" class="js-switch status" value="{{ $product->publish }}" data-field="publish" data-model="{{ $config['model'] }}" {{ $product->publish == 2 ? 'checked' : '' }} data-modelId="{{ $product->id }}" data-bootstrap-switch />
                        </td>
                        <td class="text-center" width="120px">
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="start-end float-right mt-3 mr-4">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>

