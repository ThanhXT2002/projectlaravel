@extends('backend.layout.layoutadmin')
@section('content')
    @include('backend.layout.component.breadcrumb', ['title' => $config['seo']['index']['title']])
    @php
        $url =
            isset($config['method']) && $config['method'] == 'translate'
                ? route('system.save.translate', ['languageId' => $languageId])
                : route('system.store');
    @endphp
    <section class="content mt-2">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ $url }}" method="post">
                        @csrf
                        <div class="card card-primary card-outline">
                            <div class="card-header ">
                                <h3 class="card-title font-weight-bold text-uppercase text-muted">
                                    <i class="fas fa-edit"></i>
                                    {{ $config['seo']['index']['table'] }}
                                </h3>
                                <div class="card-tools">
                                    @foreach ($languages as $language)
                                        <a class=" mx-2 language-item-system p-3 font-weight-bold text-gray-dark {{ $language->id == $languageId ? 'active' : '' }} "
                                            href="{{ route('system.translate', ['languageId' => $language->id]) }}">
                                            {{-- <img src="{{ $language->image }}" alt=""
                                            style="height: 28px; width:40px; object-fit:cover"
                                                > --}}
                                                {{$language->canonical}}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5 col-sm-3">
                                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                            aria-orientation="vertical">
                                            @foreach ($systemConfig as $key => $val)
                                                <a class="nav-link text-success font-weight-600 {{ $loop->first ? 'active' : '' }}"
                                                    id="{{ $key }}-tab" data-toggle="pill"
                                                    href="#{{ $key }}" role="tab"
                                                    aria-controls="{{ $key }}" aria-selected="true">
                                                    {{ $val['label'] }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-7 col-sm-9">
                                        <div class="tab-content" id="vert-tabs-tabContent">
                                            @foreach ($systemConfig as $key => $val)
                                                <div class="tab-pane text-left fade {{ $loop->first ? 'show active' : '' }}"
                                                    id="{{ $key }}" role="tabpanel"
                                                    aria-labelledby="{{ $key }}-tab">
                                                    <div>
                                                        {{ $val['description'] }}
                                                    </div>
                                                    <div class="p-2">
                                                        @if (count($val['value']))
                                                            <div class="row mb-2 ">
                                                                @foreach ($val['value'] as $keyVal => $item)
                                                                    @php
                                                                        $name = $key . '_' . $keyVal;
                                                                    @endphp
                                                                    <div class="col-lg-12 mb-3">
                                                                        <label for=""
                                                                            class="control-label text-left d-flex justify-content-between">
                                                                            <span>
                                                                                {{ $item['label'] ?? 'Default Label' }}
                                                                            </span>
                                                                            <span class="text-sm">
                                                                                {!! renderSystemLink($item) !!}
                                                                                {!! renderSystemTitle($item) !!}
                                                                            </span>
                                                                        </label>
                                                                        @switch($item['type'])
                                                                            @case('text')
                                                                                {!! renderSystemInput($name, $system) !!}
                                                                            @break

                                                                            @case('images')
                                                                                {!! renderSystemImages($name, $system) !!}
                                                                            @break

                                                                            @case('textarea')
                                                                                {!! renderSystemTextarea($name, $system) !!}
                                                                            @break

                                                                            @case('select')
                                                                                {!! renderSystemSelect($item, $name, $system) !!}
                                                                            @break

                                                                            @case('editor')
                                                                                {!! renderSystemEditor($name, $system) !!}
                                                                            @break

                                                                            @default
                                                                        @endswitch

                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>


                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                @include('backend.layout.component.btnsubmit')
                            </div>
                            <!-- /.card -->
                        </div>

                    </form>
                </div>


                <!-- /.col -->
            </div>
        </div>

        {{-- <form action="{{ $url }}" method="post">
            @csrf

            <div class="text-right mb-2 d-flex justify-content-end align-items-center">
                @foreach ($languages as $language)
                    <a class="mx-2 p-1 language-item mt-2 {{ $language->id == $languageId ? 'active' : '' }}"
                        href="{{ route('system.translate', ['languageId' => $language->id]) }}">
                        <img src="{{ $language->image }}" alt="" style="width:40px; height:28px; object-fit:cover">
                    </a>
                @endforeach
            </div>

            @foreach ($systemConfig as $key => $val)
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-uppercase  text-gray font-weight-600">
                            {{ $val['label'] }}
                        </h3>
                        <br>
                        <div class="text-sm">
                            {{ $val['description'] }}
                        </div>
                    </div>
                    @if (count($val['value']))
                        <div class="card-body">

                            <div class="row mb-2 ">
                                @foreach ($val['value'] as $keyVal => $item)
                                    @php
                                        $name = $key . '_' . $keyVal;
                                    @endphp
                                    <div class="col-lg-6 mb-3">
                                        <label for=""
                                            class="control-label text-left d-flex justify-content-between">
                                            <span>
                                                {{ $item['label'] ?? 'Default Label' }}
                                            </span>
                                            <span class="text-sm">
                                                {!! renderSystemLink($item) !!}
                                                {!! renderSystemTitle($item) !!}
                                            </span>
                                        </label>
                                        @switch($item['type'])
                                            @case('text')
                                                {!! renderSystemInput($name, $system) !!}
                                            @break

                                            @case('images')
                                                {!! renderSystemImages($name, $system) !!}
                                            @break

                                            @case('textarea')
                                                {!! renderSystemTextarea($name, $system) !!}
                                            @break

                                            @case('select')
                                                {!! renderSystemSelect($item, $name, $system) !!}
                                            @break

                                            @case('editor')
                                                {!! renderSystemEditor($name, $system) !!}
                                            @break

                                            @default
                                        @endswitch

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
            @include('backend.layout.component.btnsubmit')
        </form> --}}

    </section>
@endsection
