{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('page_title')
Profile Edit
@stop

@section('main_content')
    <div class="row">
        <div class="col-md-8">

            <div id="author-edit" class="ibox">
                <div id="tab-edit" class="tab-pane fade in active ibox-content">
                    <form action="{{{ $uri['base.current'] }}}" class="form-horizontal" method="post">
                        <h3>User Information</h3>

                        @foreach ($form->getFields() as $field)
                        <div class="form-group">
                            {{ $field->renderLabel(); }}

                            <div class="col-sm-6 controls">
                                 {{ $field->renderInput(); }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        @endforeach

                        <button type="submit" class="btn btn-primary btn-lg">Save</button>

                        <input type="hidden" name="user[id]" id="user-id" value="{{{ $item->id }}}"/>
                        <input type="hidden" name="_method" value="PUT"/>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile Image</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <img alt="image" id="profile-image" class="img-responsive" src="{{{ $avatar }}}">
                    </div>
                    <div class="ibox-content profile-content">
                        <div class="user-button">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" id="upload_btn" class="btn btn-primary btn-sm btn-block"><i class="fa fa-cloud-upload"></i> Upload</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" id="delete_btn" class="btn btn-default btn-sm btn-block"><i class="fa fa-trash"></i> Delete</button>
                                </div>
                                <input type="file" name="profile_image" id="profile_image" class="hide"/>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </div>
    </div>
@stop

@section('script')
<script>
var options = {
    action: '{{{ \Windwalker\Core\Router\Router::buildHtml('admin:profile_image') }}}',
    delAction: '{{{ \Windwalker\Core\Router\Router::buildHtml('admin:profile_image') }}}'
};

var Profile = {
    init: function(options)
    {
        this.fileInput = $('#profile_image');
        this.uploadButton = $('#upload_btn');
        this.deleteButton = $('#delete_btn');
        this.image = $('#profile-image');

        this.options = options;

        this.registerEvents();
    },

    registerEvents: function()
    {
        var self = this;

        this.uploadButton.on('click', function(e)
        {
            self.fileInput.click();
        });

        // Upload
        this.fileInput.on('change', function(e)
        {
            var xhr = new XMLHttpRequest();

            var formData = new FormData;

            formData.append('file', self.fileInput[0].files[0]);
            formData.append('id', $('#user-id').val());

            xhr.addEventListener("load", function(ev)
            {
                var response = eval("(" + ev.target.responseText + ")");

                if (response.error)
                {
                    console.log('Upload fail');

                    return;
                }

                self.image.attr('src', response.file);

                Pace.restart();
            }, false);

//            xhr.upload.addEventListener("progress", function(ev) {
//                settings.OnProgress(ev.loaded, ev.total);
//            }, false);

            xhr.open("POST", self.options.action, true);
            xhr.send(formData);
        });

        // Delete
        this.deleteButton.on('click', function()
        {
            Pace.restart();

            $.ajax({
                url: self.options.action,
                type: 'DELETE',
                success: function(res)
                {
                    if (!res.error)
                    {
                        self.image.attr('src', res.image);
                    }
                }
            });
        });
    }
};

Profile.init(options);
</script>
@stop
