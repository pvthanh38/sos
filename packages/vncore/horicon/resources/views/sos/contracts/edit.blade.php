@extends('horicon::layouts.app')

@section('title', __('Chỉnh hợp đồng'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.sos.contracts.index') }}">
                            <i class="fa fa-home"></i> @lang('Hợp đồng')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Chỉnh hợp đồng')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Hợp đồng')</h1>
        </header>
        <!-- /.page-title-bar -->

        <!-- .page-section -->
        <div class="page-section">
            <!-- .card -->
            <section class="card">
                <!-- .card-body -->
                <div class="card-body">
                    {{ Form::flash() }}
                    {{ Form::errors() }}

                    <!-- form -->
                    {!! Form::model($contract, ['url' => $contract->url()->update, 'files' => 'true', 'class' => '']) !!}
                        @method('PUT')

                        {{ Form::field('select', __('Công ty'), 'company_id', ['required', 'select' => $companies]) }}
                        {{ Form::field('text', __('Mã hợp đồng'), 'code', ['required']) }}
                        {{ Form::field('file', __('File'), 'file', []) }}

                        <div class="row">
                            <div class="col-sm-2 text-right">
                                <a class="btn btn-primary" href="{{ route('horicon.cms.sos.contracts.create.location', $contract) }}">@lang('Add')</a>
                            </div>
                            <div class="col" id="locations">
                                @foreach($contract->locations as $location)
                                    <div class="row" id="location{{ $location->id }}">
                                        <div class="col">{{ Form::field('text', __('Lat'), 'location['. $location->id .'][lat]', ['required'], $location->lat) }}</div>
                                        <div class="col">{{ Form::field('text', __('Lng'), 'location['. $location->id .'][lng]', ['required'], $location->lng) }}</div>
                                        <div class="col"><a class="btn btn-danger removeLocation" onclick="return confirm('Are you sure?')" href="{{ route('horicon.cms.sos.contracts.destroy.location', $location) }}">@lang('Remove')</a></div>
                                    </div>
                                    <hr/>
                                @endforeach
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
