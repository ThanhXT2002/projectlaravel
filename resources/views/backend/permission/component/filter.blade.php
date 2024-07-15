<form action="{{ route('permission.index') }}">
    <div class="filter d-flex flex-wrap justify-content-between my-2">
        @include('backend.layout.component.perpage')
        <div class="d-flex flex-wrap justify-content-between ml-2">
            @include('backend.layout.component.keyword')
            <div class="mr-2 start-end">
                <a href="{{ route('user.catalogue.permission') }}" class="btn btn-success btn-sm d-flex align-items-center rounded-0 " style="width:140px"><i class="fa fa-key mr-4"></i>{{ __('messages.btnPermission') }}</a>
            </div>
            <div class="mr-1 start-end">
                <a href="{{ route('permission.create') }}" class="btn btn-danger btn-sm d-flex align-items-center rounded-0" ><i class="fa fa-plus mr-1"></i>{{ __('messages.btnFilter') }}</a>
            </div>
        </div>
    </div>
</form>

