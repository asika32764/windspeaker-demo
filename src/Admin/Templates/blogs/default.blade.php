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

<table class="table table-striped">
    <tbody>
        @foreach ($items as $k => $item)
        <tr>
            <td>
                <input type="checkbox">
            </td>
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
                <a class="btn btn-default" href="{{{ \Windwalker\Core\Router\Router::buildHtml('admin:blog', ['id' => $item->id, '_method' => 'delete']) }}}">
                    <span class="fa fa-trash"></span>
                </a>
                @else
                <a class="btn btn-default" href="{{{ \Windwalker\Core\Router\Router::buildHtml('admin:author', ['id' => $item->author_id, '_method' => 'delete', 'return' => $return]) }}}">
                    <span class="fa fa-sign-out"></span>
                </a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
