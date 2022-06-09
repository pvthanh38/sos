@extends('horicon::layouts.app')

@section('title', __('Nguời lao động'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <!-- title and toolbar -->
            <div class="d-flex align-items-start mb-2">
                <h1 class="page-title mr-auto">@lang('Nguời lao động')</h1>

                <!-- .btn-toolbar -->
                <div class="btn-toolbar">
                    <a href="{{ route('horicon.cms.sos.users.import') }}">
                        <span class="ml-1">@lang('Nhập người lao động')</span>
                    </a>
                    <span class="mx-2">-</span>
                    <!--
                    In case of error in exporting users, can disable this menu.
                    -->
                    <a href="{{ route('horicon.cms.sos.users.export') }}" class="btn-group">
                        <span class="ml-1">@lang('Xuất người lao động')</span>
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
                                    <th>@lang('Hộ chiếu')</th>
                                    <th>@lang('Họ tên')</th>
                                    <th>@lang('Giới tính')</th>
                                    <th>@lang('Điện thoại')</th>
                                    <th>@lang('Ngày sinh')</th>
                                    <th>@lang('Hợp đồng')</th>
                                    <th>@lang('Phạm vi')</th>
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
                                        <td>{{ $user->social_id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->gender ? 'Male' : 'Female' }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->birthday }}</td>
                                        <td>{{ $user->contract->code }}</td>
                                        <td>
                                            <i class="fas fa-circle {{ $user->match_location ? 'text-success' : 'text-danger' }}"></i>
                                            {{ $user->match_location ? __('Trong') : __('Ngoài') }}
                                        </td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td class="align-middle text-right">
                                            <a href="{{ route('horicon.cms.sos.users.location', $user) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span class="sr-only">@lang('View')</span>
                                            </a>

                                            {!! Form::model($user, ['route' => ['horicon.cms.sos.users.destroy', $user], 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => 'return confirm("Bạn có chắc muốn xoá?")']) !!}
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
