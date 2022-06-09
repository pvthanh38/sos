@extends('horicon::layouts.app')

@section('title', __('Hỗ trợ'))

@section('content')

    <!-- .page-title-bar -->
    <header class="page-title-bar">
        <!-- title and toolbar -->
        <div class="d-flex align-items-start mb-2">
            <h1 class="page-title mr-auto">@lang('Hỗ trợ')</h1>

            <!-- .btn-toolbar -->
            <div class="btn-toolbar">

            </div>
            <!-- /.btn-toolbar -->
        </div>
        <!-- /title and toolbar -->
    </header>
    <!-- /.page-title-bar -->

    <!-- .page-section -->
    <div class="page-section">
        <div class="row">
            <div class="col-12">
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
                                        <th>@lang('Vị trí')</th>
                                        <th>@lang('Loại')</th>
                                        <th>@lang('Trạng thái')</th>
                                        <th>@lang('Người dùng')</th>
                                        <th>@lang('Ngày tháng')</th>
                                        <th style="min-width:100px;">&nbsp;</th>
                                    </tr>
                                </thead>
                                <!-- /thead -->

                                <!-- tbody -->
                                <tbody>
                                @foreach($supports as $support)
                                    <!-- tr -->
                                        <tr>
                                            <td>#{{ $support->id }}</td>
                                            <td>{{ $support->present()->location }}</td>
                                            <td>{!! $support->present()->urgent ? '<span class="text-danger">SOS</span>' : '<span class="text-info">Bình thường</span>' !!}</td>
                                            <td>
                                                @if($support->status == 0)
                                                    <i class="fas fa-circle text-info"></i> Mới
                                                @elseif($support->status == 1)
                                                    <i class="fas fa-circle text-success"></i> Hoàn thành
                                                @else
                                                    <i class="fas fa-circle text-warning"></i> Đang xử lý
                                                @endif
                                            </td>
                                            <td>{{ $support->user->present()->name }}</td>
                                            <td>{{ $support->present()->updated_at->diffForHumans() }}</td>

                                            <td class="align-middle text-right">
                                                <a href="{{ $support->url()->show() }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-eye"></i>
                                                    <span class="sr-only">@lang('Show')</span>
                                                </a>

                                                {{--<a href="{{ $support->url()->edit() }}" class="btn btn-sm btn-info">--}}
                                                    {{--<i class="fa fa-pencil-alt"></i>--}}
                                                    {{--<span class="sr-only">@lang('Edit')</span>--}}
                                                {{--</a>--}}

                                                {!! Form::model($support, ['url' => $support->url()->close(), 'method' => 'post', 'style' => 'display: inline', 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn đóng hỗ trợ này?")']) !!}
                                                <button type="submit" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-lock"></i>
                                                    <span class="sr-only">@lang('Close')</span>
                                                </button>
                                                {!! Form::close() !!}

                                                {!! Form::model($support, ['url' => $support->url()->destroy(), 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => 'return confirm("Bạn có chắc muốn xoá?")']) !!}
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
                        {{ $supports->appends(['q' => request('q')])->links() }}
                        <!-- /.pagination -->
                    </div>
                    <!-- /.card-body -->
                </section>
                <!-- /.card -->
            </div>
            {{--<div class="col-5">--}}
                {{--<section class="card card-fluid">--}}
                    {{--<div class="card-body">--}}
                        {{--<div id="support-content">Ấn xem để hiện nội dung</div>--}}
                    {{--</div>--}}
                {{--</section>--}}
            {{--</div>--}}
        </div>
    </div>
    <!-- /.page-section -->

@endsection

@push('scripts')
    <script type="application/javascript">
        $(document).ready(function ($) {
            $('.show-support').click(function(event) {
                event.preventDefault();
                var href = $(this).attr('href');
                $('#support-content').load(href);
            });
        });
    </script>
@endpush


