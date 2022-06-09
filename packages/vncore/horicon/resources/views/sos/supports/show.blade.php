@extends('horicon::layouts.app')

@section('title', __('Xem hỗ trợ'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('horicon.cms.sos.supports.index') }}">
                            <i class="fa fa-home"></i> @lang('Hỗ trợ')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Xem hỗ trợ')
                    </li>
                </ol>
            </nav>
            <h1 class="page-title mb-2">@lang('Hỗ trợ')</h1>
        </header>
        <!-- /.page-title-bar -->

        <!-- .page-section -->
        <div class="page-section">
            <!-- .card -->
            <section class="card">
                <!-- .card-body -->
                <div class="card-body">

                    <h3 class="mb-2">{{ $support->location }}</h3>
                    <table class="table">
                        <tr>
                            <td class="font-bold">Điện thoại:</td>
                            <td>{{ $support->phone }}</td>
                            <td class="font-bold">Ngày tháng:</td>
                            <td>{{ $support->created_at->toDateTimeString() }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Trạng thái:</td>
                            <td>
                                @if($support->status == 0)
                                    <i class="fas fa-circle text-info"></i> Mới
                                @elseif($support->status == 1)
                                    <i class="fas fa-circle text-success"></i> Hoàn thành
                                @else
                                    <i class="fas fa-circle text-warning"></i> Đang xử lý
                                @endif
                            </td>
                            <td class="font-bold">Loại hỗ trợ:</td>
                            <td><i class="fas fa-circle {{ $support->urgent ? 'text-danger' : 'text-info' }}"></i>{{ $support->urgent ? __('SOS') : __('Bình thường') }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Tên vị trí:</td>
                            <td>{!! $support->location !!}</td>
                            <td class="font-bold">Nội dung:</td>
                            <td>{!! nl2br(e($support->content)) !!}</td>
                        </tr>
                    </table>

                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="flex">
                                <h4 class="w-1/2 pl-4">Phản hồi ({{ $conversations->total() }})</h4>
                                <h4 class="w-1/2 pl-4">Phản hồi nội bộ ({{ $conversationsAdmin->total() }})</h4>
                            </div>
                            <div class="pl-4 pt-4">
                                {{ Form::flash() }}
                                {{ Form::errors() }}
                            </div>
                            <div class="flex">
                                <div class="w-1/2 p-4">
                                    {!! Form::open(['url' => $support->url()->storeComment, 'files' => true, 'class' => '']) !!}
                                    {{ Form::textarea('content', '', ['class' => 'form-control form-control-light mb-2', 'rows' => 3, 'required']) }}
                                    {{ Form::file('media', []) }}

                                    <div class="text-right">
                                        <div class="btn-group mb-2">
                                            <button type="button" class="btn btn-link btn-sm text-muted font-18"><i class="dripicons-paperclip"></i></button>
                                        </div>
                                        <div class="btn-group mb-2 ml-2">
                                            <button type="submit" class="btn btn-primary btn-sm">@lang('Submit')</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}

                                    @foreach($conversations as $conversation)
                                            <?php
                                            $user = $conversation->admin_id ? $conversation->admin : $support->user;
                                            ?>
                                            <div class="media mb-6">
                                                {{ $user->present()->avatar(['class' => 'mr-3 avatar-sm rounded-circle', 'width' => '150']) }}
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-1">
                                                        {{ $user->present()->name }}
                                                        <small>{{ $conversation->created_at->diffForHumans() }}</small>
                                                    </h5>
                                                    {!! nl2br(e($conversation->content)) !!}

                                                    @if($conversation->present()->image)
                                                        <br/>
                                                        <img src="{{ $conversation->present()->image }}" style="max-width: 500px; min-width: 250px;"/>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                </div>
                                <div class="w-1/2 p-4">
                                    {!! Form::open(['url' => $support->url()->storeAdminComment, 'files' => true, 'class' => '']) !!}
                                    {{ Form::textarea('content', '', ['class' => 'form-control form-control-light mb-2', 'rows' => 3, 'required']) }}
                                    {{ Form::file('media', []) }}

                                    <div class="text-right">
                                        <div class="btn-group mb-2">
                                            <button type="button" class="btn btn-link btn-sm text-muted font-18"><i class="dripicons-paperclip"></i></button>
                                        </div>
                                        <div class="btn-group mb-2 ml-2">
                                            <button type="submit" class="btn btn-primary btn-sm">@lang('Submit')</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}

                                    @foreach($conversationsAdmin as $conversation)
                                        <?php
                                        $user = $conversation->admin_id ? $conversation->admin : $support->user;
                                        ?>
                                        <div class="media mb-6">
                                            {{ $user->present()->avatar(['class' => 'mr-3 avatar-sm rounded-circle', 'width' => '150']) }}
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-1">
                                                    {{ $user->present()->name }}
                                                    <small>{{ $conversation->created_at->diffForHumans() }}</small>
                                                </h5>
                                                {!! nl2br(e($conversation->content)) !!}

                                                @if($conversation->present()->image)
                                                    <br/>
                                                    <img src="{{ $conversation->present()->image }}" style="max-width: 500px; min-width: 250px;"/>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{ $conversations->appends(['q' => request('q')])->links() }}

                            <iframe
                                    width="100%"
                                    height="400"
                                    frameborder="0"
                                    scrolling="no"
                                    marginheight="0"
                                    marginwidth="0"
                                    src="https://maps.google.com/maps?q={{ $support->lat }},{{ $support->lng }}&hl=es;z=14&amp;output=embed"
                            >
                            </iframe>
                        </div> <!-- end card-body-->
                    </div>
                </div>
                <!-- /.card-body -->
            </section>
            <!-- /.card -->
        </div>
        <!-- /.page-section -->
    </div>
    <!-- /.page-inner -->

@endsection
