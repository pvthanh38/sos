@extends('horicon::layouts.app')

@section('title', __('Người dùng'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <!-- title and toolbar -->
            <div class="d-flex align-items-start mb-2">
                <h1 class="page-title mr-auto">@lang('Người dùng')</h1>

                <!-- .btn-toolbar -->
                <div class="btn-toolbar">
                    <a href="{{ route('horicon.admin.users.create') }}">
                        <span class="ml-1">@lang('Thêm người dùng')</span>
                    </a>
                </div>
                <!-- /.btn-toolbar -->
            </div>
            <!-- /title and toolbar -->
        </header>
        <!-- /.page-title-bar -->

        <!-- .page-section -->
        <div class="page-section">
            <!-- .card -->
            <section class="card card-fluid">
                <!-- .card-body -->
                <div class="card-body">

                    <!-- .form-group -->
                    {!! Form::open([ 'method' => 'get', 'class' => '']) !!}
                        <div class="form-group">
                            <!-- .input-group -->
                            <div class="input-group input-group-alt">
                                <!-- .input-group -->
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <span class="fas fa-search"></span>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Tìm kiếm" name="q" value="{{ request('q') }}"/>
                                </div>
                                <!-- /.input-group -->
                            </div>
                            <!-- /.input-group -->
                        </div>
                    {!! Form::close() !!}
                    <!-- /.form-group -->

                    <!-- .table-responsive -->
                    <div class="table-responsive">
                        <!-- .table -->
                        <table class="table">
                            <!-- thead -->
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>@lang('Họ tên')</th>
                                    <th>@lang('Tên đăng nhập')</th>
                                    <th>@lang('Điện thoại')</th>
                                    <th>@lang('Quyền hạn')</th>
                                    <th>@lang('Ngày tháng')</th>
                                    <th style="min-width:100px;">&nbsp;</th>
                                </tr>
                            </thead>
                            <!-- /thead -->
                            <!-- tbody -->
                            <tbody>
                                @foreach($users as $user)
                                    <!-- tr -->
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->present()->name }}</td>
                                        <td>{{ $user->present()->email }}</td>
                                        <td>{{ $user->present()->phone }}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                <span class="badge badge-info">{{ $role->label }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $user->present()->updated_at }}</td>
                                        <td class="align-middle text-right">
                                            <a href="{{ $user->url()->edit }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-pencil-alt"></i>
                                                <span class="sr-only">@lang('Edit')</span>
                                            </a>

                                            {!! Form::model($user, ['url' => $user->url()->destroy, 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => 'return confirm("Bạn có chắc muốn xoá?")']) !!}
                                                <button type="submit" class="btn btn-sm btn-secondary">
                                                    <i class="far fa-trash-alt"></i>
                                                    <span class="sr-only">@lang('Remove')</span>
                                                </button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    <!-- /tr -->
                                @endforeach
                            </tbody>
                            <!-- /tbody -->
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.table-responsive -->
                    <!-- .pagination -->
                    {{ $users->appends(['q' => request('q')])->links() }}
                    <!-- /.pagination -->
                </div>
                <!-- /.card-body -->
            </section>
            <!-- /.card -->
        </div>
        <!-- /.page-section -->
    </div>
    <!-- /.page-inner -->

@endsection
