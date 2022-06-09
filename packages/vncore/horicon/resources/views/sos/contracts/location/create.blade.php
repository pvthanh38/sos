@extends('horicon::layouts.app')

@section('title', __('Add a location'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.sos.contracts.index') }}">
                            <i class="fa fa-home"></i> @lang('Contracts')
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ $contract->url()->edit }}">
                            #{{ $contract->id }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Add a location')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Location')</h1>
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
                    {!! Form::open(['route' => ['horicon.cms.sos.contracts.store.location', $contract], 'class' => '']) !!}
                        {{ Form::field('text', __('Lat'), 'lat', ['required']) }}
                        {{ Form::field('text', __('Lng'), 'lng', ['required']) }}

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