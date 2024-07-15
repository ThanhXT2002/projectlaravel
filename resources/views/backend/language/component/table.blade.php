<div class="card-body p-0 table-responsive">

    <table class="table  table-striped table table-bordered table-head-fixed text-wrap">
        <thead>
            <tr>
                <th class="text-center" width="50px">
                    {{-- <input type="checkbox" value="" id="checkAll" class = "input-checkbox"> --}}
                    <div class="icheck-success d-inline">
                        <input type="checkbox" value=""  id="checkAll" class="input-checkbox">
                        <label for="checkAll"></label>
                      </div>
                </th>

                <th style="width:100px;">Ảnh</th>
                <th>Tên Ngôn ngữ</th>
                <th>Canonical</th>
                <th>Mô tả</th>
                <th class="text-center">Tình Trạng</th>
                <th class="text-center">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            
            @if (isset($languages) && is_object($languages))
                @foreach ($languages as $language)
                    <tr>
                        <td class="text-center">
                           
                            <div class="icheck-success">
                                <input type="checkbox" value="{{ $language->id }}" class = "input-checkbox checkBoxItem" id="checkOne{{ $language->id }}">
                                <label for="checkOne{{ $language->id }}"></label>
                              </div>
                        </td>
                        <td class="text-center">
                           <img src="{{ $language->image }}" alt="ảnh" class="img-size-64">
                        </td>
                        <td>
                            {{ $language->name }}
                        </td>
                        <td>
                            {{ $language->canonical }}
                        </td>
                        <td>
                            {{ $language->description }}
                        </td>
                        <td class="text-center js-switch-{{ $language->id }}">
                            <input type="checkbox" class="js-switch status" value="{{ $language->publish }}" data-field="publish" data-model="{{ $config['model'] }}" {{ ($language->publish == 2) ? 'checked' : '' }} data-modelId="{{ $language->id }}" data-bootstrap-switch />
                        </td>
                        
                        <td class="text-center " width="120px">
                            <a href="{{ route('language.edit', $language->id) }}" class="btn btn-info btn-sm"><i
                                    class="fa fa-edit"></i></a>
                            <a href="{{ route('language.delete', $language->id) }}" class="btn btn-danger btn-sm"><i
                                    class="fa fa-trash"></i></a>

                        </td>

                    </tr>
                @endforeach
            @endif
           
        </tbody>
    </table>

    <div class="start-end float-right mt-3 mr-4">  
        {{$languages->links('pagination::bootstrap-4')}}
    </div>
</div>


