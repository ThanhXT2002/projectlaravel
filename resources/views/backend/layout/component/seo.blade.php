<!-- Custom tabs (Charts with tabs)-->
<div class="card rounded-0 shadow-lg">
    <div class="card-header">
        <h3 class="card-title text-uppercase  text-gray font-weight-600">
            {{ __('messages.seo') }}
        </h3>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="seo-container">
            <div class="meta-title text-indigo text-lg">
                {{ old('meta_title', $model->meta_title ?? '') ? old('meta_title', $model->meta_title ?? '') : __('messages.seoTitle') }}
            </div>
            <div class="canonical text-olive">
                {{ old('canonical', $model->canonical ?? '') ? config('app.url') . old('canonical', $model->canonical ?? '') . config('apps.general.suffix') : __('messages.seoCanonical')  }}
            </div>
            <div class="meta-description text-gray">
                {{ old('meta_description', $model->meta_description ?? '') ? old('meta_description', $model->meta_description ?? '') : __('messages.seoDescription')  }}
            </div>
            {{-- <div class="meta_keyword text-info"> {{(old('meta_keyword', ($model->meta_keyword) ?? '' )) ? old('meta_keyword', ($model->meta_keyword) ?? '' ): 'Chưa có từ khóa seo'}}</div> --}}
        </div>
        <hr>

        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label class=" text-sm">{{ __('messages.seoMetaTitle') }}</label>
                <label class="text-sm count_meta-title">0 {{ __('messages.character') }}</label>
            </div>

            <input type="text" name="meta_title"
                value="{{ old('meta_title', $model->meta_title ?? '') }}"
                class="form-control-sm form-control rounded-0 shadow border border-info"
                placeholder="" autocomplete="off" {{ (isset($disabled)) ? 'disabled' : '' }}>
        </div>
        <div class="mb-3">
            <label>{{ __('messages.canonical') }}<span class="text-danger"> (*) </span></label>
              <div class="input-group input-group-sm shadow">
                <div class="input-group-prepend">
                    <span class="input-group-text rounded-0 border-info border-right-0">{{ env('APP_URL') }}</span>
                </div>
                <input type="text"  class="form-control rounded-0 border-info border-left-0 border-right-0 seo-canonical"
                value="{{ old('canonical', $model->canonical ?? '') }}" name="canonical" {{ (isset($disabled)) ? 'disabled' : '' }}>
                <div class="input-group-append">
                  <div class="input-group-text rounded-0 border-info border-left-0">.html</i></div>
                </div>
              </div>
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label class=" text-sm">{{ __('messages.seoMetaDescription') }}</label>
                <label class="text-sm count_meta-description">0 {{ __('messages.character') }}</label>
            </div>
            <textarea type="text" name="meta_description" style="height: 100px"
                class="form-control-sm form-control rounded-0 shadow border border-info " {{ (isset($disabled)) ? 'disabled' : '' }}
                autocomplete="off"> {{ old('meta_description', $model->meta_description ?? '') }}</textarea>
        </div>

        <div class="mb-3">     
            <label class="text-sm">{{ __('messages.seoMetaKeyword') }}</label>                                     
        <input
            type="text"
            name="meta_keyword"
            value="{{ old('meta_keyword', ($model->meta_keyword) ?? '' ) }}"
            {{ (isset($disabled)) ? 'disabled' : '' }}
            class="form-control-sm form-control rounded-0 shadow border border-info"
            placeholder=""
            autocomplete="off"
            >                                       
    </div>


    </div><!-- /.card-body -->
</div>
<!-- /.card -->