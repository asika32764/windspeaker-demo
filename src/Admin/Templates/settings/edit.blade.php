{{-- Part of windspeaker project. --}}

@extends('admin-html')

@section('page_title')
Blog Settings
@stop

@section('main_content')
    <div class="row">
        <div class="col-md-12">

            <div id="blog-setting" class="ibox">
                <div id="tab-edit" class="tab-pane fade in active ibox-content">
                    <form action="{{{ $uri['base.current'] }}}" class="form-horizontal" method="post">
                        <h3>Basic Information</h3>

                        @foreach ($form->getFields('basic') as $field)
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
                        <button type="submit" class="btn btn-primary btn-lg">Save</button>

                        <input type="hidden" name="blog[id]" value="{{{ $item->id }}}"/>
                        <input type="hidden" name="_method" value="PUT"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
