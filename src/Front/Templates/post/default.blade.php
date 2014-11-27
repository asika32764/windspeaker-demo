{{-- Part of windspeaker project. --}}
@extends('front-html')

@section('page_title')
{{{ $post->title }}} | {{{ $blog->title }}}
@stop

@section('main_content')

    <h1 class="page-title">
        <a href="{{{ $post->link }}}">
            {{{ $post->title }}}
        </a>
    </h1>
    <h2 class="sub-title">
        Written by <span class="fn">{{{ $postAuthor->name }}}</span> on
        <time datetime="{{{ $post->created }}} UTC" pubdate data-updated="true">
            {{{ $post->created }}}
        </time>
    </h2>

    <article class="article-content">
        {{ $post->text }}
    </article>

    <hr/>

    <aside class="article-author-profile">
        <h2>Author</h2>
        <div class="uk-clearfix">
            <img class="uk-align-medium-left uk-border-circle" src="{{{ $postAuthor->image }}}" width="150" height="250" alt="Avatar">
            <p>{{{ $postAuthor->description }}}</p>
            @if ($postAuthor->website)
            <p>
                <a class="profile-link" href="{{{ $postAuthor->website }}}">More About Me</a>
            </p>
            @endif
        </div>

    </aside>

    @if ($blog['disqus'])

    <div id="disqus_thread" class="comment-block uk-margin-large-top"></div>
    <script type="text/javascript">
        var disqus_shortname = '{{{ $blog['disqus'] }}}';

        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    @endif
@stop
