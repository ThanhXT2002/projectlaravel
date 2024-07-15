<div class="card-body p-0 table-responsive">
    <table class="table  table-striped table table-bordered table-head-fixed text-wrap">
        <thead>
            <tr>
                <th class="text-center" width="50px">
                    {{-- <input type="checkbox" value="" id="checkAll" class = "input-checkbox"> --}}
                    <div class="icheck-success d-inline">
                        <input type="checkbox" value="" id="checkAll" class="input-checkbox">
                        <label for="checkAll"></label>
                    </div>
                </th>

                <th>{{ __('messages.tableName') }}</th>
                @include('backend.layout.component.languageTh')
                <th class="text-center">{{ __('messages.tableStatus') }}</th>
                <th class="text-center">{{ __('messages.tableAction') }}</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($productCatalogues) && is_object($productCatalogues))
                @foreach($productCatalogues as $productCatalogue)
                    <tr>
                        <td class="text-center">

                            <div class="icheck-success">
                                <input type="checkbox" value="{{ $productCatalogue->id }}"
                                    class = "input-checkbox checkBoxItem" id="checkOne{{ $productCatalogue->id }}">
                                <label for="checkOne{{ $productCatalogue->id }}"></label>
                            </div>
                        </td>
                        <td>
                            {{ str_repeat('|----', (($productCatalogue->level > 0)?($productCatalogue->level - 1):0)).$productCatalogue->name }}
                        </td>
                        @include('backend.layout.component.languageTd', ['model' => $productCatalogue, 'modeling' => 'ProductCatalogue'])
                        <td class="text-center js-switch-{{ $productCatalogue->id }}">
                            <input type="checkbox" class="js-switch status" value="{{ $productCatalogue->publish }}"
                                data-field="publish" data-model="{{ $config['model'] }}"
                                {{ $productCatalogue->publish == 2 ? 'checked' : '' }}
                                data-modelId="{{ $productCatalogue->id }}" data-bootstrap-switch />
                        </td>

                        <td class="text-center " width="120px">
                            <a href="{{ route('product.catalogue.edit', $productCatalogue->id) }}"
                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('product.catalogue.delete', $productCatalogue->id) }}"
                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <div class="start-end float-right mt-3 mr-4">
        {{  $productCatalogues->links('pagination::bootstrap-4') }}
    </div>
</div>
