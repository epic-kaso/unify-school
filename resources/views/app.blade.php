<!DOCTYPE html>
<html lang="en" data-ng-app="angle">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="@{{ app.description }}">
    <meta name="keywords" content="app, responsive, angular, bootstrap, dashboard, admin">
    <title data-ng-bind="pageTitle()">Angle - Angular Bootstrap Admin Template</title>
    <link rel="stylesheet" href="{{ asset('framework/app/css/app.css') }}" data-ng-if="!app.layout.isRTL">
    <link rel="stylesheet" href="{{ asset('framework/app/css/app-rtl.css') }}" data-ng-if="app.layout.isRTL">
</head>

<body data-ng-class="{ 'layout-fixed' : app.layout.isFixed, 'aside-collapsed' : app.layout.isCollapsed, 'layout-boxed' : app.layout.isBoxed, 'layout-fs': app.useFullLayout, 'hidden-footer': app.hiddenFooter, 'layout-h': app.layout.horizontal, 'aside-float': app.layout.isFloat}">
<div data-ui-view="" data-autoscroll="false" class="wrapper"></div>
<script src="{{ asset('framework/app/js/base.js') }}"></script>
<script src="{{ asset('framework/app/js/app.js') }}"></script>
</body>
</html>