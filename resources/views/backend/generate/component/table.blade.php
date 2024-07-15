<div class="card-body p-0 table-responsive">
    <table class="table table-sm  table-striped table table-bordered table-head-fixed text-wrap">
        <thead>
            <tr>
                <th>{{ __('messages.tableName') }}</th>
               
                <th class="text-center">{{ __('messages.tableAction') }}</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($generates) && is_object($generates))
             @foreach($generates as $generate)
                    <tr>
                        <td>
                            {{ $generate->name }}
                        </td>
                        <td class="text-center " width="120px">
                            <a href="{{ route('generate.edit', $generate->id) }}"
                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('generate.delete', $generate->id) }}"
                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <div class="start-end float-right mt-3 mr-4">
        {{ $generates->links('pagination::bootstrap-4') }}
    </div>
