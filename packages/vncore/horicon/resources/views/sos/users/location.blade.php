@extends('horicon::layouts.app')

@section('title', __('Vị trí người lao động'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.sos.users.index') }}">
                            <i class="fa fa-home"></i> @lang('Người lao động')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Vị trí')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">{{ $sosUser->name }}</h1>
        </header>
        <!-- /.page-title-bar -->

        <!-- .page-section -->
        <div class="page-section">
            <!-- .card -->
            <section class="card">
                <!-- .card-body -->
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>@lang('Vị trí')</td>
                            <td>@lang('Quốc gia')</td>
                            <td>@lang('Thành phố')</td>
                            <td>@lang('Lat')</td>
                            <td>@lang('Lng')</td>
                            <td>@lang('Ngày tháng')</td>
                            <th style="min-width:100px;">&nbsp;</th>
                        </tr>
                        @foreach($locations as $location)
                            <tr>
                                <td>{{ $location->location }}</td>
                                <td>{{ $location->country }}</td>
                                <td>{{ $location->city }}</td>
                                <td>{{ $location->lat }}</td>
                                <td>{{ $location->lng }}</td>
                                <td>{{ $location->created_at->toDateTimeString() }}</td>
                                <td class="align-middle text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal{{ $location->id }}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal{{ $location->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bản đồ</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe
                                                            width="100%"
                                                            height="400"
                                                            frameborder="0"
                                                            scrolling="no"
                                                            marginheight="0"
                                                            marginwidth="0"
                                                            src="https://maps.google.com/maps?q={{ $location->lat }},{{ $location->lng }}&hl=es;z=14&amp;output=embed"
                                                    >
                                                    </iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $locations->appends(['q' => request('q')])->links() }}
                </div>
                <!-- /.card-body -->
            </section>
            <!-- /.card -->
        </div>
        <!-- /.page-section -->
    </div>
    <!-- /.page-inner -->

@endsection
