{{-- Part of windspeaker project. --}}
@extends('front-html')

@section('main_content')
    @foreach($posts as $k => $post)
    <h1 class="page-title">
        <a href="{{{ $post->link }}}">
            {{{ $post->title }}}
        </a>
    </h1>
    <h2 class="sub-title">
        Written by <span class="fn">{{{ $post->author_name ? : $post->user_fullname }}}</span> on
        <time datetime="{{{ $post->created }}} UTC" pubdate data-updated="true">
            {{{ $post->created }}}
        </time>
    </h2>

    <article class="article-content">
        {{ $post->introtext }}
    </article>

    @if ($blog['disqus'])
    <a href="{{{ $post->link }}}#disqus_thread">0 Comments</a>
    @endif

    <hr/>
    @endforeach

    @include('widget.pagination')
@stop
