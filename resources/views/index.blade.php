@extends('layouts.app')

@section('contents')
    <h3>お店一覧</h3>

    {{ Form::open(['method' => 'get']) }}
    {{ csrf_field() }}
    <div class='form-group'>
        {{ Form::label('keyword', '店名・住所検索') }}
        {{ Form::text('keyword', null, ['class' => 'form-control col-md-6']) }}
    </div>
    <p>{{ $message }}</p>
    <div class='form-group'>
        {{ Form::submit('検索', ['class' => 'btn btn-outline-success'])}}
        <a href="{{ route('shop.list') }}" class="btn btn-outline-danger">クリア</a>
    </div>
    {{ Form::close() }}

    {{-- @authの中はログインしている時だけ表示させる --}}
    @auth
        <div>
            <a href="{{ route('shop.new') }}" class='btn btn-outline-primary' style="margin-bottom: 3%;">新しいお店</a>
        </div>
    @endauth
    <div class="contents">
    @foreach($shops as $shop)

            <div class="contents-wrap">
                <div class="contents-img">
                    {{-- <img src="data:image/png;base64,{{ $shop->image }}" alt=""> --}}
                    <img src="{{ $shop->image }}" alt="imageUpload">
                </div>
                <div class="contents-text">
                    <a class="Link" href={{ route('shop.detail',['id'=>$shop->id]) }}></a>
                    <h4>{{ $shop->name }}</h4>
                    <a>{{ $shop->address }}</a><br>
                </div>
            </div>
    @endforeach
    </div>
@endsection