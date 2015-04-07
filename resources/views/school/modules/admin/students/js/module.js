App.constant('StudentsViewBaseURL','/admin/dashboard/load-module/admin/students/ui');

App.config(['$stateProvider', '$locationProvider', '$urlRouterProvider', 'RouteHelpersProvider', 'StudentsViewBaseURL',
    function ($stateProvider, $locationProvider, $urlRouterProvider, helper, ViewBaseURL) {
        'use strict';
        $stateProvider
            .state('app.students',
		 {
            url: '/students',
            templateUrl: ViewBaseURL + '/home',
            title: 'Student Module',
            controller: ['$scope','$window',
                function ($scope,$window) {
                    $scope.goBack = function($event){
                        $window.history.back();
                        $event.preventDefault();
                    }
                }]
        })
            .state('app.students.enroll_student',
        {
            url: '/enroll-student',
            templateUrl: ViewBaseURL + '/enroll_student',
            title: 'Enroll A New Student',
            controller: ['$scope',
                function ($scope) {
                }
            ]
        }).state('app.students.enroll_students',
        {
            url: '/enroll-students',
            templateUrl: ViewBaseURL + '/enroll_students',
            title: 'Enroll Many Students',
            controller: ['$scope',
                function ($scope) {
                }
            ]
        }).state('app.students.import',{
            url: '/import',
            templateUrl: ViewBaseURL + '/import-students',
            title: 'Import Students',
            controller: 'StudentsImportController'
        }).state('app.students.export',{
            url: '/export',
            templateUrl: ViewBaseURL + '/export-students',
            title: 'Export Students',
            controller: ['$scope',
                function ($scope) {
                }
            ]
        });
    }
]);

App.controller('StudentsImportController',['$scope','SchoolDataService',
    function ($scope,SchoolDataService) {

        console.log(SchoolDataService.school.school_type.school_categories);

        $scope.current_school_classes = null;
        $scope.school_categories = SchoolDataService.school.school_type.school_categories;
        $scope.sessions = getSessionsFrom(SchoolDataService);

        $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
        $scope.form = {
            school_category: null
        };

        $scope.$watch('form.school_category',function(newV,oldV){
            setCurrentSchoolClassesForSchoolType(newV);
        });

        function getSessionsFrom(SchoolDataService){
            return SchoolDataService.school.sessions.sort(function(a,b){
                if (a.name < b.name) {
                    return -1;
                }
                if (a.name > b.name) {
                    return 1;
                }
                return 0;
            });
        }


        function setCurrentSchoolClassesForSchoolType(newV){
            var school_type = null;
            angular.forEach($scope.school_categories,function(value,key){
                if(value.id == newV){
                    school_type = value;
                    return ;
                }
            });

            if(angular.isDefined(school_type) && school_type != null){
                $scope.current_school_classes = school_type.classes;
            }
        }

    }
]);