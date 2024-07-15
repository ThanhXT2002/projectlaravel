<div class="card rounded-0 shadow-lg">
    <div class="card-header">
        <h3 class="card-title text-uppercase  text-gray font-weight-600">
            {{ __('messages.parent') }}
        </h3>

    </div><!-- /.card-header -->
    <div class="card-body">

        <div class="mb-3">
            <label for=""> {{ __('messages.labelparent') }}</label>
            <span class="text-danger notice d-block mb-2 font-italic text-sm">* {{ __('messages.parentNotice') }}</span>
                <select name="attribute_catalogue_id" class="form-control form-control-sm  select2">  
                    @foreach($dropdown as $key => $val)
                    <option 
                        {{$key == old('attribute_catalogue_id', (isset($attribute->attribute_catalogue_id))? $attribute->attribute_catalogue_id : '') ? 'selected' : ''}} value="{{$key}}" >{{$val}}
                    </option>
                    @endforeach
                </select>
        </div>
        @php
            $catalogue = [];
            if(isset($attribute)){
                foreach($attribute->attribute_catalogues as $key => $val){
                    $catalogue[] = $val->id;
                }
            }
        @endphp
        <div class="mb-3">
            <label for="">{{ __('messages.labelson') }}</label>
            <select multiple name="catalogue[]" class="form-control form-control-sm select2">
                @foreach ($dropdown as $key => $val)
                    @if($key != old('attribute_catalogue_id', (isset($attribute->attribute_catalogue_id) ? $attribute->attribute_catalogue_id : '')))
                        <option value="{{$key}}" {{ in_array($key, old('catalogue', $catalogue)) ? 'selected' : '' }}>{{$val}}</option>
                    @endif
                @endforeach
            </select>
        </div>


    </div><!-- /.card-body -->
</div>

@include('backend.layout.component.publish', ['model' => ($attribute) ?? null])