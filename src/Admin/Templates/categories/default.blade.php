{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('page_title')
Categories
@stop

@section('main_content')
<script>
var Category = {
    edit: function(title, id)
    {
        jQuery('#cat-title-input').val(title);
        jQuery('#cat-id-input').val(id);

        $('#newModal').modal({show: true});
    },

    submit: function(link)
    {
        $('#cat-form')[0].submit();
    }
};
</script>

<form action="{{{ $uri['current'] }}}" method="post" id="adminForm">
    <div class="toolbar">
        <a class="btn btn-success" href="javascript:void(0);" onclick="Category.edit('', '');">New</a>
    </div>

    <table class="table table-striped">
        <tbody>
            @foreach ($items as $k => $item)
            <tr>
                <td>
                    <input type="checkbox">
                </td>
                <td>
                    <h4>
                        <a href="javascript:void(0);" onclick="Category.edit('{{{ $item->title }}}', {{{ $item->id }}});">
                            {{{ $item->title  }}}
                        </a>
                    </h4>
                </td>
                <td width="5%">
                    <button type="button" class="btn btn-default"
                        onclick="Windspeaker.deleteItem('{{{ \Windwalker\Core\Router\Router::buildHtml('admin:category', ['id' => $item->id]) }}}')">
                        <span class="fa fa-trash"></span>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>


<div class="modal category-modal" id="newModal">
	<div class="modal-dialog">
        <div class="modal-content animated fadeInUp">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Category Edit</h4>
            </div>
            <div class="modal-body">
                <form id="cat-form" action="{{{ $uri['base.base'] . \Windwalker\Core\Router\Router::build('admin:category') }}}" class="" method="post">
                    <input type="text" id="cat-title-input" class="form-control" name="category[title]"/>
                    <input type="hidden" id="cat-id-input" name="category[id]"/>
                </form>
            </div>
            <div class="modal-footer">
              <a href="#" data-dismiss="modal" class="btn">Close</a>
              <a href="#" class="btn btn-primary" onclick="Category.submit(this);">Save</a>
            </div>
        </div>
    </div>
</div>
@stop
