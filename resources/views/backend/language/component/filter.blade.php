<form action="{{ route('language.index') }}" method="GET">
    <div class="filter d-flex flex-wrap justify-content-between my-2">
        <div class="perpage ml-2">
            @php
                $perpage = request('perpage') ?: old('perpage');
            @endphp
            <select name="perpage" class="form-control form-control-sm rounded-0 select2" style="width:130px">
                @for ($i = 20; $i <= 100; $i += 20)
                    <option {{ $perpage == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }} bản ghi</option>
                @endfor
            </select>
        </div>
        <div class="d-flex flex-wrap justify-content-between ml-2">
            @php
                $publish = request('publish') ?: old('publish');
            @endphp
            <div class="" style="width:170px">
                <select name="publish" class="form-control form-control-sm rounded-0 select2" >
                    @foreach (config('apps.general.publish') as $key => $val)
                        <option {{ $publish == $key ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
           
            <div class="input-group input-group-sm mr-2" style="width:400px">
                <input type="text" name="keyword" value="{{ request('keyword') ?: old('keyword') }}" placeholder="Nhập từ khóa..." class="form-control form-control-sm rounded-0 border border-info shadow">
                <div class="input-group-append">
                    <button type="submit" name="search" class="btn btn-info btn-sm rounded-0">Tìm kiếm</button>
                </div>
            </div>
            <div class="pr-1 start-end">
                <a href="{{ route('language.create') }}" class="btn btn-danger btn-sm d-flex align-items-center rounded-0" style="width:140px"><i class="fa fa-plus mr-1"></i>Thêm ngôn ngữ</a>
            </div>
        </div>
    </div>
</form>

