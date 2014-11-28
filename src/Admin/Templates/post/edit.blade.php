{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('page_title')
    @if ($type == 'static')
    Static Pages Edit
    @else
    Articles Edit
    @endif
@stop

@section('title_bar')
<form action="{{{ $uri['current'] }}}" method="post" id="adminForm" enctype="multipart/form-data">
<div class="edit-post-information-section">
    <div class="form-group title-field">
        <input type="text" id="post-title" name="title" placeholder="Your Title Here..." class="form-control input-lg required" aria-required="true" value="{{{ $item->title }}}"/>
    </div>

    <div class="form-group alias-field">
        <input type="text" id="post-alias" name="alias" placeholder="Post url" class="form-control input-sm" value="{{{ $item->alias }}}"/>
    </div>
</div>
<style>
    .dashboard-header h2 {
        display: none;
    }
    label.error {
        display: none !important;
    }
</style>
</form>
@stop

@section('sidebar')
<ul class="nav edit-menu" id="side-menu" data-uk-sticky>
    <li class="nav-header">
        <div class="logo-element">
            WS
        </div>
    </li>

    {{-- Save --}}
    <li class="article-save-button">
        <a href="javascript:void(0);" onclick="WindspeakerEdit.save('{{{ \Windwalker\Core\Router\Router::buildHttp('admin:' . $type) }}}');">
            <i class="fa fa-save fa-fw"></i>
        </a>
    </li>

    {{-- Config --}}
    <li class="article-setting-button">
        <a href="javascript:void(0);">
            <i class="fa fa-gear fa-fw"></i>
        </a>
    </li>

    {{-- Back --}}
    <li class="">
        <a href="{{{ \Windwalker\Core\Router\Router::buildHttp('admin:' . ($type == 'post' ? 'dashboard' : 'statics')) }}}">
            <i class="fa fa-sign-in fa-flip-horizontal fa-fw"></i>
        </a>
    </li>
</ul>
@stop

@section('main_content')
    <div class="ibox float-e-margins">
        <div class="ibox-content no-padding">
            <div class="editor-section">
                <div class="editor-toolbar btn-toolbar"  data-uk-sticky>
                    <div class="btn-group">
                        <button id="button-h1" class="btn btn-default btn-white  btn-sm">H1</button>
                        <button id="button-h2" class="btn btn-default btn-white  btn-sm">H2</button>
                        <button id="button-h3" class="btn btn-default btn-white  btn-sm">H3</button>
                        <button id="button-h4" class="btn btn-default btn-white  btn-sm">H4</button>
                        <button id="button-h5" class="btn btn-default btn-white  btn-sm">H5</button>
                    </div>

                    <div class="btn-group">
                        <button id="button-strong" class="btn btn-default btn-white  btn-sm">
                            <i class="fa fa-bold icon-bold"></i>
                        </button>
                        <button id="button-italic" class="btn btn-default btn-white  btn-sm">
                            <i class="fa fa-italic icon-italic"></i>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button id="button-ul" class="btn btn-default btn-white  btn-sm">
                            <i class="fa fa-list-ul icon-list-ul"></i>
                        </button>
                        <button id="button-ol" class="btn btn-default btn-white  btn-sm">
                            <i class="fa fa-list-ol icon-list-ol">  </i>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button id="button-img" class="btn btn-default btn-white  btn-sm">
                            <i class="fa fa-picture-o icon-picture"></i>
                        </button>
                        <button id="button-link" class="btn btn-default btn-white  btn-sm">
                            <i class="fa fa-link icon-link"></i>
                        </button>
                        {{--<button id="button-video" class="btn btn-default btn-white  btn-sm">--}}
                            {{--<i class="fa fa-youtube-play icon-play"></i>--}}
                        {{--</button>--}}
                    </div>

                    <div class="btn-group">
                        <button id="button-quote" class="btn btn-default btn-white  btn-sm">
                            <i class="fa fa-quote-right icon-quote-right"></i>
                        </button>
                        <button id="button-codeblock" class="btn btn-default btn-white  btn-sm">
                            <i class="fa fa-file-code-o icon-file-code"></i>
                        </button>
                        <button id="button-code" class="btn btn-default btn-white  btn-sm">
                            <i class="fa fa-code icon-code"></i>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button id="button-readmore" class="btn btn-default btn-white  btn-sm">
                            <i class="fa fa-minus icon-eye"></i>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button id="button-preview" class="btn btn-success btn-sm">
                            <i class="fa fa-eye icon-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="row editor-inner">
                    <div class="col-md-6 editor-col">
                        <fieldset>
                            <!-- Editor -->
                            <div id="windspeaker-editor" class="" style="height: 500px;">{{{ $item->text }}}</div>
                        </fieldset>
                    </div>
                    <div class="col-md-6 preview-col">
                        <div class="preview-wrap">
                            <div id="preview-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="article-setting" style="">
        <div class="popover fade in animated fadeInLeft" role="menu" id="popover100611" style="position: fixed; top: 91px; left: 76px; display: block; min-width: 500px;">
            <h3 class="popover-title">Article Setting</h3>
            <div class="popover-content">
                <div class="form-group">
                    <label>Meta Description</label>
                    {{ $form->getField('metadesc')->renderInput() }}
                </div>

                <div class="form-group">
                    <label>Author</label>
                    {{ $form->getField('author')->renderInput() }}
                </div>
@if ($type != 'static')
                <div class="form-group">
                    <label>Categories</label>
                    {{ $form->getField('category')->renderInput() }}
                </div>
@endif
                <div class="form-group">
                    <label>Publish</label>
                    {{ $form->getField('state')->renderInput() }}
                </div>
            </div>
        </div>
    </div>

    <div class="hidden-inputs">
        <input id="post-id" name="id" type="hidden" value="{{{ $item->id }}}"/>
    </div>

    <p align="center">
        Powered by <a href="http://about.asika.tw/fongshen-editor/" target="_blank">FongShen Editor</a> & <a href="http://ace.c9.io/" target="_blank">ACE</a>
    </p>
@stop


@section('script')

<script src="{{{ $uri['media.path'] }}}js/plugins/validate/jquery.validate.min.js"></script>

<script src="{{{ $uri['media.path'] }}}js/ace/src-min/ace.js"></script>
<script src="{{{ $uri['media.path'] }}}js/ace/src-min/ext-emmet.js"></script>
<script src="{{{ $uri['media.path'] }}}js/fongshen/editor/ace-adapter.js"></script>
<script src="{{{ $uri['media.path'] }}}js/fongshen/fongshen.js"></script>
<script src="{{{ $uri['media.path'] }}}js/uikit.min.js"></script>
<script src="{{{ $uri['media.path'] }}}js/components/sticky.min.js"></script>
<script src="{{{ $uri['media.path'] }}}js/markdown/js-markdown-extra.js"></script>
<script src="{{{ $uri['media.path'] }}}js/markdown/marked.min.js"></script>
<script src="{{{ $uri['media.path'] }}}js/inline-attachment/inline-attach.js"></script>
<script src="{{{ $uri['media.path'] }}}js/inline-attachment/ace.inline-attach.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.1.15/require.min.js"></script>
<script src="{{{ $uri['media.path'] }}}js/emmet/emmet.js"></script>
<script src="{{{ $uri['media.path'] }}}js/windspeaker-edit.js"></script>

{{-- Chosen --}}
<script src="{{{ $uri['media.path'] }}}js/plugins/chosen/chosen.jquery.js"></script>
<link href="{{{ $uri['media.path'] }}}css/plugins/chosen/chosen.css" rel="stylesheet">


<script>
jQuery(document).ready(function($)
{
    var editor = $('#windspeaker-editor');

    var updatePreview = function(string)
    {
        marked.setOptions({
            renderer: new marked.Renderer(),
            gfm: true,
            tables: true,
            breaks: true,
            pedantic: false,
            sanitize: false,
            smartLists: true,
            smartypants: false
        });

        string = string.replace(/(\<\!--\s*\{READMORE\}\s*--\>)/, '<hr class="system-readmore">');

        $(this.previewContainer).html(marked(string));
    };

    var options = {
        id: 'foo',
        namespace: 'bar',
        previewAjaxPath: null,
        previewContainer: '#preview-container',
        autoPreviewDelay: 0,
        previewHandler: updatePreview
        // buttons: FongshenMarkdownButtons
    };

    var aceOptions = {
        lang: 'markdown',
        wrap: true,
        theme: 'tomorrow'
    };

    var Fongshen = editor.fongshen(new AceAdapter(aceOptions), options);
    var editor = Fongshen.editor.ace;


    editor.renderer.setShowGutter(false);
    editor.setShowPrintMargin(false);

    // Emmet
    // editor.session.setMode("ace/mode/html");
    editor.setOption("enableEmmet", true);

    {{ WINDWALKER_DEBUG ? 'window.editor = ace;' : '' }}

    var heightUpdateFunction = function() {

        // http://stackoverflow.com/questions/11584061/
        var newHeight =
                  editor.getSession().getScreenLength()
                  * editor.renderer.lineHeight
                  + editor.renderer.scrollBar.getWidth();

        $('#windspeaker-editor').height(newHeight.toString() + "px");
        $('#editor-section').height(newHeight.toString() + "px");

        // This call is required for the editor to fix all of
        // its inner structure for adapting to a change in size
        editor.resize();
    };

    // Set initial size to match initial content
    heightUpdateFunction();

    // Whenever a change happens inside the ACE editor, update
    // the size again
    editor.getSession().on('change', heightUpdateFunction);

    // Attachment
    // -------------------------------------------------------------
    var attachOptions = {
        uploadUrl: '/upload',
        uploadFieldName: 'file',
        downloadFieldName: 'file',
        allowedTypes: [
            'image/jpeg',
            'image/png',
            'image/jpg',
            'image/gif'
        ],
        progressText: '![Uploading file...]()',
        urlText: "![file]({filename})",
        errorText: "Error uploading file",
        extraParams: {},
        extraHeaders: {},

        onReceivedFile: function(file) {},

        onUploadedFile: function(response) {
            setTimeout(function()
            {
                Fongshen.refreshPreview();
            }, 200);
        },

        customErrorHandler: function() { return true; },

        customUploadHandler: function(file) { return true; },

        customReponseParser: function(xhr) {
            return false;
        },

        uploadMethod: 'POST',

        dataProcessor: function(data) { return data; }
    };

    inlineAttach.attachToAce(editor, attachOptions);

    // Buttons
    Fongshen.registerButton($('#button-h1'), {
        name:'Heading 1',
        key:"1",
        openWith:'# ',
        placeHolder:'Title'
    });

    Fongshen.registerButton($('#button-h2'), {
        name:'Heading 2',
        key:"2",
        openWith:'## ',
        placeHolder:'Title'
    });

    Fongshen.registerButton($('#button-h3'), {
        name:'Heading 3',
        key:"3",
        openWith:'### ',
        placeHolder:'Title'
    });

    Fongshen.registerButton($('#button-h4'), {
        name:'Heading 4',
        key:"4",
        openWith:'#### ',
        placeHolder:'Title'
    });

    Fongshen.registerButton($('#button-h5'), {
        name:'Heading 5',
        key:"5",
        openWith:'##### ',
        placeHolder:'Title'
    });

    Fongshen.registerButton($('#button-h6'), {
        name:'Heading 6',
        key:"6",
        openWith:'###### ',
        placeHolder:'Title'
    });

    Fongshen.registerButton($('#button-strong'), {
        name:'Bold',
        key:"B",
        openWith:'**',
        closeWith:'**'}
    );

    Fongshen.registerButton($('#button-italic'), {
        name:'Italic',
        key:"I",
        openWith:'_',
        closeWith:'_'
    });

    Fongshen.registerButton($('#button-ul'), {
        name:'Bulleted List',
        openWith:'- ' ,
        multiline: true
    });

    Fongshen.registerButton($('#button-ol'), {
        name:'Numeric List',
        openWith: function(fongshen)
        {
            return fongshen.line + '. ';
        },
        multiline: true
    });

    Fongshen.registerButton($('#button-img'), {
        name:'Picture',
        key:"P",
        replaceWith: function(fongshen)
        {
            var value = '![' + fongshen.ask('Alternative text') + '](' + fongshen.ask('Url', 'http://');

            var title = fongshen.ask('Title');

            if (title !== '')
            {
                value += ' "' + title + '"';
            }

            value += ')';

            return value;
        }
    });

    Fongshen.registerButton($('#button-link'), {
        name:'Link',
        key:"L",
        openWith:'[',
        closeWith: function(fongshen)
        {
            return '](' + fongshen.ask('Url', 'http://') + ')';
        },
        placeHolder:'Click here to link...'
    });

    Fongshen.registerButton($('#button-quote'), {
        name:'Quotes',
        openWith:'> ',
        multiline: true
    });

    Fongshen.registerButton($('#button-codeblock'), {
        name:'Code Block / Code',
        openWith: function(fongshen)
        {
            return '``` ' + fongshen.ask('Language') + '\n';
        },
        closeWith:'\n```',
        afterInsert: function(fongshen)
        {
            fongshen.getEditor().moveCursor(-1, 0);
        }
    });

    Fongshen.registerButton($('#button-code'), {
        name:'Code Inline',
        openWith:'`',
        closeWith:'`',
        multiline: true,
        className: "code-inline"
    });

    Fongshen.registerButton($('#button-readmore'), {
        name:'Readmore',
        openWith:"\n<!-- {READMORE} -->\n",
        closeWith:'',
        className: "readmore"
    });

    Fongshen.registerButton($('#button-preview'), {
        name:'Preview',
        call:'createPreview',
        className:"preview"
    });

    // Change
    editor.on('change', function()
    {
        WindspeakerEdit.changed(true);
    });

    // Windspeaker
    WindspeakerEdit.confirmOnPageExit();
    WindspeakerEdit.prepareArticleSetting();

    // Chosen
    var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
    };
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

    // Validate
    var form = $('#adminForm');

    form.validate();

    // Push editor to WindspeakerEdit
    WindspeakerEdit.editor = editor;
});

</script>
@stop
