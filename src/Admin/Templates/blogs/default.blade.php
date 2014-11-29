{{-- Part of windspeaker project. --}}
<?php
$return = base64_encode($uri['current']);
?>

@extends('admin-html')

@section('page_title')
My Blogs
@stop

@section('main_content')
<div class="toolbar">
<a class="btn btn-primary" href="{{{ \Windwalker\Core\Router\Router::buildHtml('admin:blog', ['id' => '']) }}}">
    New Blog
</a>
</div>

<form action="{{{ $uri['current'] }}}" method="post" id="adminForm">
    <table class="table table-striped">
        <tbody>
            @foreach ($items as $k => $item)
            <tr>
                {{--<td>--}}
                    {{--<input type="checkbox">--}}
                {{--</td>--}}
                <td>
                    <a href="{{{ \Windwalker\Core\Router\Router::buildHtml('admin:blog', ['id' => $item->id]) }}}">
                    {{{ $item->title }}}
                    </a>
                </td>
                <td>
                @if ($item->author_admin && $item->author_owner)
                    <span class="label label-danger">Owner</span>
                @elseif ($item->author_admin)
                    <span class="label label-success">Admin</span>
                @else
                    <span class="label label-info">Member</span>
                @endif
                </td>
                <td width="5%">
                    @if ($item->author_owner)
                    <button type="button" class="btn btn-default"
                        data-toggle="tooltip" data-placement="top" title="Delete this blog"
                        onclick="Windspeaker.deleteItem('{{{ \Windwalker\Core\Router\Router::buildHtml('admin:blog', ['id' => $item->id]) }}}')">
                        <span class="fa fa-trash"></span>
                    </button>
                    @else
                    <button type="button" class="btn btn-default"
                        data-toggle="tooltip" data-placement="top" title="Leave this blog"
                        onclick="Windspeaker.deleteItem('{{{ \Windwalker\Core\Router\Router::buildHtml('admin:author', ['id' => $item->author_id, 'return' => $return]) }}}')">
                        <span class="fa fa-sign-out"></span>
                    </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>
@stop
