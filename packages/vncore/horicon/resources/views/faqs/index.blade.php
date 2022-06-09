@extends('horicon::layouts.app')

@section('title', __('Hỏi đáp'))

@section('content')

    <!-- .page-title-bar -->
    <header class="page-title-bar">
        <!-- title and toolbar -->
        <div class="d-flex align-items-start mb-2">
            <h1 class="page-title mr-auto">@lang('Hỏi đáp')</h1>

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
                                <th>@lang('Tiêu đề')</th>
                                <th>@lang('Nội dung')</th>
                                <th>@lang('Trạng thái')</th>
                                <th>@lang('Người dùng')</th>
                                <th>@lang('Ngày tháng')</th>
                                <th style="min-width:100px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <!-- /thead -->

                        <!-- tbody -->
                        <tbody>
                            @foreach($faqs as $faq)
                                <!-- tr -->
                                <tr>
                                    <td>#{{ $faq->id }}</td>
                                    <td>{{ $faq->present()->title }}</td>
                                    <td>{{ str_limit($faq->present()->content) }}</td>
                                    <td>
                                        <i class="fas fa-circle {{ $faq->status ? 'text-success' : 'text-info' }}"></i>
                                        {{ $faq->status ? __('Hoàn thành') : __('Mới') }}
                                    </td>
                                    <td>{{ $faq->user->present()->name }}</td>
                                    <td>{{ $faq->present()->updated_at->diffForHumans() }}</td>

                                    <td class="align-middle text-right">
                                        {{--@can('update', $faq)--}}
                                            <a href="{{ $faq->url()->show() }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                                <span class="sr-only">@lang('Edit')</span>
                                            </a>

                                            <a href="{{ $faq->url()->edit() }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-pencil-alt"></i>
                                                <span class="sr-only">@lang('Edit')</span>
                                            </a>

                                            {!! Form::model($faq, ['url' => $faq->url()->destroy(), 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => 'return confirm("Do you really want to submit the form?")']) !!}
                                                <button type="submit" class="btn btn-sm btn-secondary">
                                                    <i class="far fa-trash-alt"></i>
                                                    <span class="sr-only">@lang('Remove')</span>
                                                </button>
                                            {!! Form::close() !!}
                                        {{--@endcan--}}
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
            {{ $faqs->appends(['q' => request('q')])->links() }}
            <!-- /.pagination -->
            </div>
            <!-- /.card-body -->
        </section>
        <!-- /.card -->
    </div>
    <!-- /.page-section -->

@endsection
