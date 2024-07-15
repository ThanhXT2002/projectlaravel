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
            @if(isset(${module}s) && is_object(${module}s))
                @foreach (${module}s as ${module})
                    <tr id="{{${module}->id}}">
                        <td class="text-center">
                            <div class="icheck-success">
                                <input type="checkbox" value="{{ ${module}->id }}" class="input-checkbox checkBoxItem" id="checkOne{{ ${module}->id }}">
                                <label for="checkOne{{ ${module}->id }}"></label>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex d-flex-middle">
                                <div class="mr-3">
                                    <div class="border border-info image-post">
                                        <img class="img-cover " src="{{${module}->image}}" alt="">
                                    </div>
                                </div>
                               <div class="main-info">
                                    <div class="name"> <span class="maintitle text-lg">{{ ${module}->name }}</span></div>
                                    <div class="catalogue">
                                        <span class="text-danger text-sm">{{ __('messages.tableGroup') }} </span>
                                        @foreach(${module}->{module}_catalogues as $val)
                                        @foreach($val->{module}_catalogue_language as $cat)
                                        <a href="{{ route('{module}.index', ['{module}_catalogue_id' => $val->id]) }}" title="">{{ $cat->name }}--</a>
                                        @endforeach
                                        @endforeach
                                    </div>
                               </div>
                               </div>
                        </td>
                        @include('backend.layout.component.languageTd', ['model' => ${module}, 'modeling' => '{module}'])
                        <td>
                            <input type="text" name="order" value="{{ ${module}->order }}" class="form-control form-control-sm rounded-0 sort-order text-right" data-id="{{ ${module}->id }}" data-model="{{ $config['model'] }}">
                        </td>
                        <td class="text-center js-switch-{{ ${module}->id }}">
                            <input type="checkbox" class="js-switch status" value="{{ ${module}->publish }}" data-field="publish" data-model="{{ $config['model'] }}" {{ ${module}->publish == 2 ? 'checked' : '' }} data-modelId="{{ ${module}->id }}" data-bootstrap-switch />
                        </td>
                        <td class="text-center" width="120px">
                            <a href="{{ route('{module}.edit', ${module}->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('{module}.delete', ${module}->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="start-end float-right mt-3 mr-4">
        {{ ${module}s->links('pagination::bootstrap-4') }}
    </div>
</div>

