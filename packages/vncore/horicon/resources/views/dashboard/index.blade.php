@extends('horicon::layouts.app')

@section('title', __('Trang chủ'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <!-- title and toolbar -->
            <h1 class="page-title mb-2">
                @lang('Quản lý ứng dụng SOS')

                {!! Form::open(['method' => 'get', 'id' => 'searchForm', 'class' => 'float-right']) !!}
                    <div class="form-group">
                        <input class="form-control" type="text" name="daterange" readonly value="{{ date('mm/dd/YYYY', strtotime($startDate)) }} - {{ date('mm/dd/YYYY', strtotime($endDate)) }}" />
                    </div>
                {!! Form::close() !!}
                <div class="clearfix"></div>
            </h1>
            <!-- /title and toolbar -->
        </header>
        <!-- /.page-title-bar -->

        <!-- .page-section -->
        <div class="page-section">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="card widget-flat mb-6">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted font-weight-normal mt-0">@lang('Người lao động')</h5>
                                    <h3 class="mt-3 mb-3">{{ number_format($sosUsersCount) }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-lg-2">
                            <div class="card widget-flat mb-6">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-cart-plus widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted font-weight-normal mt-0">
                                        @lang('Số SOS')
                                        <a href="{{ route('horicon.cms.sos.supports.download', ['start' => $startDate, 'end' => $endDate]) }}" class="float-right"><i class="fas fa-download"></i></a>
                                    </h5>
                                    <h3 class="mt-3 mb-3">{{ number_format($supportsCount) }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-lg-2">
                            <div class="card widget-flat mb-6">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-cart-plus widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted font-weight-normal mt-0">
                                        @lang('Số đề nghị hỗ trợ')
                                        <a href="{{ route('horicon.cms.sos.supports.download', ['start' => $startDate, 'end' => $endDate, 'urgent' => 0]) }}" class="float-right"><i class="fas fa-download"></i></a>
                                    </h5>
                                    <h3 class="mt-3 mb-3">{{ number_format($supportsCount2) }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-lg-3">
                            <div class="card widget-flat mb-6">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted font-weight-normal mt-0">
                                        @lang('Số lao động sai vị trí')
                                        <a href="{{ route('horicon.cms.sos.users.wronglocation.download') }}" class="float-right"><i class="fas fa-download"></i></a>
                                    </h5>
                                    <h3 class="mt-3 mb-3">{{ number_format($mathLocationsCount) }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div>
                        <div class="col-lg-3">
                            <div class="card widget-flat mb-6">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted font-weight-normal mt-0">@lang('Số lượng người dùng ứng dụng')</h5>
                                    <h3 class="mt-3 mb-3">{{ number_format($installsCount) }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.page-section -->
    </div>
    <!-- /.page-inner -->

@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script type="application/javascript">
        $(document).ready(function ($) {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
//                $('#searchForm').submit();
            });

            $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                $('#searchForm').submit();
            });
        });
    </script>
@endpush
