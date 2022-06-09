@extends('horicon::layouts.app')

@section('title', __('Chỉnh hỏi đáp'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.faqs.index') }}">
                            <i class="fa fa-home"></i> @lang('Hỏi đáp')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Chỉnh hỏi đáp')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Hỏi đáp')</h1>
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
                    {!! Form::model($faq, ['url' => $faq->url()->update(), 'class' => '']) !!}
                        @method('PUT')

                        <h3 class="mb-2">{{ $faq->title }}</h3>
                        <div>{!! nl2br(e($faq->content)) !!}</div>

                        {{ Form::field('checkbox', __('Trạng thái'), 'status', []) }}
                        {{ Form::field('wysiwyg', __('Phản hồi'), 'replay', ['required', 'id' => 'content-container']) }}

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
