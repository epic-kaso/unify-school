var myAppRoutes = angular.module('SchoolAdminApp');

myAppRoutes.config(['$stateProvider', '$locationProvider', '$urlRouterProvider', 'RouteHelpersProvider', 'ViewBaseURL',
    function ($stateProvider, $locationProvider, $urlRouterProvider, helper, ViewBaseURL) {
        'use strict';

        // Set the following to true to enable the HTML5 Mode
        // You may have to set <base> tag in index and a routing configuration in your server
        $locationProvider.html5Mode(false);

        // default route
        $urlRouterProvider.otherwise('/app/home');

        //
        // Application Routes
        // -----------------------------------

        $stateProvider
            .state('app', {
                url: '/app',
                abstract: true,
                templateUrl: ViewBaseURL + '/ui/app',
                controller: 'AppController',
                resolve: helper.resolveFor('modernizr', 'icons','toaster','ngDialog','parsley')
            })
            .state('app.home',
            {
                url: '/home',
                templateUrl: ViewBaseURL + '/home',
                resolve: helper.resolveFor('toaster','slimscroll'),
                title: 'School Dashboard',
                controller: 'HomeController'
            })
            .state('app.viewClassArm',
            {
                url: '/class/:id',
                templateUrl: ViewBaseURL + '/pages/school_class',
                title: 'Class Dashboard',
                controller: ['$scope',
                    function ($scope) {
                    }
                ]
            })
            .state('app.settings',
            {
                url: '/settings',
                templateUrl: ViewBaseURL + '/settings/index',
                title: 'Settings',
                resolve: helper.resolveFor('xeditable','toaster','inputmask','taginput','filestyle','slimscroll'),
                controller: ['$scope','editableOptions', 'editableThemes',
                    function ($scope,editableOptions, editableThemes) {
                        //template start
                        editableOptions.theme = 'bs3';
                        editableThemes.bs3.inputClass = 'input-xs';
                        editableThemes.bs3.buttonsClass = 'btn-sm';
                        editableThemes.bs3.submitTpl = '<button type="submit" class="btn btn-success"><span class="fa fa-check"></span></button>';
                        editableThemes.bs3.cancelTpl = '<button type="button" class="btn btn-default" ng-click="$form.$cancel()">' +
                        '<span class="fa fa-times text-muted"></span>' +
                        '</button>';
                    }
                ]
            })
            .state('app.settings.session_term',
            {
                url: '/session_term',
                templateUrl: ViewBaseURL + '/settings/session_term',
                title: 'Session & Term Settings',
                controller: 'SettingsSessionTermController'
            })
            .state('app.settings.students',
            {
                url: '/students',
                templateUrl: ViewBaseURL + '/settings/students',
                title: 'Students Settings',
                controller: 'SettingsStudentsController'
            })
            .state('app.settings.school',
            {
                url: '/school',
                templateUrl: ViewBaseURL + '/settings/school',
                title: 'School Settings',
                controller: 'SettingsSchoolController'
            })
            .state('app.settings.staff',
            {
                url: '/staff',
                templateUrl: ViewBaseURL + '/settings/staff',
                title: 'Staff Settings',
                controller: 'SettingsStaffController'
            })
            .state('app.settings.classes',
            {
                url: '/classes',
                templateUrl: ViewBaseURL + '/settings/class',
                title: 'Classes Settings',
                controller: 'SettingsClassesController'
            })
            .state('app.settings.courses',
            {
                url: '/courses',
                templateUrl: ViewBaseURL + '/settings/courses',
                title: 'Courses Settings',
                controller: 'SettingsCoursesController'
            })
            .state('app.settings.academics',
            {
                url: '/academics',
                templateUrl: ViewBaseURL + '/settings/academics',
                title: 'Academics Settings',
                controller: 'SettingsAcademicsController'
            })
            .state('app.settings.reports',
            {
                url: '/reports',
                templateUrl: ViewBaseURL + '/settings/reports',
                title: 'Reports Settings',
                controller: 'SettingsReportController'
            })
            .state('app.settings.financials',
            {
                url: '/financial',
                templateUrl: ViewBaseURL + '/settings/financials',
                title: 'Financial Settings',
                controller: 'SettingsFinancialController'
            })
            .state('app.settings.notifications',
            {
                url: '/notifications',
                templateUrl: ViewBaseURL + '/settings/notifications',
                title: 'Notification Settings',
                controller: 'SettingsNotificationController'
            })
            .state('app.settings.administrators',
            {
                url: '/administrators',
                templateUrl: ViewBaseURL + '/settings/administrators',
                title: 'Administrators Settings',
                controller: 'SettingsAdministratorsController'
            });
}]);