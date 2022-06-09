<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">
            <div class="navbar-collapse active collapse show" id="topnav-menu-content" style="">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a href="{{ route('horicon.index') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt mr-1"></i> @lang('Trang chủ')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('horicon.cms.sos.notifications.index') }}" class="nav-link">
                            <i class="fas fa-bell mr-1"></i> @lang('Thông báo')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('horicon.cms.sos.supports.index') }}" class="nav-link">
                            <i class="fas fa-headset mr-1"></i> @lang('Hỗ trợ')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('horicon.cms.sos.users.index') }}" class="nav-link">
                            <i class="fas fa-user mr-1"></i> @lang('Người lao động')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('horicon.cms.sos.questions.index') }}" class="nav-link">
                            <i class="fas fa-list mr-1"></i> @lang('Câu hỏi thường gặp')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('horicon.cms.sos.contacts.index') }}" class="nav-link">
                            <i class="fas fa-paper-plane mr-1"></i> @lang('Câu hỏi')
                        </a>
                    </li>

                    {{--<li class="nav-item dropdown">--}}
                        {{--<a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-apps" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                            {{--<i class="fas fa-th mr-1"></i> @lang('Apps') <div class="arrow-down"></div>--}}
                        {{--</a>--}}

                        {{--<div class="dropdown-menu" aria-labelledby="topnav-apps">--}}
                            {{--<div class="dropdown">--}}
                                {{--<a class="dropdown-item dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-blog" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                    {{--@lang('Tin tức') <div class="arrow-down"></div>--}}
                                {{--</a>--}}
                                {{--<div class="dropdown-menu" aria-labelledby="topnav-blog">--}}
                                    {{--<a href="{{ route('horicon.cms.blog.posts.index') }}" class="dropdown-item">@lang('Bài viết')</a>--}}
                                    {{--<a href="{{ route('horicon.cms.blog.categories.index') }}" class="dropdown-item">@lang('Thể loại')</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<a href="{{ route('horicon.cms.faqs.index') }}" class="dropdown-item">@lang('Hỏi đáp')</a>--}}
                        {{--</div>--}}
                    {{--</li>--}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-apps" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cogs mr-1"></i> @lang('Cấu hình') <div class="arrow-down"></div>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="{{ route('horicon.cms.sos.companies.index') }}" class="dropdown-item">@lang('Công ty')</a>
                            <a href="{{ route('horicon.cms.sos.contracts.index') }}" class="dropdown-item">@lang('Hợp đồng')</a>
                            @role('admin')
                                <a href="{{ route('horicon.admin.users.index') }}" class="dropdown-item">@lang('Người dùng')</a>
                                <a href="{{ route('horicon.admin.env.distance') }}" class="dropdown-item">@lang('Bán kính')</a>
                                <a href="{{ route('horicon.admin.env.date') }}" class="dropdown-item">@lang('Ngày hợp lệ')</a>
                            @endrole
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>