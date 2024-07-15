
<div class="card rounded-0 shadow-lg">
    <div class="card-header">
        <h3 class="card-title text-uppercase  text-gray font-weight-600">
            {{ __('messages.parent') }}
        </h3>
        
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <span class="text-danger notice d-block mb-2 font-italic text-sm">* {{ __('messages.parentNotice') }}</span>
            <select name="parent_id" class="form-control form-control-sm select2">  
                @foreach($dropdown as $key => $val)
                <option {{ 
                    $key == old('parent_id', (isset($productCatalogue->parent_id)) ? $productCatalogue->parent_id : '') ? 'selected' : '' 
                    }} value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </select>
            </div>
        </div>
        
            
        
    </div><!-- /.card-body -->
</div>

@include('backend.layout.component.publish', ['model' => ($productCatalogue) ?? null])