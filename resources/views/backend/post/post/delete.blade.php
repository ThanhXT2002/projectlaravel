@extends('backend.layout.layoutadmin')

@section('content')
    @include('backend.layout.component.breadcrumb', ['title' => $config['seo']['delete']['title']])
    <section class="content mt-2">
        @include('backend.layout.component.formError')
        <form action="{{route('post.destroy', $post->id)}}" method="post" class="box">
            @csrf
            
            <input type="hidden" name="name" value="{{$post->name}}" id="">
            <div class="wrapper wrapper-content animated fadeInRight">
                @include('backend.layout.component.btnsubmit')
                <div class="row">
                    <div class="col-lg-3 pl-4"> 
                        <h5 class=""><strong>{{ __('messages.generalTitle') }}</strong></h5>
                        <p class="font-italic"><strong class="text-danger">(*)</strong>: {{ __('messages.generalDescription') }}</p>               
                    </div>
                    <div class="col-lg-9">
                        <div class="card-body bg-white shadow-lg">                       
                                
                                    
                                    <div class="font-weight-700 mb-4">
                                        <strong class="text-xl">Tiều đề: {{$post->name}}</strong>
                                    </div>
                                    <div class="">
                                        {!!$post->description!!}
                                    </div>
                                    <div class="">
                                        {!!$post->content!!}
                                    </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </form>

       
    </section>
@endsection
