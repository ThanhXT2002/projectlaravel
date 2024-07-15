<div class="input-group input-group-sm mr-2" style="width:400px">
    <input type="text" name="keyword" value="{{ request('keyword') ?: old('keyword') }}" placeholder="{{ __('messages.searchInput') }}" class="form-control form-control-sm rounded-0 border border-info shadow">
    <div class="input-group-append">
        <button type="submit" name="search" class="btn btn-info btn-sm rounded-0">{{ __('messages.search') }}</button>
    </div>
</div>