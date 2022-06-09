@extends('horicon::layouts.app')

@section('title', __('Xuất người lao động'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.sos.users.index') }}">
                            <i class="fa fa-home"></i> @lang('Người lao động')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Xuất người lao động')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Xuất người lao động')</h1>
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
                    {!! Form::open(['route' => 'horicon.cms.sos.users.export.store', 'class' => '', 'method' => 'get']) !!}
                        {{ Form::field('text', __('Lat'), 'lat', ['']) }}
                        {{ Form::field('text', __('Lng'), 'lng', ['']) }}
                        {{ Form::field('text', __('Khoảng cách (Tính xem Km)'), 'distance', ['']) }}

                        {{ Form::field('text', __('Quốc gia'), 'country', ['']) }}
                        {{ Form::field('text', __('Thành phố'), 'city', ['']) }}

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
