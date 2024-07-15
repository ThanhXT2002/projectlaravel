<div class="perpage ml-2">
    @php
        $perpage = request('perpage') ?: old('perpage');
    @endphp
    <select name="perpage" class="form-control form-control-sm rounded-0 select2" style="width:130px">
        @for ($i = 20; $i <= 100; $i += 20)
            <option {{ $perpage == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }} {{ __('messages.perpage') }}</option>
        @endfor
    </select>
</div>