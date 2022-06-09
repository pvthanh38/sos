@extends('horicon::layouts.app')

@section('title', __('Posts'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <!-- title and toolbar -->
            <div class="d-flex align-items-start mb-2">
                <h1 class="page-title mr-auto">@lang('Posts')</h1>

                <!-- .btn-toolbar -->
                <div class="btn-toolbar">
                    <a href="{{ route('horicon.cms.blog.posts.create') }}">
                        <span class="ml-1">@lang('Add post')</span>
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
                                    <th>@lang('Image')</th>
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
                                @foreach($posts as $post)
                                    <!-- tr -->
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->present()->image(['class' => 'rounded', 'width' => 200]) }}</td>
                                        <td>{{ $post->present()->title }}</td>
                                        <td>{{ $post->present()->slug }}</td>
                                        <td>
                                            @if($post->isActive())
                                                <span class="badge badge-primary">@lang('ACTIVE')</span>
                                            @else
                                                <span class="badge badge-danger">@lang('UN-ACTIVE')</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->present()->updated_at }}</td>
                                        <td class="text-right">
                                            <a href="{{ $post->url()->edit }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-pencil-alt"></i>
                                                <span class="sr-only">@lang('Edit')</span>
                                            </a>

                                            {!! Form::model($post, ['url' => $post->url()->destroy, 'method' => 'delete', 'style' => 'display: inline']) !!}
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
                    {{ $posts->appends(['q' => request('q')])->links() }}
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
