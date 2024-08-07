<form action="{{ route('attribute.index') }}" method="GET">
    <div class="filter d-flex flex-wrap justify-content-between my-2">
        @include('backend.layout.component.perpage')
        
        <div class="d-flex flex-wrap justify-content-between ml-2">
            @include('backend.layout.component.filterPublish')
            @php
                $attribute_catalogueId = request('attribute_catalogue_id') ?: old('attribute_catalogue_id');
            @endphp
            <div class="" style="width:250px">
                <select name="attribute_catalogue_id" class="form-control form-control-sm rounded-0 select2" >
                    @foreach ($dropdown as $key => $val)
                        <option {{ $attribute_catalogueId == $key ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
           
           
           
            @include('backend.layout.component.keyword')
            <div class="pr-1 start-end">
                <a href="{{ route('attribute.create') }}" class="btn btn-danger btn-sm d-flex align-items-center rounded-0" ><i class="fa fa-plus mr-1"></i>{{ config('apps.attribute.create.title') }}</a>
            </div>
        </div>
    </div>
</form>

