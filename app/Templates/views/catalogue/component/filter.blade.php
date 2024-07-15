
<form action="{{ route('{view}.index') }}" method="GET">
    <div class="filter d-flex flex-wrap justify-content-between my-2">
        @include('backend.layout.component.perpage')
        <div class="d-flex flex-wrap justify-content-between ml-2">
            @include('backend.layout.component.filterPublish')
            @include('backend.layout.component.keyword')
            <div class="pr-1 start-end">
                <a href="{{ route('{view}.create') }}" class="btn btn-danger btn-sm d-flex align-items-center rounded-0" ><i class="fa fa-plus mr-1"></i>{{ __('messages.{module}.create.title') }}</a>
            </div>
        </div>
    </div>
</form>


