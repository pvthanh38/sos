@extends('horicon::layouts.app')

@section('title', __('Edit a post'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.blog.posts.index') }}">
                            <i class="fa fa-home"></i> @lang('Posts')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Edit a post')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Post')</h1>
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
                    {!! Form::model($post, ['url' => $post->url()->update, 'files' => 'true', 'class' => '']) !!}
                        @method('PUT')
                        <div class="row">
                            <div class="col-7">
                                {{ Form::field('select', __('Category'), 'category_id', ['required', 'select' => $categories]) }}
                                {{ Form::field('text', __('Title'), 'title', ['required']) }}
                                {{ Form::field('text', __('Slug'), 'slug', ['required']) }}
                                {{ Form::field('file', __('Image'), 'image', []) }}
                                {{ Form::field('area', __('Summary'), 'summary', ['rows' => 3]) }}
                                {{ Form::field('wysiwyg', __('Content'), 'content', ['id' => 'content-container']) }}
                                {{ Form::field('checkbox', __('Status'), 'status', [], true) }}
                            </div>
                            <div class="col">
                                {{ Form::field('area', __('Meta description'), 'meta_description', ['horizontal' => false, 'rows' => 3]) }}
                                {{ Form::field('text', __('Layout'), 'layout', ['horizontal' => false]) }}
                            </div>
                        </div>

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
