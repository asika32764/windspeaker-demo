{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('page_title')
Author Edit
@stop

@section('main_content')
    <div class="row">
        <div class="col-md-12">

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

                        <input type="hidden" name="author[id]" value="{{{ $item->id }}}"/>
                        <input type="hidden" name="_method" value="PUT"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
