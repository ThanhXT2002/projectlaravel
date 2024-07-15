<div class="card rounded-0 shadow-lg">
    <div class="card-header">
        <h3 class="card-title text-uppercase  text-gray font-weight-600">
            {{ __('messages.image') }}
        </h3>

    </div>
    <div class="card-body">

        <span class="image img-cover image-target"><img width="100%"
                src="{{ (old('image', ($model->image) ?? '' ) ? old('image', ($model->image) ?? '')   :  'backend/img/no-img.png') }}"
                alt=""></span>
        <input type="hidden" name="image" value="{{ old('image', $model->image ?? '') }}">

    </div><!-- /.card-body -->
</div>
<div class="card rounded-0 shadow-lg">
    <div class="card-header">
        <h3 class="card-title text-uppercase  text-gray font-weight-600">
            {{ __('messages.advange') }}
        </h3>

    </div>
    <div class="card-body">

        <div class="mb-3">
            <select name="publish" class="form-control form-control-sm select2 ">
                @foreach(__('messages.status') as $key => $val)
                    <option {{ $key == old('publish', isset($model->publish) ? $model->publish : '') ? 'selected' : '' }}
                        value="{{ $key }}">{{ $val }}
                    </option>
                @endforeach
            </select>
        </div>
        <select name="follow" class="form-control form-control-sm  select2">
            @foreach(__('messages.follow') as $key => $val)
                <option {{ $key == old('follow', isset($model->follow) ? $model->follow : '') ? 'selected' : '' }}
                    value="{{ $key }}">{{ $val }}
                </option>
            @endforeach
        </select>

    </div><!-- /.card-body -->
</div>
