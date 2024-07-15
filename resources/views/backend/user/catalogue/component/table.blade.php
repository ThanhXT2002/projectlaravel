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
                <th>{{ __('messages.tableQuantity') }}</th>
                <th class="text-center">{{ __('messages.tableStatus') }}</th>
                <th class="text-center">{{ __('messages.tableStatus') }}</th>
                <th class="text-center">{{ __('messages.tableAction') }}</th>
                    </tr>
        </thead>
        <tbody>
            
            @if (isset($userCatalogues) && is_object($userCatalogues))
                @foreach ($userCatalogues as $userCatalogue)
                    <tr>
                        <td class="text-center">
                           
                            <div class="icheck-success">
                                <input type="checkbox" value="{{ $userCatalogue->id }}" class = "input-checkbox checkBoxItem" id="checkOne{{ $userCatalogue->id }}">
                                <label for="checkOne{{ $userCatalogue->id }}"></label>
                              </div>
                        </td>
                        <td>
                            {{ $userCatalogue->name }}
                        </td>
                        <td class="text-center">
                            {{ $userCatalogue->users_count }} {{ __('messages.member') }}
                        </td>
                        <td>
                            {{ $userCatalogue->description }}
                        </td>
                       
                       
                        <td class="text-center js-switch-{{ $userCatalogue->id }}">
                            <input type="checkbox" class="js-switch status" value="{{ $userCatalogue->publish }}" data-field="publish" data-model="{{ $config['model'] }}" {{ ($userCatalogue->publish == 2) ? 'checked' : '' }} data-modelId="{{ $userCatalogue->id }}" data-bootstrap-switch />
                        </td>
                        
                        <td class="text-center " width="120px">
                            <a href="{{ route('user.catalogue.edit', $userCatalogue->id) }}" class="btn btn-info btn-sm"><i
                                    class="fa fa-edit"></i></a>
                            <a href="{{ route('user.catalogue.delete', $userCatalogue->id) }}" class="btn btn-danger btn-sm"><i
                                    class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                @endforeach
            @endif
           
        </tbody>
    </table>

    <div class="start-end float-right mt-3 mr-4">  
        {{$userCatalogues->links('pagination::bootstrap-4')}}
    </div>
</div>


