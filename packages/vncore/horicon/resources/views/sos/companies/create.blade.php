@extends('horicon::layouts.app')

@section('title', __('Thêm công ty'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.sos.companies.index') }}">
                            <i class="fa fa-home"></i> @lang('Công ty')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Thêm công ty')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Công ty')</h1>
        </header>
        <!-- /.page-title-bar -->

        <!-- .page-section -->
        <div class="page-section">
            <!-- .card -->
            <section class="card">
                <!-- .card-body -->
                <div class="card-body">
                    {{ Form::flash() }}

                    <!-- form -->
                    {!! Form::open(['url' => $company->url()->store, 'class' => '']) !!}
                        {{ Form::field('text', __('Mã công ty'), 'code', ['required']) }}
                        {{ Form::field('text', __('Tên công ty'), 'name', ['required']) }}
                        {{ Form::field('area', __('Mô tả'), 'desc', []) }}

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
