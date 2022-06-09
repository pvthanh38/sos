@extends('horicon::layouts.app')

@section('title', __('Xuất người lao động'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <!-- title and toolbar -->
            <div class="d-flex align-items-start mb-2">
                <h1 class="page-title mr-auto">@lang('Người lao động')</h1>

                <!-- .btn-toolbar -->
                <div class="btn-toolbar">
                    <a href="{{ route('horicon.cms.sos.users.export.download', ['lat' => request('lat'), 'lng' => request('lng'), 'distance' => request('distance'), 'country' => request('country'), 'city' => request('city')]) }}">
                        <span class="ml-1">@lang('Tải về')</span>
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
                                    <th>@lang('Ngày tháng')</th>
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
                                        <td>{{ optional($user->contract)->code }}</td>
                                        <td>{{ $user->updated_at }}</td>
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
                    {{ $users->appends(['lat' => request('lat'), 'lng' => request('lng'), 'distance' => request('distance'), 'country' => request('country'), 'city' => request('city')])->links() }}
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
