<!-- .nav -->
<div class="list-group">
    <div class="list-group-item list-group-item-action active uppercase">@lang('Personal settings')</div>
    <a href="{{ $user->url()->profile }}" class="list-group-item list-group-item-action {{ $active == 'profile' ? 'text-primary' : '' }}">@lang('Profile')</a>
    <a href="{{ $user->url()->account }}" class="list-group-item list-group-item-action {{ $active == 'account' ? 'text-primary' : '' }}">@lang('Account')</a>
</div>
<!-- /.nav -->