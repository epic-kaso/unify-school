<!DOCTYPE html>
<html lang="en" data-ng-app="SchoolAdminApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="@{{ app.description }}">
    <meta name="keywords" content="app, responsive, angular, bootstrap, dashboard, admin">
    <title data-ng-bind="pageTitle()">Angle - Angular Bootstrap Admin Template</title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('school_admin/css/school.css') }}" rel="stylesheet">
</head>
<body data-ng-class="{ 'layout-fixed' : app.layout.isFixed, 'aside-collapsed' : app.layout.isCollapsed, 'layout-boxed' : app.layout.isBoxed, 'layout-fs': app.useFullLayout, 'hidden-footer': app.hiddenFooter, 'layout-h': app.layout.horizontal, 'aside-float': app.layout.isFloat}">

@yield('content')
<toaster-container  toaster-options="{'close-button': { 'toast-warning': true, 'toast-error': false } }"></toaster-container>
<script src="{{ asset('school_admin/app/js/base.js') }}"></script>
<script src="{{ asset('school_admin/js/app.js') }}"></script>
<script>
    @yield('script')
</script>
<script>
    angular.module('SchoolAdminApp').constant('CSRF_TOKEN', '{{ csrf_token() }}');
</script>
</body>
</html>