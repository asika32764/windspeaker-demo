{{-- Part of windspeaker project. --}}

@extends('admin-html')

<?php
$route = 'admin:' . $type;
?>

@section('page_title')
    @if ($type == 'static')
    Static Pages Manage
    @else
    Articles Manage
    @endif
@stop

@section('toolbar')
<a href="#" class="btn" data-toggle="modal" data-target="#newModal"><i class="fa fa-pencil-square-o"></i> New</a>
@stop

@section('main_content')
<script>
    var addPost = function(btn)
    {
        var form = $('#post-form');

        var title = $('#post-title-input');

        if (!title.val().trim())
        {
            return;
        }

        var data = {post: {}};

        data.post.title = title.val();

        $.ajax({
            url: '{{{ \Windwalker\Core\Router\Router::buildHttp($route) }}}',
            data: data,
            type: "POST",
            success: function (data)
            {
                if (data.success)
                {
                    window.location = '{{{ \Windwalker\Core\Router\Router::buildHttp($route) }}}/' + data.item.id;
                }
            },
            error: function(data)
            {
                console.log(data);
            }
        });
    };
</script>

<form action="{{{ $uri['current'] }}}" method="post" id="adminForm">

    <table class="table table-striped">
        <tbody>
            @foreach ($items as $k => $item)
            <tr>
                {{--<td>--}}
                    {{--<input type="checkbox">--}}
                {{--</td>--}}
                <td width="5%">
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" aria-expanded="false">
                            <span class="fa fa-{{ $item->state ? 'globe text-info' : 'inbox' }}"></span>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                @if ($item->state)
                                <a onclick="Windspeaker.post('{{{ \Windwalker\Core\Router\Router::buildHtml($route . '_state_down', ['id' => $item->id]) }}}', 'put')"
                                    href="javascript:void(0);">
                                    <span class="fa fa-times"></span> Unpublish
                                </a>
                                @else
                                <a onclick="Windspeaker.post('{{{ \Windwalker\Core\Router\Router::buildHtml($route . '_state_up', ['id' => $item->id]) }}}', 'put')"
                                    href="javascript:void(0);">
                                    <span class="fa fa-globe"></span> Publish
                                </a>
                                @endif
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a type="button" href="javascript:void(0);"
                                    onclick="Windspeaker.deleteItem('{{{ \Windwalker\Core\Router\Router::buildHtml($route, ['id' => $item->id]) }}}')">
                                    <span class="fa fa-trash text-danger"></span> <span class="text-danger">Delete</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
                <td>
                    <h4>
                        <a href="{{{ \Windwalker\Core\Router\Router::buildHtml($route, ['id' => $item->id]) }}}">
                            {{{ $item->title  }}}
                        </a>
                    </h4>
                    <small>
                        {{{ $item->alias  }}}
                    </small>
                </td>
                <td>
                    {{{ $item->created  }}}
                </td>
                <td>
                    {{{ $item->author_name ? : $item->user_fullname }}}
                </td>
                <td>
                    <a target="_blank" class="btn btn-success"
                        href="{{{ 'http://' . $blog->alias . '.windspeaker.co' . \Windwalker\Core\Router\Router::buildHtml('front:' . $type . '_default', ['id' => $item->id, 'alias' => $item->alias]) }}}">
                        <span class="fa fa-eye"></span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @include('widget.pagination-admin')

    <div class="modal post-modal" id="newModal">
    	<div class="modal-dialog">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title">Add New Article</h4>
                </div>
                <div class="modal-body">
                    <form id="post-form" action="{{{ $uri['base.base'] . \Windwalker\Core\Router\Router::build('admin:category') }}}" class="" method="post">
                        <input type="text" id="post-title-input" class="form-control input-lg" placeholder="Article Title..." name="post[title]"/>
                    </form>
                </div>
                <div class="modal-footer">
                  <a href="#" data-dismiss="modal" class="btn">Close</a>
                  <a href="#" class="btn btn-primary" onclick="addPost(this);">Save</a>
                </div>
            </div>
        </div>
    </div>
</form>
@stop
