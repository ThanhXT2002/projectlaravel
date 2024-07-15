@extends('backend.layout.layoutadmin')

@section('content')
    @include('backend.layout.component.breadcrumb', [
        'title' => $config['seo'][$config['method']]['title'],
    ])
    <section class="content mt-2">
        <form action="{{ route('user.catalogue.updatePermission') }}" method="post" class="box">
            @csrf
            @include('backend.layout.component.btnsubmit')
            <div class="card rounded-0 shadow-lg">
                <div class="card-header">
                    <h3 class="card-title text-uppercase  text-gray font-weight-600">
                        {{ __('messages.titleUpdatePermission') }}
                    </h3>

                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="mb-3">
                        <table class="table table-sm table-striped table-bordered">
                            <tr>
                                <th></th>
                                @foreach ($userCatalogues as $userCatalogue)
                                    <th class="text-center">{{ $userCatalogue->name }}</th>
                                @endforeach
                            </tr>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span class="text-indigo">{{ $permission->name }}</span>
                                        <span class="text-danger">({{ $permission->canonical }})</span>
                                    </td>
                                    @foreach ($userCatalogues as $userCatalogue)
                                        <td class="text-center">
                                            <div class="icheck-success">
                                                <input type="checkbox" name="permission[{{ $userCatalogue->id }}][]"
                                                    value="{{ $permission->id }}" class="input-checkbox"
                                                    id="permission-{{ $userCatalogue->id }}-{{ $permission->id }}"
                                                    {{ collect($userCatalogue->permissions)->contains('id', $permission->id) ? 'checked' : '' }}>
                                                <label
                                                    for="permission-{{ $userCatalogue->id }}-{{ $permission->id }}"></label>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div><!-- /.card-body -->
            </div>
            @include('backend.layout.component.btnsubmit')
        </form>
    </section>
@endsection
