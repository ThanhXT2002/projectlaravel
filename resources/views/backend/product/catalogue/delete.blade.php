@extends('backend.layout.layoutadmin')

@section('content')
    @include('backend.layout.component.breadcrumb', ['title' => $config['seo']['delete']['title']])
    <section class="content mt-4">
        @include('backend.layout.component.formError')
        <form action="{{ route('product.catalogue.destroy', $productCatalogue->id) }}" method="post" class="box">
            @include('backend.layout.component.destroy', ['model' => ($productCatalogue) ?? null])
        </form>

       
    </section>
@endsection
