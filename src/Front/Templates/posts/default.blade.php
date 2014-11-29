{{-- Part of windspeaker project. --}}
@extends('front-html')

@section('page_title')
{{{ $pageTitle }}}@stop

@section('main_content')
    @foreach($posts as $k => $post)
    <div class="article-item">
        <div class="article-detail">
            <h1 class="page-title uk-margin-large-top">
                <a href="{{{ $post->link }}}">
                    {{{ $post->title }}}
                </a>
            </h1>
            <h2 class="sub-title">
                Written by <span class="fn">{{{ $post->author->name }}}</span> on
                <time datetime="{{{ $post->created }}} UTC" pubdate data-updated="true">
                    {{{ $post->created }}}
                </time>
            </h2>
        </div>

        <article class="article-content">
            {{ $post->introtext }}
        </article>

        <div class="article-footer">
            @if ($blog['disqus'])
                <div class="post-comment uk-float-right">
                    <a href="{{{ $uri['base.host'] . $post->link }}}#disqus_thread">0 Comments</a>
                </div>
            @endif

            <div class="post-readmore uk-float-left">
                <a class="readmore-button uk-button uk-button-primary" href="{{{ $post->link }}}">
                Read More
                </a>
            </div>

            <div class="uk-clearfix"></div>
        </div>

        <hr/>
    </div>
    @endforeach

    @include('widget.pagination')
@stop
