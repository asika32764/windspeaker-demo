{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('page_title')
Authors & Team
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
                        {{{ $item->name ? : $item->user_fullname  }}}
                    </a>
                </h4>
            </td>
            <td>
                {{{ $item->admin  }}}
            </td>
            <td>
                {{{ $item->owner }}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
