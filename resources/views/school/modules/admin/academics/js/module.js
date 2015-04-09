/**
 * Created by Ak on 4/7/2015.
 */
App.constant('AcademicsViewBaseURL','/admin/dashboard/load-module/admin/academics/ui');

App.config(['$stateProvider', '$locationProvider', '$urlRouterProvider', 'RouteHelpersProvider', 'AcademicsViewBaseURL',
    function ($stateProvider, $locationProvider, $urlRouterProvider, helper, ViewBaseURL) {
        'use strict';
        $stateProvider
            .state('app.academics',
            {
                url: '/academics',
                templateUrl: ViewBaseURL + '/home',
                title: 'Academics Module',
                controller: ['$scope','$window',
                    function ($scope,$window) {
                        $scope.goBack = function($event){
                            $window.history.back();
                            $event.preventDefault();
                        }
                    }]
            })
            .state('app.academics.upload_grades',
            {
                url: '/upload-grades',
                templateUrl: ViewBaseURL + '/upload_grades',
                title: 'Upload Students Grades',
                controller: ['$scope',
                    function ($scope) {
                    }
                ]
            }).state('app.academics.view_grades',
            {
                url: '/view-grades',
                templateUrl: ViewBaseURL + '/view_grades',
                title: 'View Students Grades',
                controller: ['$scope',
                    function ($scope) {
                    }
                ]
            }).state('app.academics.performance_analysis',{
                url: '/performance-analysis',
                templateUrl: ViewBaseURL + '/performance_analysis',
                title: 'Students performance Analysis',
                controller: ['$scope',
                    function ($scope) {
                    }
                ]
            });
    }
]);
