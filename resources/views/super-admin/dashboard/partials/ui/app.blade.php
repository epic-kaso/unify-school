<!-- top navbar-->
<header ng-include="'/unify/dashboard/partial/top-navbar'" class="topnavbar-wrapper"></header>
<!-- sidebar-->
<aside ng-include="'/unify/dashboard/partial/sidebar'" ng-controller="SidebarController"
       class="aside"></aside>
<!-- offsidebar-->
<aside ng-include="'/unify/dashboard/partial/offsidebar'" class="offsidebar"></aside>
<!-- Main section-->
<section>
    <!-- Page content-->
    <div ui-view="" autoscroll="false" ng-class="app.viewAnimation" class="content-wrapper"></div>
</section>
<!-- Page footer-->
<footer ng-include="'/unify/dashboard/partial/footer'"></footer>
<toaster-container></toaster-container>