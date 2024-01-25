<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img
                    class="show-on-medium-and-down hide-on-med-and-up"
                    src="{{ asset('app-assets/images/logo/materialize-logo.png') }}" alt="materialize logo" /><span
                    class="logo-text hide-on-med-and-down">Welcome</span></a><a class="navbar-toggler" href="#"><i
                    class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="menu-accordion">
        @if (Auth::guard('web')->user())
            <li class="bold">
                <a href="{{ route('admin.dashboard') }}"
                    class="@if (Route::currentRouteName() == 'admin.dashboard') active @endif waves-effect waves-cyan"><i
                        class="material-icons">dashboard</i>Dashboard</a>
            </li>

            <li class="bold">
                <a href="{{ route('users.index') }}"
                    class="@if (Route::currentRouteName() == 'users.index') active @endif waves-effect waves-cyan"><i
                        class="material-icons">account_circle</i>Users</a>
            </li>
            <li class="bold"><a class="waves-effect waves-cyan @if (Route::currentRouteName() == 'departments.index') active @endif"
                    href="{{ route('departments.index') }}"><i class="material-icons">building</i><span
                        class="menu-title" data-i18n="Support">Department</span></a>
            </li>
            <li class="bold">
                <a href="{{ route('supervisors.index') }}"
                    class="@if (Route::currentRouteName() == 'supervisors.index') active @endif waves-effect waves-cyan">
                    <i class="material-icons">person</i>Supervisors</a>
            </li>
            <li class="bold">
                <a href="{{ route('project_leads.index') }}"
                    class="@if (Route::currentRouteName() == 'project_leads.index') active @endif waves-effect waves-cyan">
                    <i class="material-icons">group</i>Project Leads</a>
            </li>
            <li class="bold">
                <a href="{{ route('assign_supervisor.index') }}"
                    class="@if (Route::currentRouteName() == 'assign_supervisor.index') active @endif waves-effect waves-cyan">
                    <i class="material-icons">assignment</i>Assign Supervisor</a>
            </li>
        @endif

        @if (Auth::guard('project_leads')->user())
            <li class="bold">
                <a href="{{ route('team.dashboard') }}"
                    class="@if (Route::currentRouteName() == 'team.dashboard') active @endif waves-effect waves-cyan"><i
                        class="material-icons">dashboard</i> Dashboard</a>
            </li>
            <li class="bold">
                <a href="{{ route('team.show_upload_thesis') }}"
                    class="@if (Route::currentRouteName() == 'team.show_upload_thesis') active @endif waves-effect waves-cyan"><i
                        class="material-icons">upload_2</i> Upload Thesis</a>
            </li>
            <li class="bold">
                <a href="{{ route('team.check_thesis_status') }}"
                    class="@if (Route::currentRouteName() == 'team.check_thesis_status') active @endif waves-effect waves-cyan">
                    <i class="material-icons">check_circle</i> Thesis Approval Status</a>
            </li>
            <li class="bold">
                <a href="{{ route('team.thesis_grading') }}"
                    class="@if (Route::currentRouteName() == 'team.thesis_grading') active @endif waves-effect waves-cyan"><i
                        class="material-icons">checklist</i> Thesis Grading</a>
            </li>
        @endif
    </ul>
    <div class="navigation-background"></div><a
        class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
        href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
