@extends('horicon::layouts.app')

@section('title', __('Thêm người dùng'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.admin.users.index') }}">
                            <i class="fa fa-home"></i> @lang('Người dùng')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Thêm người dùng')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Người dùng')</h1>
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
                    {!! Form::open(['url' => Auth::user()->url()->store, 'class' => '']) !!}
                        {{ Form::field('text', __('Họ tên'), 'name', ['required']) }}
                        {{ Form::field('text', __('E-mail'), 'email', ['required']) }}
                        {{ Form::field('text', __('Số điện thoại'), 'phone', []) }}
                        {{ Form::field('text', __('Mật khẩu'), 'password', ['required']) }}
                        {{ Form::field('select', __('Quyền hạn'), 'roles[]', ['required', 'multiple', 'select' => $roles]) }}

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
