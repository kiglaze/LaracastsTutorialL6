@extends('layout');

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div class="title">
                    <h2>{{ $article->title }}</h2>
                    <span class="byline">{{ $article->excerpt }}</span>
                </div>
                <p><img src="/images/banner.jpg" alt="" class="image image-full" /> </p>
                <p>{{ $article->body }}</p>
                <div class="article-tags">
                    @foreach($article->tags as $tag)
{{--                        <a href="/articles?tag={{ $tag->name }}">{{ $tag->name }}</a>--}}
                        <a href="{{ route('articles.index', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
