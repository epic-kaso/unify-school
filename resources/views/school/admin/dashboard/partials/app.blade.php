<!-- top navbar-->
<header ng-include="'/admin/dashboard/partial/top-navbar'" class="topnavbar-wrapper"></header>
<!-- sidebar-->
<aside ng-include="'/admin/dashboard/partial/sidebar'" ng-controller="SidebarController"
       class="aside"></aside>
<!-- offsidebar-->
<aside ng-include="'/admin/dashboard/partial/offsidebar'" class="offsidebar"></aside>
<!-- Main section-->
<section>
    <!-- Page content-->
    <div ui-view="" autoscroll="false" ng-class="app.viewAnimation" class="content-wrapper"></div>
</section>
<!-- Page footer-->
<footer ng-include="'/admin/dashboard/partial/footer'"></footer>