{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('page_title')
Authors & Team
@stop

@section('main_content')
<div class="toolbar">
    <form action="{{{ $uri['base.path'] . 'author' }}}" method="post" name="adminForm">
        <div class="row">
            <span class="col-md-3"><input type="text" name="username" class="form-control"/></span>
            <button class="btn btn-default">Add This User</button>

            <a class="btn btn-primary" href="{{{ \Windwalker\Core\Router\Router::buildHtml('admin:author', ['id' => '']) }}}">
                Create Author
            </a>
        </div>
    </form>
</div>


<table class="table table-striped">
    <tbody>
        @foreach ($items as $k => $item)
        <tr>
            <td width="5%" class="text-center">
                <input type="checkbox">
            </td>
            <td style="width: 5%" class="text-center">
                @if ($item->user)
                    @if ($item->admin && $item->owner)
                        <span class="label label-danger">Owner</span>
                    @elseif ($item->admin)
                        <span class="label label-success">Admin</span>
                    @else
                        <span class="label label-info">Member</span>
                    @endif
                @else
                    <span class="label">Author</span>
                @endif
            </td>
            <td style="width: 5%" class="text-center">
                @if (!$item->owner && $item->user)
                    @if ($item->admin)
                    <a class="btn btn-default btn-xs" href="{{{ \Windwalker\Core\Router\Router::build('admin:author', ['id' => $item->id, 'permission' => 'member', '_method' => 'post']) }}}">
                        <span class="fa fa-arrow-down"></span>
                    </a>
                    @else
                    <a class="btn btn-default btn-xs" href="{{{ \Windwalker\Core\Router\Router::build('admin:author', ['id' => $item->id, 'permission' => 'admin', '_method' => 'post']) }}}">
                        <span class="fa fa-arrow-up"></span>
                    </a>
                    @endif
                @endif
            </td>
            <td style="width: 40px">
                <img alt="image" width="32" class="img-circle" src="{{{ $uri['media.path'] . 'img/a' . rand(1, 8) . '.jpg' }}}">
            </td>
            <td>
                <h4>
                    @if ($item->user)
                    {{{ $item->name ? : $item->user_fullname  }}}
                    @else
                    <a href="{{{ \Windwalker\Core\Router\Router::buildHtml('admin:author', ['id' => $item->id]) }}}">
                        {{{ $item->name ? : $item->user_fullname  }}}
                    </a>
                    @endif
                </h4>
            </td>
            <td style="width: 5%">
                <a class="btn btn-default" href="{{{ \Windwalker\Core\Router\Router::buildHtml('admin:author', ['id' => $item->id, '_method' => 'delete']) }}}">
                    <span class="fa fa-trash"></span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
