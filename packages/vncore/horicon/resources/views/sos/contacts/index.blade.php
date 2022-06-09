@extends('horicon::layouts.app')

@section('title', __('Câu hỏi'))

@section('content')

    <!-- .page-title-bar -->
    <header class="page-title-bar">
        <!-- title and toolbar -->
        <div class="d-flex align-items-start mb-2">
            <h1 class="page-title mr-auto">@lang('Câu hỏi')</h1>

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
                                <th>@lang('Câu hỏi')</th>
                                <th>@lang('Nội dung')</th>
                                <th>@lang('Người dùng')</th>
                                <th>@lang('Ngày tháng')</th>
                                <th style="min-width:100px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <!-- /thead -->

                        <!-- tbody -->
                        <tbody>
                            @foreach($contacts as $contact)
                                <!-- tr -->
                                <tr>
                                    <td>#{{ $contact->id }}</td>
                                    <td>{{ $contact->present()->title }}</td>
                                    <td>{{ str_limit($contact->present()->content) }}</td>

                                    <td>{{ $contact->user->present()->name }}</td>
                                    <td>{{ $contact->present()->updated_at->diffForHumans() }}</td>

                                    <td class="align-middle text-right">
                                        <a href="{{ $contact->url()->edit() }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                            <span class="sr-only">@lang('Edit')</span>
                                        </a>

                                        {!! Form::model($contact, ['url' => $contact->url()->destroy(), 'method' => 'delete', 'style' => 'display: inline', 'onsubmit' => 'return confirm("Bạn có chắc muốn xoá?")']) !!}
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
            {{ $contacts->appends(['q' => request('q')])->links() }}
            <!-- /.pagination -->
            </div>
            <!-- /.card-body -->
        </section>
        <!-- /.card -->
    </div>
    <!-- /.page-section -->

@endsection
