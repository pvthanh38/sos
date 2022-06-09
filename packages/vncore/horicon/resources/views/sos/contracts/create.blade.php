@extends('horicon::layouts.app')

@section('title', __('Thêm hợp đồng'))

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
                        @lang('Thêm hợp đồng')
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

                    <!-- form -->
                    {!! Form::open(['url' => $contract->url()->store, 'files' => 'true', 'class' => '']) !!}
                        {{ Form::field('select', __('Công ty'), 'company_id', ['required', 'select' => $companies]) }}
                        {{ Form::field('text', __('Mã hợp đồng'), 'code', ['required']) }}
                        {{ Form::field('file', __('File'), 'file', ['required']) }}

                        <div class="row">
                            <div class="col-sm-2 text-right">
                                <button class="btn btn-primary" id="addLocation">@lang('Add')</button>
                            </div>
                            <div class="col" id="locations"></div>
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

@push('scripts')
    <script type="text/javascript">
        var total = 1;
        var template = `
            <div class="row" id="location_TOTAL_">
                <div class="col">{{ Form::field('text', __('Lat'), 'location[_TOTAL_][lat]', ['required']) }}</div>
                <div class="col">{{ Form::field('text', __('Lng'), 'location[_TOTAL_][lng]', ['required']) }}</div>
                <div class="col"><a class="btn btn-danger removeLocation" data-id="_TOTAL_">@lang('Remove')</a></div>
            </div>
            <hr/>
        `;

        $(document).ready(function($) {
            $("#addLocation").click(function (e) {
                e.preventDefault();
                var contract = template.replace(new RegExp("_TOTAL_", 'g'), total);
                total++;
                $("#locations").append(contract);
            });

            $("#locations").on('click', '.removeLocation', function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                $("#location" + id).remove();
            });

            $("#addLocation").click();
        });
    </script>
@endpush
