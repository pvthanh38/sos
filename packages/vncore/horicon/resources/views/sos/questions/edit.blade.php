@extends('horicon::layouts.app')

@section('title', __('Chỉnh câu hỏi'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.sos.questions.index') }}">
                            <i class="fa fa-home"></i> @lang('Câu hỏi')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Chỉnh câu hỏi')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Câu hỏi')</h1>
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
                    {!! Form::model($question, ['url' => $question->url()->update(), 'class' => '']) !!}
                        @method('PUT')

                        {{ Form::field('text', __('Câu hỏi'), 'title', ['required']) }}
                        {{ Form::field('area', __('Trả lời'), 'content', ['required', 'id' => 'content-container']) }}

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
