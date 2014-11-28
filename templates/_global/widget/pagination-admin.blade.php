{{-- Part of windspeaker project. --}}
<?php
$route = ($type == 'post') ? 'posts' : 'statics';
?>

@if (count($pagination) > 1)
    <?php $current = array_search('current', $pagination); ?>
    <nav class="text-center">
        <ul class="pagination pagination-lg">
            @if ($current != 1)
            <li>
                <a href="{{{ \Windwalker\Core\Router\Router::buildHtml('admin:' . $route, ['page' => $current - 1]) }}}">
                    <span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>
                </a>
            </li>
            @endif

            @foreach ($pagination as $k => $page)
            <li class="{{ $page == 'current' ? 'active' : '' }}">
                @if ($page != 'current')
                <a href="{{{ \Windwalker\Core\Router\Router::buildHtml('admin:' . $route, ['page' => $k]) }}}">
                    <span>{{{ $k }}}</span>
                </a>
                @else
                <span>{{{ $k }}}</span>
                @endif
            </li>
            @endforeach

            @if ($current != count($pagination))
            <li>
                <a href="{{{ \Windwalker\Core\Router\Router::buildHtml('admin:' . $route, ['page' => $current + 1]) }}}">
                    <span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>
                </a>
            </li>
            @endif
        </ul>
    </nav>
@endif
