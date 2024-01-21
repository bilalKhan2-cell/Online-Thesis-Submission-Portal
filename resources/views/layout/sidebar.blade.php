<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img class="hide-on-med-and-down"
                    src="{{ asset('app-assets/images/logo/materialize-logo-color.png') }}" alt="materialize logo" /><img
                    class="show-on-medium-and-down hide-on-med-and-up"
                    src="{{ asset('app-assets/images/logo/materialize-logo.png') }}" alt="materialize logo" /><span
                    class="logo-text hide-on-med-and-down">Materialize</span></a><a class="navbar-toggler"
                href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="menu-accordion">    

        <li class="bold">
            <a href="{{route('users.index')}}" class="waves-effect waves-cyan"><i class="material-icons">account_circle</i>Users</a>
        </li>
        <li class="bold"><a class="waves-effect waves-cyan " href="{{route('departments.index')}}"><i class="material-icons">building</i><span class="menu-title"
                    data-i18n="Support">Department</span></a>
        </li>
        <li class="bold">
            <a href="{{route('supervisors.index')}}" class="waves-effect waves-cyan">
            <i class="material-icons">person</i>Supervisors</a>
        </li>
    </ul>
    <div class="navigation-background"></div><a
        class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
        href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
