{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('page_title')
Blog Settings
@stop

@section('main_content')
    <style>
    #blog-alias-control .col-xs-9::after {
        content: ".windspeaker.co";
        display: inline;
        font-size: 1.5em;
    }
    #blog-alias {
        width: 30%;
        display: inline;
        text-align: right;
    }
    </style>

    <div class="row">
        <div class="col-md-12">

            <div id="blog-setting" class="ibox">
                <div id="tab-edit" class="tab-pane fade in active ibox-content">
                    <form id="adminForm" action="{{{ $uri['base.current'] }}}" class="form-horizontal" method="post">
                        <h3>Basic Information</h3>

                        @foreach ($form->getFields('basic') as $field)
                        <div id="{{{ $field->getId() }}}-control" class="form-group">
                            {{ $field->renderLabel(); }}

                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        {{ $field->renderInput(); }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <hr>
                        <h3>Advanced Setting</h3>

                        @foreach ($form->getFields('other') as $field)
                        <div class="form-group">
                            {{ $field->renderLabel(); }}

                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-9">
                                        {{ $field->renderInput(); }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <hr>
                            <h3>Style</h3>

                            @foreach ($form->getFields('style') as $field)
                            <div class="form-group">
                                {{ $field->renderLabel(); }}

                                <div class="col-sm-9 controls">
                                    <div class="row">
                                        <div class="col-xs-9">
                                            {{ $field->renderInput(); }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        <hr>
                        <button type="submit" class="btn btn-primary btn-lg">Save</button>

                        <input type="hidden" name="blog[id]" value="{{{ $item->id }}}"/>
                        <input type="hidden" name="_method" value="PUT"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script src="{{{ $uri['media.path'] }}}js/ace/src-min/ace.js"></script>
<script src="{{{ $uri['media.path'] }}}js/ace/src-min/ext-emmet.js"></script>

<script>
jQuery(document).ready(function()
{
    var cssField = $('#blog-params-css');
    var area = $('<div id="blog-params-css-editor" class="form-control" style="height: 300px;"></div>');

    cssField.hide();
    area.insertAfter(cssField);
    area.html(cssField.val());

    editor = ace.edit(area[0]);

    editor.setTheme("ace/theme/tomorrow");

    editor.session = editor.getSession();

    editor.session.setMode("ace/mode/css");
    editor.session.setUseWrapMode(true);

    var form = $('#adminForm');

    form.on('submit', function(e)
    {
        cssField.val(editor.getValue());

        return true;
    });
});
</script>
@stop
