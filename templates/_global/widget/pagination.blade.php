{{-- Part of windspeaker project. --}}
@if (count($pagination) > 1)
    <?php $current = array_search('current', $pagination); ?>
    <ul class="uk-pagination uk-pagination-left">
        @if ($current != 1)
        <li>
            <a href="{{{ \Windwalker\Core\Router\Router::buildHtml('front:posts', ['page' => $current - 1]) }}}">
                <i class="uk-icon-angle-double-left"></i></a>
            </a>
        </li>
        @endif

        @foreach ($pagination as $k => $page)
        <li class="{{ $page == 'current' ? 'uk-active' : '' }}">
            @if ($page != 'current')
            <a href="{{{ \Windwalker\Core\Router\Router::buildHtml('front:posts', ['page' => $k]) }}}">
                <span>{{{ $k }}}</span>
            </a>
            @else
            <span>{{{ $k }}}</span>
            @endif
        </li>
        @endforeach

        @if ($current != count($pagination))
        <li>
            <a href="{{{ \Windwalker\Core\Router\Router::buildHtml('front:posts', ['page' => $current + 1]) }}}">
                <i class="uk-icon-angle-double-right"></i>
            </a>
        </li>
        @endif
    </ul>
@endif
