@forelse (Auth::user()->unreadNotifications as $notification)
    @include('horicon::notifications.apps.default')
@empty
    <a href="javascript:void(0);" class="dropdown-item notify-item">
        <p class="text-center">@lang('No data')</p>
    </a>
@endforelse