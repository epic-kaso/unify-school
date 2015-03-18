<!-- START Top Navbar-->
<nav role="navigation" class="navbar topnavbar">
    <!-- START navbar header-->
    <div class="navbar-header">
        <a href="#/" class="navbar-brand">
            <div class="brand-logo">
                <img src="framework/app/img/logo.png" alt="App Logo" class="img-responsive"/>
            </div>
            <div class="brand-logo-collapsed">
                <img src="framework/app/img/logo-single.png" alt="App Logo" class="img-responsive"/>
            </div>
        </a>
    </div>
    <!-- END navbar header-->
    <!-- START Nav wrapper-->
    <div class="nav-wrapper" >
        <!-- START Left navbar-->
        <ul class="nav navbar-nav">
            <li>
                <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                <a ng-click="app.layout.isCollapsed = !app.layout.isCollapsed" class="hidden-xs">
                    <em class="fa fa-navicon"></em>
                </a>
                <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                <a toggle-state="aside-toggled" no-persist="no-persist" class="visible-xs sidebar-toggle">
                    <em class="fa fa-navicon"></em>
                </a>
            </li>
        </ul>
        <!-- END Left navbar-->




        <!-- START Right Navbar-->
        <ul class="nav navbar-nav navbar-right">
            <!-- Search icon-->
            <li>
                <a search-open="">
                    <em class="icon-magnifier"></em>
                </a>
            </li>
            <!-- START Offsidebar button-->
            <li>
                <a toggle-state="offsidebar-open" no-persist="no-persist">
                    <em class="icon-notebook"></em>
                </a>
            </li>
            <li class="dropdown" dropdown on-toggle="toggled(open)">
                <a href class="dropdown-toggle" dropdown-toggle>
                    {{ Auth::user()->email }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/admin/auth/logout">Logout</a></li>
                </ul>
            </li>
            <!-- END Offsidebar menu-->
        </ul>
        <!-- END Right Navbar-->
    </div>
    <!-- END Nav wrapper-->
    <!-- START Search form-->
    <form role="search" action="search.html" class="navbar-form">
        <div class="form-group has-feedback">
            <input type="text" placeholder="@{{ 'topbar.search.PLACEHOLDER' | translate }}" class="form-control"/>

            <div search-dismiss="search-dismiss" class="fa fa-times form-control-feedback"></div>
        </div>
        <button type="submit" class="hidden btn btn-default">Submit</button>
    </form>
    <!-- END Search form-->
</nav>
<!-- END Top Navbar-->