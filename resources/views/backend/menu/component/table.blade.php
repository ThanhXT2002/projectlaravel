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
                <th>Cập nhật gần đây</th>
                <th>Người tạo</th>
                <th class="text-center">{{ __('messages.tableStatus') }}</th>
                <th class="text-center">{{ __('messages.tableAction') }}</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($menus) && is_object($menus))
                @foreach ($menus as $menu)
                    <tr>
                        <td class="text-center">
                           
                            <div class="icheck-success">
                                <input type="checkbox" value="{{ $menu->id }}" class = "input-checkbox checkBoxItem" id="checkOne{{ $menu->id }}">
                                <label for="checkOne{{ $menu->id }}"></label>
                            </div>
                        </td>
                        <td>
                            {{ $menu->name }}
                        </td>
                        <td>
                            {{ $menu->email }}
                        </td>
                        <td>
                            {{ $menu->updated_at }}
                        </td>
                        <td>
                            {{ $menu->user_id }}
                        </td>
                        <td class="text-center js-switch-{{ $menu->id }}">
                            <input type="checkbox" class="js-switch status" value="{{ $menu->publish }}" data-field="publish" data-model="{{ $config['model'] }}" {{ ($menu->publish == 2) ? 'checked' : '' }} data-modelId="{{ $menu->id }}" data-bootstrap-switch />
                        </td>
                        
                        <td class="text-center " width="120px">
                            <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-info btn-sm"><i
                                    class="fa fa-edit"></i></a>
                            <a href="{{ route('menu.delete', $menu->id) }}" class="btn btn-danger btn-sm"><i
                                    class="fa fa-trash"></i></a>

                        </td>

                    </tr>
                @endforeach
            @endif
           
        </tbody>
    </table>
</div>


