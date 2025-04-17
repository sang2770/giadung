@extends('layouts.app')
@section('content')
<style>
    .detail-new {
        max-width: 800px;
        margin: 30px auto; /* Căn giữa theo chiều ngang */
        font-size: 1.4rem;
        line-height: 1.8rem;
    }
</style>
    <div class="app">
        <div class="app__container">
            <div class="grid wide">
                <nav style="font-size: 1.6rem; padding-top: 20px">
                    <span>
                        <a class="link-page" href="{{ url('/') }}">Trang chủ</a> > 
                        <a class="link-page" href="{{ url('/tin-tuc') }}">Tin tức</a> > 
                        <span style="color: rgb(247, 143, 75)">{{ $contentsTitle }}</span>
                    </span>
                </nav>

                    <div class="detail-new">
                        <h2>{{ $contentsTitle }}</h2>
                        <span>📅 {{ $contentsDate }}</span>
                        <p>{{ $contentsintroText }}</p>
                        <p class="content-img" style="text-align: center;">
                            <img style=" max-width: 800px;" src="{{ $contentsImage }}" alt="{{ $contentsTitle }}">
                        </p>
                        <p>{!! $contentsfullText !!}</p>
                    </div>
            </div>
        </div>
    </div>
@endsection