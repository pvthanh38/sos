@extends('horicon::layouts.app')

@section('title', __('Edit a category'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.blog.categories.index') }}">
                            <i class="fa fa-home"></i> @lang('Categories')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Edit a category')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Category')</h1>
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
                    {!! Form::model($category, ['url' => $category->url()->update, 'class' => '']) !!}
                        @method('PUT')
                        <div class="row">
                            <div class="col-7">
                                {{ Form::field('text', __('Title'), 'title', ['required']) }}
                                {{ Form::field('text', __('Slug'), 'slug', ['required']) }}
                                {{ Form::field('wysiwyg', __('Content'), 'content', ['id' => 'content-container']) }}
                                {{ Form::field('checkbox', __('Status'), 'status', []) }}
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
