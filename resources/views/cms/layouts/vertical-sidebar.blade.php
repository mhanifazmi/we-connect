<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('index') }}"><img class="img-fluid for-light"
                    src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark"
                    src="{{ asset('assets/images/logo/logo_dark.png') }}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('index') }}"><img class="img-fluid"
                    src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="{{ route('index') }}"><img class="img-fluid"
                                src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list">
                        <label class="badge badge-success">2</label><a
                            class="sidebar-link sidebar-title {{ request()->route()->getPrefix() == '/dashboard'? 'active': '' }}"
                            href="#"><i data-feather="home"></i><span
                                class="lan-3">{{ trans('lang.Dashboards') }}</span>
                            <div class="according-menu"><i
                                    class="fa fa-angle-{{ request()->route()->getPrefix() == '/dashboard'? 'down': 'right' }}"></i>
                            </div>
                        </a>
                        <ul class="sidebar-submenu"
                            style="display: {{ request()->route()->getPrefix() == '/dashboard'? 'block;': 'none;' }}">
                            <li><a class="lan-4 {{ Route::currentRouteName() == 'index' ? 'active' : '' }}"
                                    href="{{ route('index') }}">{{ trans('lang.Default') }}</a></li>
                            <li><a class="lan-5 {{ Route::currentRouteName() == 'index' ? 'active' : '' }}"
                                    href="{{ route('index') }}">{{ trans('lang.Ecommerce') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>

<style type="text/css">
    .page-wrapper.horizontal-wrapper .page-body-wrapper .sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li {
        padding-top: unset;
    }
</style>
