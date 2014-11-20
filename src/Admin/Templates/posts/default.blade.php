{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('page_title')
Articles Manage
@stop

@section('main_content')
<table class="table table-striped">
    <tbody>
        @foreach ($items as $k => $item)
        <tr>
            <td>
                <input type="checkbox">
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
                {{{ $item->author_name }}}
            </td>
            <td>
                VIEW
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
