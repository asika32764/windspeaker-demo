{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('page_title')
Author Edit
@stop

@section('main_content')
    <div class="row">
        <div class="col-md-8 information-col">

            <div id="author-edit" class="ibox">
                <div id="tab-edit" class="tab-pane fade in active ibox-content">
                    <form action="{{{ $uri['base.current'] }}}" class="form-horizontal" method="post">
                        <h3>Author Information</h3>

                        @foreach ($form->getFields('author') as $field)
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
                        <div class="hr-line-dashed"></div>
                        @endforeach

                        <button type="submit" class="btn btn-primary btn-lg">Save</button>

                        {{ $form->getField('uuid')->renderInput() }}
                        <input type="hidden" name="author[image]" id="author-image"/>
                        <input type="hidden" name="author[id]" id="item-id" value="{{{ $item->id }}}"/>
                        <input type="hidden" name="_method" value="PUT"/>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 image-col">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Author Image</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <img alt="image" id="image-preview" class="img-responsive" src="{{{ $avatar }}}">
                    </div>
                    <div class="ibox-content author-content">
                        <div class="user-button">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" id="upload-btn" class="btn btn-primary btn-sm btn-block"><i class="fa fa-cloud-upload"></i> Upload</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" id="delete-btn" class="btn btn-default btn-sm btn-block"><i class="fa fa-trash"></i> Delete</button>
                                </div>
                                <input type="file" name="image_file" id="image-file" class="hide"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script src="{{{ $uri['media.path'] . 'js/upload/single-img-upload.js' }}}"></script>

<script>
var options = {
    action: '{{{ \Windwalker\Core\Router\Router::buildHtml('admin:author_image') }}}',
    success: function(response)
    {
        $('#author-uuid').val(response.uuid);
        $('#author-image').val(response.file);
    }
};

SingleImageUpload.init(options);
</script>
@stop
