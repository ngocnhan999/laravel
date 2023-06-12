<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
           data-toggle="modal" data-target="#modal-shortcut">
            <img src="{!! asset('admin/img/logo.png') !!}" alt="InThePocket"
                 aria-roledescription="logo">
            <span class="page-logo-text mr-1">{!! env('APP_NAME') !!}</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                   data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="{!! asset('admin/img/demo/avatars/avatar-admin.png') !!}"
                 class="profile-image rounded-circle"
                 alt="Dr. Codex Lantern">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span
                        class="text-truncate text-truncate-sm d-inline-block">{!! Auth::user()->getFullName() !!}</span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">TP.HO CHI MINH</span>
            </div>
            <img src="{!! asset('admin/img/card-backgrounds/cover-2-lg.png') !!}" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle"
               data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>
        <ul id="js-nav-menu" class="nav-menu">
            <li>
                <a href="{!! route('dashboard.index') !!}" title="Application Intel">
                    <i class="fal fa-info-circle"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            @if(Auth::user()->isSuperUser())
                <li class="nav-title">System</li>
                <li>
                    <a href="#" title="Settings" data-filter-tags="statistics chart graphs">
                        <i class="fal fa-cog"></i>
                        <span class="nav-link-text" data-i18n="nav.statistics">Settings</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{!! route('settings.options') !!}" title="Setting General"
                               data-filter-tags="statistics chart graphs flot bar pie">
                                <span class="nav-link-text" data-i18n="nav.statistics_flot">General</span>
                            </a>
                        </li>
                        <li>
                            <a href="{!! route('settings.email') !!}" title="Email"
                               data-filter-tags="statistics chart graphs chart.js bar pie">
                                <span class="nav-link-text" data-i18n="nav.statistics_chart.js">Email</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="Social Login" data-filter-tags="statistics chart graphs">
                                <span class="nav-link-text" data-i18n="nav.statistics_chartist.js">Social Login</span>
                                <span class="dl-ref label bg-primary-600 ml-2">39 KB</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" title="Platform Administration " data-filter-tags="pages">
                        <i class="fal fa-flag"></i>
                        <span class="nav-link-text" data-i18n="nav.pages">Platform Administration </span>
                    </a>
                    <ul>
                        <li>
                            <a href="{!! route('roles.index') !!}" title="Chat" data-filter-tags="pages chat">
                                <span class="nav-link-text" data-i18n="nav.pages_chat">Roles and Permissions</span>
                            </a>
                        </li>
                        <li>
                            <a href="{!! route('users.index') !!}" title="Contacts" data-filter-tags="pages contacts">
                                <span class="nav-link-text" data-i18n="nav.pages_contacts">Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="Forum" data-filter-tags="pages forum">
                                <span class="nav-link-text" data-i18n="nav.pages_forum">System information</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="List"
                               data-filter-tags="pages forum list">
                                <span class="nav-link-text" data-i18n="nav.pages_forum_list">Cache management</span>
                            </a>
                        </li>
                        <li>
                            <a href="{!! route('audit-log.index') !!}" title="Activities Logs" data-filter-tags="pages inbox">
                                <span class="nav-link-text" data-i18n="nav.audit-logs">Activities Logs</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify"
           class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
        <ul class="list-table m-auto nav-footer-buttons">
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                    <i class="fal fa-comments"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top"
                   title="Support Chat">
                    <i class="fal fa-life-ring"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top"
                   title="Make a call">
                    <i class="fal fa-phone"></i>
                </a>
            </li>
        </ul>
    </div> <!-- END NAV FOOTER -->
</aside>
