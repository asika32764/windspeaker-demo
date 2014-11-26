{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('main_content')
<div class="ibox float-e-margins">
	<div class="ibox-content no-padding">

	    <div class="editor-toolbar btn-toolbar"  data-uk-sticky>
	        <div class="btn-group">
                <button id="button-h1" class="btn btn-default btn-white  btn-sm">H1</button>
                <button id="button-h2" class="btn btn-default btn-white  btn-sm">H2</button>
                <button id="button-h3" class="btn btn-default btn-white  btn-sm">H3</button>
                <button id="button-h4" class="btn btn-default btn-white  btn-sm">H4</button>
                <button id="button-h5" class="btn btn-default btn-white  btn-sm">H5</button>
            </div>

            <div class="btn-group">
                <button id="button-strong" class="btn btn-default btn-white  btn-sm">B</button>
                <button id="button-italic" class="btn btn-default btn-white  btn-sm"><em>I</em></button>
            </div>

            <div class="btn-group">
                <button id="button-ul" class="btn btn-default btn-white  btn-sm">ul</button>
                <button id="button-ol" class="btn btn-default btn-white  btn-sm">ol</button>
            </div>

            <div class="btn-group">
                <button id="button-img" class="btn btn-default btn-white  btn-sm">Img</button>
                <button id="button-link" class="btn btn-default btn-white  btn-sm">Link</button>
            </div>

            <div class="btn-group">
                <button id="button-quote" class="btn btn-default btn-white  btn-sm">Quote</button>
                <button id="button-codeblock" class="btn btn-default btn-white  btn-sm">Code Block</button>
                <button id="button-code" class="btn btn-default btn-white  btn-sm">Code Inline</button>
            </div>

            <div class="btn-group">
                <button id="button-preview" class="btn btn-success btn-sm">Preview</button>
            </div>
	    </div>

		<div class="row editor-inner">
            <div class="col-md-6 editor-col">
                <fieldset>
                    <!-- Editor -->
                    <div id="windspeaker-editor" class="" style="height: 500px;">{{{ $item->text }}}</div>
                    <p align="center">Pull to resize</p>
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
@stop


@section('script')
<script src="{{{ $uri['media.path'] }}}js/ace/src-min/ace.js"></script>
<script src="{{{ $uri['media.path'] }}}js/fongshen/editor/ace-adapter.js"></script>
<script src="{{{ $uri['media.path'] }}}js/fongshen/fongshen.js"></script>
<script src="{{{ $uri['media.path'] }}}js/uikit.min.js"></script>
<script src="{{{ $uri['media.path'] }}}js/components/sticky.min.js"></script>
<script src="{{{ $uri['media.path'] }}}js/markdown/js-markdown-extra.js"></script>
<script src="{{{ $uri['media.path'] }}}js/markdown/marked.min.js"></script>
<script src="{{{ $uri['media.path'] }}}js/inline-attachment/inline-attach.js"></script>
<script src="{{{ $uri['media.path'] }}}js/inline-attachment/ace.inline-attach.js"></script>

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

        console.log(string);

        string = string.replace(/&amp;/g, "&").
            replace(/&lt;/g, "<").
            replace(/&gt;/g, ">").
            replace(/&quot;/g, "\"").
            replace(/&#39;/g, "'");

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
    var ace = Fongshen.editor.ace;

    ace.renderer.setShowGutter(false);
    ace.setShowPrintMargin(false);

    var heightUpdateFunction = function() {

        // http://stackoverflow.com/questions/11584061/
        var newHeight =
                  ace.getSession().getScreenLength()
                  * ace.renderer.lineHeight
                  + ace.renderer.scrollBar.getWidth();

        $('#windspeaker-editor').height(newHeight.toString() + "px");
        $('#editor-section').height(newHeight.toString() + "px");

        // This call is required for the editor to fix all of
        // its inner structure for adapting to a change in size
        ace.resize();
    };

    // Set initial size to match initial content
    heightUpdateFunction();

    // Whenever a change happens inside the ACE editor, update
    // the size again
    ace.getSession().on('change', heightUpdateFunction);

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

    inlineAttach.attachToAce(ace, attachOptions);

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

    Fongshen.registerButton($('#button-preview'), {
        name:'Preview',
        call:'createPreview',
        className:"preview"
    });
});
</script>
@stop
