@csrf
@method('DELETE')
<div class="wrapper wrapper-content animated fadeInRight">
    @include('backend.layout.component.btnsubmit')
    <div class="row">
        <div class="col-lg-4 pl-4"> 
            <h5 class=""><strong>{{ __('messages.generalTitle') }}</strong></h5>
            <p class="font-italic"><strong class="text-danger">(*)</strong>: {{ __('messages.generalDescription') }}</p>               
        </div>
        <div class="col-lg-8">
            <div class="card-body bg-white shadow-lg">                       
                      
                <label for="" class="control-label text-left">{{ __('messages.tableName') }} <span class="text-danger">(*)</span></label>
                <input 
                    type="text"
                    name="name"
                    value="{{ old('name', ($model->name) ?? '' ) }}"
                    class="form-control form-control-sm rounded-0 border-info "
                    placeholder=""
                    autocomplete="off"
                    readonly
                >
            </div>
        </div>
    </div>
   
</div>

