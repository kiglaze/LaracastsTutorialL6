@extends('layout');

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                @foreach($articles as $article)
                    <div class="title">
                        <h2>
{{--                            <a href="/articles/{{ $article->id }}">{{ $article->title }}</a>--}}
                            <a href="{{ route('articles.show', $article->id ) }}">{{ $article->title }}</a>
                        </h2>
                        <span class="byline">{{ $article->excerpt }}</span>
                    </div>
                    <p><img src="/images/banner.jpg" alt="" class="image image-full" /> </p>
                    <p>{{ $article->body }}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
