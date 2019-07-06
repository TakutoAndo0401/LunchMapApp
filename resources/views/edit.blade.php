@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$shop->name}}{{ __('を編集する') }}</div>

                    <div class="card-body">
                        {{-- 既存のお店情報を呼び出す --}}
                        <form method="POST" action="{{ route('shop.update' , $shop->id) }}" enctype="multipart/form-data">
                            @csrf

                            {{-- httpメソッドのpatchが使えるようになる。 --}}
                            {{ method_field('patch') }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('店名') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $shop->name) }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('場所') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address', $shop->address) }}" required autocomplete="address">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('説明') }}</label>

                                <div class="col-md-6">
                                    <input id="body" type="text" class="form-control" name="body" value="{{ old('body', $shop->body) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('写真を選択する') }}</label>
                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image" value="{{ old('image', $shop->image) }}">
                                </div>
                                @if ($errors->has('image'))
                                    <span class="error">{{ $errors->first('image') }}</span>
                                @endif
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('更新する') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
