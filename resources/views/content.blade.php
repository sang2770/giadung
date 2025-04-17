@extends('layouts.app')
@section('content')
<style>
.new-main {
    margin: 10px 0
}
.card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: 5px 0;
}

.card:hover {
    transform: translateY(-1px);
    box-shadow: 0 1px 20px 0 rgba(0, 0, 0, 0.05);
}

.card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}

.card-content {
    padding: 15px;
}

.card h3 {
    font-size: 18px;
    font-weight: bold;
    margin: 0 0 8px 0;
}

.card p {
    font-size: 14px;
    color: #555;
    margin-bottom: 12px;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
    color: #777;
}

.btn {
    padding: 8px 12px;
    background: blue;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: 0.3s;
}

.btn:hover {
    background: darkblue;
}
</style>
<div class="app">
    <div class="app__container">
        <div class="grid wide">
                <nav style="font-size: 1.6rem; padding-top: 20px">
                    <span>
                        <a class="link-page" href="{{ url('/') }}">Trang chủ</a> > 
                        <span style="color: rgb(247, 143, 75)">Tin tức</span>
                    </span>
                </nav>
            <div class="new-main">
                @if($contents->isEmpty())
                    <p style="text-align: center; font-size: 16px; color: #242424; padding: 20px;">
                        Hiện tại chưa có tin tức nào
                    </p>
                @else
                <div class="row sm-gutter">
                    @foreach($contents as $content)
                    <div class="col l-3 m-4 c-6">
                        <div class="card">
                            <img class="content-imgs" src="{{ asset('uploads/contents/' . $content->image) }}" alt="{{ $content->title }}">
                            <div class="card-content">
                                <h3>{{ $content->title }}</h3>
                                <p>{{ Str::limit($content->introtext, 100) }}</p>
                                <div class="card-footer">
                                    <span>📅 {{ $content->created_at->format('d/m/Y') }}</span>
                                    <a href="{{ route('content.detail', ['id' => $content->id]) }}" class="btn">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection