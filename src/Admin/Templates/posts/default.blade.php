{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('page_title')
    @if ($type == 'static')
    Static Pages Manage
    @else
    Articles Manage
    @endif
@stop

@section('main_content')
<form action="{{{ $uri['current'] }}}" method="post" id="adminForm">
    <table class="table table-striped">
        <tbody>
            @foreach ($items as $k => $item)
            <tr>
                <td>
                    <input type="checkbox">
                </td>
                <td width="5%">
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" aria-expanded="false">
                            <span class="fa fa-{{ $item->state ? 'globe text-info' : 'inbox' }}"></span>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                @if ($item->state)
                                <a onclick="Windspeaker.post('{{{ \Windwalker\Core\Router\Router::buildHtml('admin:post_state_down', ['id' => $item->id]) }}}', 'put')"
                                    href="javascript:void(0);">
                                    <span class="fa fa-times"></span> Unpublish
                                </a>
                                @else
                                <a onclick="Windspeaker.post('{{{ \Windwalker\Core\Router\Router::buildHtml('admin:post_state_up', ['id' => $item->id]) }}}', 'put')"
                                    href="javascript:void(0);">
                                    <span class="fa fa-globe"></span> Publish
                                </a>
                                @endif
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a type="button" href="javascript:void(0);"
                                    onclick="Windspeaker.deleteItem('{{{ \Windwalker\Core\Router\Router::buildHtml('admin:post', ['id' => $item->id]) }}}')">
                                    <span class="fa fa-trash text-danger"></span> <span class="text-danger">Delete</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
                <td>
                    <h4>
                        <a href="#">
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
                        href="{{{ 'http://' . $blog->alias . '.windspeaker.co' . \Windwalker\Core\Router\Router::buildHtml($route, ['id' => $item->id, 'alias' => $item->alias]) }}}">
                        <span class="fa fa-eye"></span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>
@stop
