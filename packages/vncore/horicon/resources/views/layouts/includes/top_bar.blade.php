@push('scripts')
    <script type="text/javascript">
        $(document).ready(function ($) {
            function notifications() {
                $.ajax({
                    url: "{{ route('horicon.notifications.get_unread') }}",
                    type: "GET",
                    success: function (data) {
                        $("#notifications").html(data);
                    }
                });
                setTimeout(notifications, 300000);
            }
            //notifications();

            // $(".slimscroll").slimScroll();
        });
    </script>
@endpush

<div class="navbar-custom topnav-navbar">
    <div class="container-fluid">

        <!-- LOGO -->
        {{--<a href="{{ route('horicon.index') }}" class="topnav-logo">--}}
            {{--<span class="topnav-logo-lg">--}}
                {{--<img src="{{ asset('vendor/vncore/images/logo-dark.png') }}" />--}}
            {{--</span>--}}
            {{--<span class="topnav-logo-sm">--}}
                {{--<img src="{{ asset('vendor/vncore/images/logo_sm.png') }}" />--}}
            {{--</span>--}}
        {{--</a>--}}

        <ul class="list-unstyled topbar-right-menu float-right mb-0">
            <li class="dropdown notification-list">
                {{--<a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">--}}
                    {{--<i class="fas fa-bell noti-icon"></i>--}}
                    {{--<span class="noti-icon-badge"></span>--}}
                {{--</a>--}}

                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            <span class="float-right">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('read-all-form').submit();" class="text-dark">
                                <small>@lang('Clear All')</small>
                            </a>
                            </span> @lang('Notifications')
                        </h5>
                        <form id="read-all-form" action="{{ route('horicon.notifications.read_all') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>

                    <div class="slimscroll">
                        <div id="notifications"></div>
                    </div>

                    <!-- All-->
                    <a href="{{ Auth::user()->url()->notifications }}" class="dropdown-item text-center text-primary notify-item notify-all">@lang('View All')</a>
                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        {{--<img src="{{ Auth::user()->present()->avatar }}" alt="user-image" class="rounded-circle" />--}}
                        {{ Auth::user()->present()->avatar(['class' => 'rounded-circle']) }}
                    </span>

                    <span>
                        <span class="account-user-name">{{ Auth::user()->present()->name }}</span>
                        <span class="account-position">{{ Auth::user()->present()->title }}</span>
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <a href="{{ Auth::user()->url()->profile }}" class="dropdown-item notify-item">
                        <i class="fas fa-user-circle"></i>
                        <span>@lang('Profile')</span>
                    </a>

                    <!-- item-->
                    <a href="{{ Auth::user()->url()->account }}" class="dropdown-item notify-item">
                        <i class="fas fa-cogs"></i>
                        <span>@lang('Account')</span>
                    </a>

                    <!-- item-->
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>@lang('Logout')</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <a class="navbar-toggle" data-toggle="collapse" data-target="#topnav-menu-content">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
        <div class="app-search">
            {{--<form>--}}
                {{--<div class="input-group">--}}
                    {{--<input type="text" class="form-control" placeholder="Search...">--}}
                    {{--<span class="fas fa-search"></span>--}}
                    {{--<div class="input-group-append">--}}
                        {{--<button class="btn btn-primary" type="submit">Search</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</form>--}}
        </div>
    </div>
</div>