@extends('horicon::layouts.app')

@section('title', __('Categories'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <!-- title and toolbar -->
            <div class="d-flex align-items-start mb-2">
                <h1 class="page-title mr-auto">@lang('Categories')</h1>

                <!-- .btn-toolbar -->
                <div class="btn-toolbar">
                    <a href="{{ route('horicon.cms.blog.categories.create') }}">
                        <span class="ml-1">@lang('Add category')</span>
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
                                    <input type="text" class="form-control" placeholder="Search record" name="q" value="{{ request('q') }}"/>
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
                                    <th>@lang('Title')</th>
                                    <th>@lang('Slug')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Date')</th>
                                    <th style="min-width:100px;">&nbsp;</th>
                                </tr>
                            </thead>
                            <!-- /thead -->
                            <!-- tbody -->
                            <tbody>
                                @foreach($categories as $category)
                                    <!-- tr -->
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->present()->title }}</td>
                                        <td>{{ $category->present()->slug }}</td>
                                        <td>
                                            @if($category->isActive())
                                                <span class="badge badge-primary">@lang('ACTIVE')</span>
                                            @else
                                                <span class="badge badge-danger">@lang('UN-ACTIVE')</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->present()->updated_at }}</td>
                                        <td class="align-middle text-right">
                                            <a href="{{ $category->url()->edit }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-pencil-alt"></i>
                                                <span class="sr-only">@lang('Edit')</span>
                                            </a>

                                            {!! Form::model($category, ['url' => $category->url()->destroy, 'method' => 'delete', 'style' => 'display: inline']) !!}
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
                    {{ $categories->appends(['q' => request('q')])->links() }}
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
