@extends('horicon::layouts.app')

@section('title', __('Xem hỏi đáp'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.faqs.index') }}">
                            <i class="fa fa-home"></i> @lang('Hỏi đáp')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Xem hỏi đáp')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Hỏi đáp')</h1>
        </header>
        <!-- /.page-title-bar -->

        <!-- .page-section -->
        <div class="page-section">
            <!-- .card -->
            <section class="card">
                <!-- .card-body -->
                <div class="card-body">
                    <h3 class="mb-2">{{ $faq->title }}</h3>
                    <div class="mb-2">{!! nl2br(e($faq->content)) !!}</div>

                    <table class="table">
                        <tr>
                            <td class="font-bold">Trạng thái:</td>
                            <td><i class="fas fa-circle {{ $faq->status ? 'text-success' : 'text-info' }}"></i>{{ $faq->status ? __('Hoàn thành') : __('Mới') }}</td>
                            <td class="font-bold">Ngày tháng:</td>
                            <td>{{ $faq->created_at->toDateTimeString() }}</td>
                        </tr>
                    </table>

                    {{--<div class="card">--}}
                        {{--<div class="card-body">--}}
                            {{--<h4 class="mt-0 mb-3">Phản hồi ({{ $comments->total() }})</h4>--}}

                            {{--{{ Form::flash() }}--}}

                            {{--{!! Form::open(['url' => $faq->url()->storeComment, 'class' => '']) !!}--}}
                                {{--{{ Form::textarea('content', '', ['class' => 'form-control form-control-light mb-2', 'rows' => 3, 'required']) }}--}}
                                {{--<div class="text-right">--}}
                                    {{--<div class="btn-group mb-2">--}}
                                        {{--<button type="button" class="btn btn-link btn-sm text-muted font-18"><i class="dripicons-paperclip"></i></button>--}}
                                    {{--</div>--}}
                                    {{--<div class="btn-group mb-2 ml-2">--}}
                                        {{--<button type="submit" class="btn btn-primary btn-sm">@lang('Submit')</button>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--{!! Form::close() !!}--}}

                            {{--@foreach($comments as $comment)--}}
                                {{--<div class="media mb-6">--}}
                                    {{--{{ $comment->user->present()->avatar(['class' => 'mr-3 avatar-sm rounded-circle']) }}--}}
                                    {{--<div class="media-body">--}}
                                        {{--<h5 class="mt-0 mb-1">--}}
                                            {{--{{ $comment->user->present()->name }}--}}
                                            {{--<small>{{ $comment->created_at->diffForHumans() }}</small>--}}
                                        {{--</h5>--}}
                                        {{--{!! nl2br(e($comment->content)) !!}--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endforeach--}}
                            {{--{{ $comments->appends(['q' => request('q')])->links() }}--}}

                        {{--</div> <!-- end card-body-->--}}
                    {{--</div>--}}
                </div>
                <!-- /.card-body -->
            </section>
            <!-- /.card -->
        </div>
        <!-- /.page-section -->
    </div>
    <!-- /.page-inner -->

@endsection
