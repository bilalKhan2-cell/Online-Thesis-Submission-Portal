<header class="page-topbar" id="header">
    <div class="navbar navbar-fixed">
        <nav
            class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
            <div class="nav-wrapper">
                <ul class="navbar-list right">
                    <li class="hide-on-med-and-down"><a class="waves-effect waves-block waves-light toggle-fullscreen"
                            href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                    <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
                            data-target="profile-dropdown"><span class="avatar-status avatar-online"><img
                                    src="{{asset("app-assets/images/avatar/avatar-7.png")}}"
                                    alt="avatar"><i></i></span></a></li>
                </ul>
                <!-- profile-dropdown-->
                <ul class="dropdown-content" id="profile-dropdown">
                    <li><a class="grey-text text-darken-1" href="user-profile-page.html"><i
                                class="material-icons">person_outline</i> Profile</a></li>
                    <li><a class="grey-text text-darken-1" href="user-login.html"><i
                                class="material-icons">keyboard_tab</i> Logout</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>