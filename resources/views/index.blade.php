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
        {{ Form::submit('検索', ['class' => 'btn btn-outline-primary'])}}
        <a href="{{ route('shop.list') }}" class="btn btn-outline-primary">クリア</a>
    </div>
    {{ Form::close() }}

    {{-- @authの中はログインしている時だけ表示させる --}}
    @auth
        <div >
            <a href="{{ route('shop.new') }}" class='btn btn-outline-primary'>新しいお店</a>
        </div>
    @endauth

    @foreach($shops as $shop)
        <div class="contents-wrap">
                <div class="contents-img">
                    <img src="data:image/png;base64,{{ $shop->image }}" alt="">
                </div>
                <div class="contents-text">
                    <a href={{ route('shop.detail',['id'=>$shop->id]) }}>
                    <h4>
                        {{ $shop->name }}

                    </h4>
                    </a>
                    <a>
                        {{ $shop->address }}
                    </a>
                    <br>
                    <a>
                        投稿者： {{ $shop->user->name }}
                    </a>
                </div>

        </div>

    @endforeach

@endsection