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
            <input type="text" name="name"
                 value="{{ old('name', ($model->name) ?? '' ) }}"
                 {{ (isset($disabled)) ? 'disabled' : '' }}
                class="form-control form-control-sm rounded-0 shadow border border-info ">
        </div>
        <div class="mb-3">
            <label for="" class="control-label text-left">{{ __('messages.description') }}</label>
            <textarea type="text" name="description" 
            id="ckdescription" {{ (isset($disabled)) ? 'disabled' : '' }} 
            data-height="150" class="form-control ck-editor"> {{ old('description', ($model->description) ?? '') }}</textarea>
        </div>

        <div class="mb-3">


            <div class="d-flex justify-content-between">
                <label for="" class="control-label text-left">{{ __('messages.content') }}</label>
                <a href=""
                    class="multipleUploadImageCkeditor text-white btn btn-sm btn-success rounded-0 shadow-lg"
                    data-target="ckcontent"><strong>Upload nhiều hình ảnh</strong></a>
            </div>
            <textarea type="text" name="content" class="form-control ck-editor" 
            autocomplete="off" id="ckcontent" {{ (isset($disabled)) ? 'disabled' : '' }}
                data-height="600"> {{ old('content', ($model->content) ?? '' ) }}</textarea>
        </div>
    </div><!-- /.card-body -->
</div>
<!-- /.card -->