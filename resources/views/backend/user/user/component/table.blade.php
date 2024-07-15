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
                <th>Email</th>
                <th>{{ __('messages.tablePhone') }}</th>
                <th>{{ __('messages.tableAddress') }}</th>
                <th>{{ __('messages.tableUserGroup') }}</th>
                <th class="text-center">{{ __('messages.tableStatus') }}</th>
                <th class="text-center">{{ __('messages.tableAction') }}</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($users) && is_object($users))
                @foreach ($users as $user)
                    <tr>
                        <td class="text-center">
                           
                            <div class="icheck-success">
                                <input type="checkbox" value="{{ $user->id }}" class = "input-checkbox checkBoxItem" id="checkOne{{ $user->id }}">
                                <label for="checkOne{{ $user->id }}"></label>
                            </div>
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->phone }}
                        </td>
                        <td>
                            {{ $user->address }}
                        </td>
                       
                        <td>
                            {{ $user->user_catalogues->name }}
                        </td>
                        <td class="text-center js-switch-{{ $user->id }}">
                            <input type="checkbox" class="js-switch status" value="{{ $user->publish }}" data-field="publish" data-model="{{ $config['model'] }}" {{ ($user->publish == 2) ? 'checked' : '' }} data-modelId="{{ $user->id }}" data-bootstrap-switch />
                        </td>
                        
                        <td class="text-center " width="120px">
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm"><i
                                    class="fa fa-edit"></i></a>
                            <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger btn-sm"><i
                                    class="fa fa-trash"></i></a>

                        </td>

                    </tr>
                @endforeach
            @endif
           
        </tbody>
    </table>

    <div class="start-end float-right mt-3 mr-4">  
        {{$users->links('pagination::bootstrap-4')}}
    </div>
</div>


