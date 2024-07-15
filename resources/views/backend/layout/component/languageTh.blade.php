@foreach($languages as $language)
    @if(session('app_locale') === $language->canonical) 
        @continue
    @endif

    <th class="text-center" width="100px">
        <img src="{{ $language->image }}" alt="" style="width:40px; height:28px; object-fit:cover">
    </th>
@endforeach
