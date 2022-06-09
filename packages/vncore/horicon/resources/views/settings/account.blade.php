@extends('horicon::layouts.app')

@section('title', __('Account settings'))

@section('content')

    <!-- grid row -->
    <div class="row">
        <!-- grid column -->
        <div class="col-lg-3">
            @include('horicon::settings.shared.aside', ['active' => 'account'])
        </div>
        <!-- /grid column -->

        <!-- grid column -->
        <div class="col-lg-9">
            <!-- .card -->
            <div class="card card-fluid">
                <h3 class="card-header">@lang('Account settings')</h3>

                <!-- .card-body -->
                <div class="card-body">
                    {{ Form::flash() }}

                    <!-- form -->
                    {!! Form::open(['class' => '']) !!}
                        {{ Form::field('password', __('Current password'), 'old_password', ['required']) }}
                        {{ Form::field('password', __('New password'), 'password', ['required']) }}
                        {{ Form::field('password', __('Confirm new password'), 'password_confirmation', ['required']) }}

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
