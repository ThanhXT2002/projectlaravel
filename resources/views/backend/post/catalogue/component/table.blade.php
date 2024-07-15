
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

            @if (isset($postCatalogues) && is_object($postCatalogues))
                @foreach ($postCatalogues as $postCatalogue)
                    <tr>
                        <td class="text-center">

                            <div class="icheck-success">
                                <input type="checkbox" value="{{ $postCatalogue->id }}"
                                    class = "input-checkbox checkBoxItem" id="checkOne{{ $postCatalogue->id }}">
                                <label for="checkOne{{ $postCatalogue->id }}"></label>
                            </div>
                        </td>
                        <td>
                            {{ str_repeat('|----', $postCatalogue->level > 0 ? $postCatalogue->level - 1 : 0) . $postCatalogue->name }}
                        </td>
                        @include('backend.layout.component.languageTd', ['model' => $postCatalogue, 'modeling' => 'PostCatalogue'])

                        <td class="text-center js-switch-{{ $postCatalogue->id }}">
                            <input type="checkbox" class="js-switch status" value="{{ $postCatalogue->publish }}"
                                data-field="publish" data-model="{{ $config['model'] }}"
                                {{ $postCatalogue->publish == 2 ? 'checked' : '' }}
                                data-modelId="{{ $postCatalogue->id }}" data-bootstrap-switch />
                        </td>

                        <td class="text-center " width="120px">
                            <a href="{{ route('post.catalogue.edit', $postCatalogue->id) }}"
                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('post.catalogue.delete', $postCatalogue->id) }}"
                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <div class="start-end float-right mt-3 mr-4">
        {{ $postCatalogues->links('pagination::bootstrap-4') }}
    </div>
</div>
