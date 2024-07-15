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
            <select name="product_catalogue_id" class="form-control form-control-sm  select2">
                @foreach ($dropdown as $key => $val)
                    <option
                        {{ $key == old('product_catalogue_id', isset($product->product_catalogue_id) ? $product->product_catalogue_id : '') ? 'selected' : '' }}
                        value="{{ $key }}">{{ $val }}
                    </option>
                @endforeach
            </select>
        </div>
        @php
            $catalogue = [];
            if (isset($product)) {
                foreach ($product->product_catalogues as $key => $val) {
                    $catalogue[] = $val->id;
                }
            }
        @endphp
        <div class="mb-3">
            <label for="">{{ __('messages.labelson') }}</label>
            <select multiple name="catalogue[]" class="form-control form-control-sm select2">
                @foreach ($dropdown as $key => $val)
                    @if ($key != old('product_catalogue_id', isset($product->product_catalogue_id) ? $product->product_catalogue_id : ''))
                        <option value="{{ $key }}"
                            {{ in_array($key, old('catalogue', $catalogue)) ? 'selected' : '' }}>{{ $val }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>


    </div><!-- /.card-body -->
</div>


<div class="card rounded-0 shadow-lg">
    <div class="card-header">
        <h3 class="card-title text-uppercase  text-gray font-weight-600">
            {{ __('messages.product.information') }}
        </h3>

    </div><!-- /.card-header -->
    <div class="card-body">

        <div class="mb-3">
            <label for=""> {{ __('messages.product.code') }}</label>
            <input type="text" name="code" value="{{ old('code', $product->code ?? time()) }}"
                class="form-control form-control-sm rounded-0 border-info shadow">
        </div>

        <div class="mb-3">
            <label for="">{{ __('messages.product.made_in') }}</label>
            <input type="text" name="made_in" value="{{ old('made_in', $product->made_in ?? null) }}"
                class="form-control form-control-sm rounded-0 border-info shadow">
        </div>

        <div class="mb-3">
            <label for="">{{ __('messages.product.price') }}</label>
            <input type="text" name="price"
                value="{{ old('price', isset($product) ? number_format($product->price, 0, ',', '.') : '') }}"
                class="form-control int form-control-sm rounded-0 border-info shadow">
        </div>

    </div><!-- /.card-body -->
</div>



@include('backend.layout.component.publish', ['model' => $product ?? null])
