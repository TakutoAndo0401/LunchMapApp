@extends('layouts.app')

@section('contents')

    <div>
        <h2>{{ $shop->name }}</h2>
        <p>{{ $shop->address }}</p>
        <p>作成日：{{ $shop->created_at }}</p>
{{--        <p><img src="data:image/png;base64,{{ $shop->image }}" alt="imageUpload" class="show-img" ></p>--}}
        <img src="{{ $shop->image }}" alt="imageUpload" class="show-img">
        <hr>
        <p>{{ $shop->body }}</p>
    </div>
    
    <iframe id='map' src='https://www.google.com/maps/embed/v1/place?key=AIzaSyDvy6r1fS8eQne4CTjuMZsQb6neesQIXPs&q={{ $shop->address }}'
            width='100%'
            height='320px'
            frameborder='0'>
    </iframe>

    <div class="input-group">
        <a href="{{route('shop.list')}}" class="btn btn-outline-primary input-group-addon　btn-style">一覧に戻る</a>

        @auth
            @if($shop->user_id === $login_user_id)
                <a href="{{route('shop.edit' , ['id' => $shop->id])}}" class="btn btn-outline-primary input-group-addon btn-style" >編集</a>
                {{ Form::open(['method' => 'delete' , 'route'=>['shop.destroy' , $shop->id]]) }}
                {{ Form::submit('消去' , ['class' => 'btn btn-outline-danger input-group-addon btn-style' ]) }}
                {{ Form::close() }}
            @endif
        @endauth
    </div>
    <div style="margin-bottom: 10%;"></div>

@endsection