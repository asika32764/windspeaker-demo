{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('page_title')
Categories
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
            </td>
            <td>
                Delete
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
