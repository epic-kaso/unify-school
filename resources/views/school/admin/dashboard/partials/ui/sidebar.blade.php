<!-- Inline template with sidebar items markup and ng-directives-->
<script type="text/ng-template" id="sidebar-renderer.html">
    <span ng-if="item.heading">@{{(item.translate | translate) || item.text}}</span>
    <a ng-if="!item.heading" ng-href="@{{$state.href(item.sref, item.params)}}" title="@{{item.text}}"><em
                ng-hide="inSubmenu" class="@{{item.icon}}"></em>

        <div ng-if="item.alert" class="label label-success pull-right">@{{item.alert}}</div>
        <span>@{{(item.translate | translate) || item.text}}</span></a>
    <ul ng-if="item.submenu" collapse="isCollapse(pIndex)" ng-init="addCollapse(pIndex, item)"
        class="nav sidebar-subnav">
        <li class="sidebar-subnav-header">@{{(item.translate | translate) || item.text}}</li>
        <li ng-repeat="item in item.submenu" ng-include="'sidebar-renderer.html'"
            ng-class="getMenuItemPropClasses(item)" ng-init="pIndex=(pIndex+'-'+$index); inSubmenu = true"
            ng-click="toggleCollapse(pIndex)"></li>
    </ul>
</script>
<!-- START Sidebar (left)-->
<div class="aside-inner">
    <nav sidebar="" class="sidebar">

        <div ng-hide="app.layout.isCollapsed"
             class="btn-group btn-block" dropdown ng-controller="NavBarController"
             style="padding-left: 10px;padding-right: 10px;margin-top: 10px;">
            <button type="button" style="width: 90%" class="btn btn-danger navbar-btn"><span
                        ng-bind="selectedSchoolCategory.display_name"></span></button>
            <button type="button" style="width: 10%" class="btn btn-danger navbar-btn dropdown-toggle" dropdown-toggle>
                <span class="caret"></span>
                <span class="sr-only">Split button!</span>
            </button>
            <ul class="dropdown-menu" role="menu" style="margin-left: 10px;margin-right: 10px;width: 90%;">
                <li ng-if="schoolCategories.length > 1">
                    <a href="#">All</a>
                </li>
                <li ng-repeat="category in schoolCategories">
                    <a href="#" ng-click="prepareSchoolCategory($event,category)">@{{ category.display_name }}</a>
                </li>
            </ul>
        </div>

        <!-- START sidebar nav-->
        <ul class="nav">
            <!-- Iterates over all sidebar items-->
            <li ng-class="getMenuItemPropClasses(item)" ng-repeat="item in menuItems" ng-init="pIndex = $index"
                ng-include="'sidebar-renderer.html'" ng-click="toggleCollapse(pIndex, true)"></li>
        </ul>
        <!-- END sidebar nav-->
    </nav>
</div>
<!-- END Sidebar (left)-->