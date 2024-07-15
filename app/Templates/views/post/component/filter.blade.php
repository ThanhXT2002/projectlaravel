<form action="{{ route('{module}.index') }}" method="GET">
    <div class="filter d-flex flex-wrap justify-content-between my-2">
        @include('backend.layout.component.perpage')
        
        <div class="d-flex flex-wrap justify-content-between ml-2">
            @include('backend.layout.component.filterPublish')
            @php
                ${module}_catalogueId = request('{module}_catalogue_id') ?: old('{module}_catalogue_id');
            @endphp
            <div class="" style="width:250px">
                <select name="{module}_catalogue_id" class="form-control form-control-sm rounded-0 select2" >
                    @foreach ($dropdown as $key => $val)
                        <option {{ ${module}_catalogueId == $key ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
           
           
           
            @include('backend.layout.component.keyword')
            <div class="pr-1 start-end">
                <a href="{{ route('{module}.create') }}" class="btn btn-danger btn-sm d-flex align-items-center rounded-0" ><i class="fa fa-plus mr-1"></i>{{ config('apps.{module}.create.title') }}</a>
            </div>
        </div>
    </div>
</form>

