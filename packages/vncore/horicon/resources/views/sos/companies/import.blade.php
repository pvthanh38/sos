@extends('horicon::layouts.app')

@section('title', __('Nhập công ty'))

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
                        @lang('Nhập công ty')
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
                    {!! Form::open(['route' => 'horicon.cms.sos.companies.import.store', 'files' => 'true', 'class' => '']) !!}
                        {{ Form::field('file', __('File'), 'file', ['required']) }}

                        <div class="form-group row">
                            <label for="file" class="col-form-label text-right col-sm-2"></label>

                            <div class="col-sm-10">
                                <a href="/imports/companies.xlsx">File mẫu excel</a>
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
