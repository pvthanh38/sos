@extends('horicon::layouts.app')

@section('title', __('Chỉnh hỗ trợ'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.sos.supports.index') }}">
                            <i class="fa fa-home"></i> @lang('Hỗ trợ')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Chỉnh hỗ trợ')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Hỗ trợ')</h1>
        </header>
        <!-- /.page-title-bar -->

        <!-- .page-section -->
        <div class="page-section">
            <!-- .card -->
            <section class="card">
                <!-- .card-body -->
                <div class="card-body">
                    {{ Form::flash() }}
                    {{ Form::wysiwyg() }}

                    <!-- form -->
                    {!! Form::model($support, ['url' => $support->url()->update(), 'class' => '']) !!}
                        @method('PUT')

                        <h3 class="mb-2">{{ $support->location }}</h3>
                        <iframe
                                width="100%"
                                height="400"
                                frameborder="0"
                                scrolling="no"
                                marginheight="0"
                                marginwidth="0"
                                src="https://maps.google.com/maps?q={{ $support->lat }},{{ $support->lng }}&hl=es;z=14&amp;output=embed"
                        >
                        </iframe>
                        <div>{!! nl2br(e($support->content)) !!}</div>

                        <div class="form-group row">
                            <label for="replay" class="col-form-label text-right col-sm-2">Trạng thái</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    {{ Form::radio('status', 1, null, ['class' => 'form-check-input', 'id' => 'status1']) }}
                                    <label class="form-check-label" for="status1">
                                        Hoàn thành
                                    </label>
                                </div>
                                <div class="form-check">
                                    {{ Form::radio('status', 0, null, ['class' => 'form-check-input', 'id' => 'status0']) }}
                                    <label class="form-check-label" for="status0">
                                        Mới tạo
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{--{{ Form::field('checkbox', __('Trạng thái'), 'status', []) }}--}}

                        {{ Form::field('wysiwyg', __('Phản hồi'), 'replay', ['id' => 'content-container']) }}

                        <hr>
                        <!-- .form-actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                        </div>
                        <!-- /.form-actions -->
                    {!! Form::close() !!}
                    <!-- /form -->
                </div>
                <!-- /.card-body -->
            </section>
            <!-- /.card -->
        </div>
        <!-- /.page-section -->
    </div>
    <!-- /.page-inner -->

@endsection
