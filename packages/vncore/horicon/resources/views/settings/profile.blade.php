@extends('horicon::layouts.app')

@section('title', __('Profile settings'))

@section('content')

    <!-- grid row -->
    <div class="row">
        <!-- grid column -->
        <div class="col-lg-3">
            @include('horicon::settings.shared.aside', ['active' => 'profile'])
        </div>
        <!-- /grid column -->

        <!-- grid column -->
        <div class="col-lg-9">
            <!-- .card -->
            <div class="card card-fluid">
                <h3 class="card-header">@lang('Profile settings')</h3>
                <!-- .card-body -->
                <div class="card-body">
                    {{ Form::flash() }}

                    <!-- form -->
                    {!! Form::model($user, ['files' => 'true', 'class' => '']) !!}
                        {{ Form::field('text', __('Name'), 'name', ['required']) }}
                        {{ Form::field('text', __('Title'), 'title', ['required']) }}
                        {{ Form::field('file', __('Avatar'), 'avatar', []) }}
                        {{ Form::field('text', __('Email'), 'email', ['required']) }}
                        {{ Form::field('select', __('Timezone'), 'timezone', ['required', 'select' => $timezones]) }}
                        {{ Form::field('area', __('Bio'), 'bio', []) }}

                        <hr>
                        <!-- .form-actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary ml-auto">@lang('Submit')</button>
                        </div>
                        <!-- /.form-actions -->
                    {!! Form::close() !!}
                    <!-- /form -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /grid column -->
    </div>
    <!-- /grid row -->

@endsection
