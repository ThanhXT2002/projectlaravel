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
            @if(isset(${module}s) && is_object(${module}s))
                @foreach(${module}s as ${module})
                    <tr>
                        <td class="text-center">

                            <div class="icheck-success">
                                <input type="checkbox" value="{{ ${module}->id }}"
                                    class = "input-checkbox checkBoxItem" id="checkOne{{ ${module}->id }}">
                                <label for="checkOne{{ ${module}->id }}"></label>
                            </div>
                        </td>
                        <td>
                            {{ str_repeat('|----', ((${module}->level > 0)?(${module}->level - 1):0)).${module}->name }}
                        </td>
                        @include('backend.layout.component.languageTd', ['model' => ${module}, 'modeling' => '{Module}'])
                        <td class="text-center js-switch-{{ ${module}->id }}">
                            <input type="checkbox" class="js-switch status" value="{{ ${module}->publish }}"
                                data-field="publish" data-model="{{ $config['model'] }}"
                                {{ ${module}->publish == 2 ? 'checked' : '' }}
                                data-modelId="{{ ${module}->id }}" data-bootstrap-switch />
                        </td>

                        <td class="text-center " width="120px">
                            <a href="{{ route('{view}.edit', ${module}->id) }}"
                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('{view}.delete', ${module}->id) }}"
                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <div class="start-end float-right mt-3 mr-4">
        {{  ${module}s->links('pagination::bootstrap-4') }}
    </div>
</div>
