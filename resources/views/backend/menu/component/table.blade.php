<div class="card-body p-0 table-responsive">
    <table class="table  table-striped table table-bordered table-head-fixed text-wrap">
        <thead>
            <tr>
                <th class="text-center" width="50px">
                    {{-- <input type="checkbox" value="" id="checkAll" class = "input-checkbox"> --}}
                    <div class="icheck-success d-inline">
                        <input type="checkbox" value=""  id="checkAll" class="input-checkbox">
                        <label for="checkAll"></label>
                      </div>
                </th>

                <th>{{ __('messages.tableName') }}</th>
                <th>Từ khóa</th>
                <th class="text-center">{{ __('messages.tableStatus') }}</th>
                <th class="text-center">{{ __('messages.tableAction') }}</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($menuCatalogues) && is_object($menuCatalogues))
                @foreach ($menuCatalogues as $menuCatalogue)
                    <tr>
                        <td class="text-center">
                           
                            <div class="icheck-success">
                                <input type="checkbox" value="{{ $menuCatalogue->id }}" class = "input-checkbox checkBoxItem" id="checkOne{{ $menuCatalogue->id }}">
                                <label for="checkOne{{ $menuCatalogue->id }}"></label>
                            </div>
                        </td>
                        <td>
                            {{ $menuCatalogue->name }}
                        </td>
                        <td>
                            {{ $menuCatalogue->keyword }}
                        </td>
                        <td class="text-center js-switch-{{ $menuCatalogue->id }}">
                            <input type="checkbox" class="js-switch status" value="{{ $menuCatalogue->publish }}" data-field="publish" data-model="{{ $config['model'] }}" {{ ($menuCatalogue->publish == 2) ? 'checked' : '' }} data-modelId="{{ $menuCatalogue->id }}" data-bootstrap-switch />
                        </td>
                        
                        <td class="text-center " width="120px">
                            <a href="{{ route('menu.edit', $menuCatalogue->id) }}" class="btn btn-info btn-sm"><i
                                    class="fa fa-edit"></i></a>
                            <a href="{{ route('menu.delete', $menuCatalogue->id) }}" class="btn btn-danger btn-sm"><i
                                    class="fa fa-trash"></i></a>

                        </td>

                    </tr>
                @endforeach
            @endif
           
        </tbody>
    </table>
</div>


