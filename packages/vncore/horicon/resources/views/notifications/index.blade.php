@extends('horicon::layouts.app')

@section('title', __('Notifications'))

@section('content')

    <!-- .page-inner -->
    <div class="page-inner">
        <!-- .page-title-bar -->
        <header class="page-title-bar">
            <!-- title and toolbar -->
            <div class="d-flex align-items-start mb-2">
                <h1 class="page-title mr-auto">@lang('Notifications')</h1>

                <!-- .btn-toolbar -->
                <div class="btn-toolbar">
                    {!! Form::open(['route' => 'horicon.notifications.read_all', 'method' => 'post', 'style' => 'display: inline']) !!}
                        <button type="submit" class="btn btn-primary">
                            <span class="ml-1">@lang('Mark all as read')</span>
                        </button>
                    {!! Form::close() !!}
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
                    <!-- .table-responsive -->
                    <div class="table-responsive">
                        <!-- .table -->
                        <table class="table">
                            <!-- thead -->
                            <thead>
                                <tr>
                                    <th>@lang('Content')</th>
                                    <th>@lang('Read')</th>
                                    <th>@lang('Date')</th>
                                </tr>
                            </thead>
                            <!-- /thead -->

                            <!-- tbody -->
                            <tbody>
                                @foreach($notifications as $notification)
                                    <!-- tr -->
                                    <tr>
                                        <td>
                                            <img class="img-fluid" src="{{ $notification->notifiable->present()->avatar }}" alt="" />

                                            <a href="@include('horicon::notifications.apps.' . snake_case(class_basename($notification->type)) . '_url')">
                                                @include('horicon::notifications.apps.' . snake_case(class_basename($notification->type)))
                                            </a>
                                        </td>
                                        <td>
                                            <i class="fas fa-circle {{ $notification->read() ? 'text-success' : 'text-info' }}"></i>
                                            {{ $notification->read() ? __('READ') : __('UN-READ') }}
                                        </td>
                                        <td>{{ $notification->updated_at->diffForHumans() }}</td>
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
                    {{ $notifications->links() }}
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
