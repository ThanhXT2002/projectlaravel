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

            @if(isset($attributeCatalogues) && is_object($attributeCatalogues))
           
                @foreach($attributeCatalogues as $attributeCatalogue)
                    <tr>
                        <td class="text-center">

                            <div class="icheck-success">
                                <input type="checkbox" value="{{ $attributeCatalogue->id }}"
                                    class = "input-checkbox checkBoxItem" id="checkOne{{ $attributeCatalogue->id }}">
                                <label for="checkOne{{ $attributeCatalogue->id }}"></label>
                            </div>
                        </td>
                        <td>
                            {{ str_repeat('|----', (($attributeCatalogue->level > 0)?($attributeCatalogue->level - 1):0)).$attributeCatalogue->name }}
                        </td>
                        @include('backend.layout.component.languageTd', ['model' => $attributeCatalogue, 'modeling' => 'AttributeCatalogue'])
                        <td class="text-center js-switch-{{ $attributeCatalogue->id }}">
                            <input type="checkbox" class="js-switch status" value="{{ $attributeCatalogue->publish }}"
                                data-field="publish" data-model="{{ $config['model'] }}"
                                {{ $attributeCatalogue->publish == 2 ? 'checked' : '' }}
                                data-modelId="{{ $attributeCatalogue->id }}" data-bootstrap-switch />
                        </td>

                        <td class="text-center " width="120px">
                            <a href="{{ route('attribute.catalogue.edit', $attributeCatalogue->id) }}"
                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('attribute.catalogue.delete', $attributeCatalogue->id) }}"
                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <div class="start-end float-right mt-3 mr-4">
        {{  $attributeCatalogues->links('pagination::bootstrap-4') }}
    </div>
</div>
