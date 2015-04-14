<!-- START Top Navbar-->
<nav role="navigation" class="navbar topnavbar">
    <!-- START navbar header-->
    <div class="navbar-header">
        <a href="#/" class="navbar-brand">
            <div class="brand-logo">
                <img src="{{ asset('app/img/klipboard.png') }}" alt="App Logo" class="img-responsive"/>
            </div>
            <div class="brand-logo-collapsed">
                <img src="{{ asset('app/img/klipboard_small.png') }}" alt="App Logo" class="img-responsive"/>
            </div>
        </a>
    </div>
    <!-- END navbar header-->
    <!-- START Nav wrapper-->
    <div class="nav-wrapper">
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
        <ul class="nav navbar-nav" ng-controller="NavBarController">
            <li>
                <div class="btn-group btn-block" dropdown>
                    <button type="button" class="btn btn-primary navbar-btn"
                            style="background-color: #4285f4;
                            font-size: 15px;font-weight: 600;"><span>@{{ selectedSchoolCategory.display_name || 'All' }}</span></button>
                    <button type="button"
                            class="btn btn-primary navbar-btn dropdown-toggle"
                            style="background-color: #4285f4"
                            dropdown-toggle>
                        <span class="caret"></span>
                        <span class="sr-only">Split button!</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li ng-if="schoolCategories.length > 1">
                            <a href="#" ng-click="prepareAllSchoolCategory($event)">All</a>
                        </li>
                        <li ng-repeat="category in schoolCategories">
                            <a href="#" ng-click="prepareSchoolCategory($event,category)">@{{ category.display_name }}</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li ng-show="selectedSchoolCategory">
                <div class="btn-group btn-block" dropdown>
                    <button type="button" class="btn btn-primary navbar-btn"
                            style="background-color: #4285f4;
                            font-size: 15px;font-weight: 600;"><span
                                ng-bind="classItems.selected.display_name"></span></button>
                    <button type="button"
                            class="btn btn-primary navbar-btn dropdown-toggle"
                            style="background-color: #4285f4"
                            dropdown-toggle>
                        <span class="caret"></span>
                        <span class="sr-only">Split button!</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li ng-if="classItems.submenu.length > 1">
                            <a href="#">All</a>
                        </li>
                        <li ng-repeat="category in classItems.submenu">
                            <a href="#" ng-click="prepareSchoolLevel($event,category)">@{{ category.display_name }}</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <!-- END Left navbar-->




        <!-- START Right Navbar-->
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a ui-sref="app.home">
                    <em class="fa fa-home fa-lg"></em>
                </a>
            </li>
            <li>
                <a ui-sref="app.settings">
                    <em class="fa fa-gear fa-lg"></em>
                </a>
            </li>
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