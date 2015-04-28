<!-- Inline template with sidebar items markup and ng-directives-->
<script type="text/ng-template" id="sidebar-renderer.html">
    <span ng-if="item.heading">@{{(item.translate | translate) || item.text}}</span>
    <a ng-if="!item.heading" ui-sref="@{{ item.sref }}" title="@{{item.text}}"><em
                ng-hide="inSubmenu" class="@{{item.icon}}"></em>

        <div ng-if="item.alert" class="label label-success pull-right">@{{item.alert}}</div>
        <span>@{{(item.translate | translate) || item.text}}</span></a>
    <ul ng-if="item.submenu" collapse="isCollapse(pIndex)" ng-init="addCollapse(pIndex, item)"
        class="nav sidebar-subnav">
        <li class="sidebar-subnav-header" style="text-transform: uppercase">@{{(item.translate | translate) || item.text}}</li>
        <li ng-repeat="item in item.submenu" ng-include="'sidebar-renderer.html'"
            ng-class="getMenuItemPropClasses(item)" ng-init="pIndex=(pIndex+'-'+$index); inSubmenu = true"
            ng-click="toggleCollapse(pIndex)"></li>
    </ul>
</script>
<!-- START Sidebar (left)-->
<div class="aside-inner">
    <nav sidebar="" class="sidebar">
        <!-- START sidebar nav-->
        <ul class="nav">
            <!-- Iterates over all sidebar items-->
            <li ng-class="getMenuItemPropClasses(item)" ng-disabled="item.disable" ng-repeat="item in menuItems" ng-init="pIndex = $index"
                ng-include="'sidebar-renderer.html'" ng-click="toggleCollapse(pIndex, true)"></li>
        </ul>
        <!-- END sidebar nav-->
    </nav>
</div>
<!-- END Sidebar (left)-->