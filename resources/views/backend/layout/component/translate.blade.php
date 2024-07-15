 <!-- Custom tabs (Charts with tabs)-->
 <div class="card rounded-0 shadow-lg">
    <div class="card-header ui-sortable-handle">
        <h3 class="card-title text-uppercase  text-gray font-weight-600">
            {{ __('messages.tableHeading') }}
        </h3>
        
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="mb-3">
            <label for="" class="control-label text-left">{{ __('messages.title') }} <span
                    class="text-danger">(*)</span></label>
            <input type="text" name="translate_name"
                value="{{ old('translate_name', ($model->name) ?? '' ) }}"
                 {{ (isset($disabled)) ? 'disabled' : '' }}
                class="form-control form-control-sm rounded-0 shadow border border-info ">
        </div>
        <div class="mb-3">
            <label for="" class="control-label text-left">{{ __('messages.description') }}</label>
            <textarea type="text" name="translate_description" id="ckDescription_1" {{ (isset($disabled)) ? 'disabled' : '' }} data-height="150" class="form-control ck-editor"> {{ old('description', ($model->description) ?? '') }}</textarea>
        </div>

        <div class="mb-3">


            <div class="d-flex justify-content-between">
                <label for="" class="control-label text-left">{{ __('messages.content') }}</label>
                <a href=""
                    class="multipleUploadImageCkeditor text-white btn btn-sm btn-success rounded-0 shadow-lg"
                    data-target="ckContent_1"><strong>Upload nhiều hình ảnh</strong></a>
            </div>
            <textarea type="text" name="translate_content" class="form-control ck-editor" placeholder="" autocomplete="off" id="ckContent_1" {{ (isset($disabled)) ? 'disabled' : '' }}
                data-height="600"> {{ old('content', ($model->content) ?? '' ) }}</textarea>
        </div>
    </div><!-- /.card-body -->
</div>
<!-- /.card -->
{{-- ndnvlf --}}
{{-- <div class="row mb15">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left">{{ __('messages.title') }}<span class="text-danger">(*)</span></label>
            <input 
                type="text"
                name="translate_name"
                value="{{ old('translate_name', ($model->name) ?? '' ) }}"
                class="form-control"
                placeholder=""
                autocomplete="off"
            >
        </div>
    </div>
</div>
<div class="row mb30">
    <div class="col-lg-12">
        <div class="form-row">
            <label for="" class="control-label text-left">{{ __('messages.description') }} </label>
            <textarea name="translate_description" class="ck-editor" id="ckDescription_1" data-height="100">{{ old('description', ($model->description) ?? '') }}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-row">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <label for="" class="control-label text-left">{{ __('messages.content') }} </label>
                <a href="" class="multipleUploadImageCkeditor" data-target="ckContent_1">{{ __('messages.upload') }}</a>
            </div>
            <textarea
                name="translate_content"
                class="form-control ck-editor"
                placeholder=""
                autocomplete="off"
                id="ckContent_1"
                data-height="500"
            >{{ old('content', ($model->content) ?? '' ) }}</textarea>
        </div>
    </div>
</div> --}}