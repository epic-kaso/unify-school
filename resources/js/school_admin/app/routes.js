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
                resolve: helper.resolveFor('modernizr', 'icons','toaster')
            })
            .state('app.home',
            {
                url: '/home',
                templateUrl: ViewBaseURL + '/home',
                title: 'School Dashboard',
                controller: ['$scope',
                    function ($scope) {

                    }]
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
                resolve: helper.resolveFor('xeditable'),
                controller: ['$scope',
                    function ($scope) {
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
            })
            //Student Module Routes
            .state('app.enroll_student',
            {
                url: '/students/enroll-student',
                templateUrl: ViewBaseURL + '/students/enroll_student',
                title: 'Enroll A New Student',
                controller: ['$scope',
                    function ($scope) {
                    }
                ]
            })
            .state('app.enroll_students',
            {
                url: '/students/enroll-students',
                templateUrl: ViewBaseURL + '/students/enroll_students',
                title: 'Enroll Many Students',
                controller: ['$scope',
                    function ($scope) {
                    }
                ]
            })
            .state('app.import_students',
            {
                url: '/students/import',
                templateUrl: ViewBaseURL + '/students/import-students',
                title: 'Import Students',
                controller: 'StudentsImportController'
            })
            .state('app.export_students',
            {
                url: '/students/export',
                templateUrl: ViewBaseURL + '/students/export-students',
                title: 'Export Students',
                controller: ['$scope',
                    function ($scope) {
                    }
                ]
            });
        //
        // CUSTOM RESOLVES
        //   Add your own resolves properties
        //   following this object extend
        //   method
        // -----------------------------------
        // .state('app.someroute', {
        //   url: '/some_url',
        //   templateUrl: 'path_to_template.html',
        //   controller: 'someController',
        //   resolve: angular.extend(
        //     helper.resolveFor(), {
        //     // YOUR RESOLVES GO HERE
        //     }
        //   )
        // })
}]);