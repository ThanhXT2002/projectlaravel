@php
$publish = request('publish') ?: old('publish');
@endphp
<div class="" style="width:170px">
<select name="publish" class="form-control form-control-sm rounded-0 select2" >
    @foreach(__('messages.publish') as $key => $val)
        <option {{ $publish == $key ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
    @endforeach
</select>
</div>