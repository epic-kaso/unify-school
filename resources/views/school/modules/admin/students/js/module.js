App.constant('StudentsViewBaseURL', '/admin/dashboard/load-module/admin/students/ui');
App.constant('StudentsResourceURL', '/admin/modules/students');

App.factory('StudentsService',['$resource','StudentsResourceURL',function($resource,StudentsResourceURL){
    return $resource(StudentsResourceURL,{id: '@id'});
}]);

App.config(['$stateProvider', '$locationProvider', '$urlRouterProvider', 'RouteHelpersProvider', 'StudentsViewBaseURL',
    function ($stateProvider, $locationProvider, $urlRouterProvider, helper, ViewBaseURL) {
        'use strict';
        $stateProvider
            .state('app.students',
            {
                url: '/students',
                templateUrl: ViewBaseURL + '/home',
                title: 'Student Module',
                resolve: helper.resolveFor('toaster', 'inputmask', 'taginput', 'filestyle', 'slimscroll', 'ngUpload'),
                controller: ['$scope', '$window', '$rootScope',
                    function ($scope, $window, $rootScope) {
                        $scope.goBack = function ($event) {
                            $window.history.back();
                            $event.preventDefault();
                        };

                        $rootScope.$on('SCHOOL_CONTEXT_CHANGED', function (event, obj) {
                            console.log('I hear ya @ Student Module');
                        });
                    }]
            })
            .state('app.students.enroll_student',
            {
                url: '/enroll-student',
                templateUrl: ViewBaseURL + '/enroll_student',
                title: 'Enroll A New Student',
                controller: 'EnrollStudentController'
            })
            .state('app.students.enroll_students',
            {
                url: '/enroll-students',
                templateUrl: ViewBaseURL + '/enroll_students',
                title: 'Enroll Many Students',
                controller: ['$scope',
                    function ($scope) {
                    }
                ]
            }).state('app.students.manage', {
                url: '/manage',
                templateUrl: ViewBaseURL + '/manage-students',
                title: 'Manage Students',
                controller: 'ManageStudentsController',
                resolve: {
                    'Students': ['StudentsService',function(StudentsService){
                        return StudentsService.query({});
                    }]
                }
            }).state('app.students.import', {
                url: '/import',
                templateUrl: ViewBaseURL + '/import-students',
                title: 'Import Students',
                controller: 'StudentsImportController'
            }).state('app.students.export', {
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

App.controller('EnrollStudentController',['$scope', 'toaster', '$rootScope', 'SchoolDataService', 'ngDialog', '$http',
    function ($scope, toaster, $rootScope, SchoolDataService, ngDialog, $http) {
        console.log('School::');
        console.log(SchoolDataService.school);
        $scope.EnrollStudentPostUrl = "";

        $scope.quickEnroll = {
            openDialog: function ($event) {
                ngDialog.open({
                    template: 'StudentQuickEnrollDialog',
                    className: 'ngdialog-theme-default',
                    controller: 'StudentQuickEnrollController',
                    scope: $scope
                });

                $event.preventDefault();
            }
        };


        $scope.schoolCategories = SchoolDataService.school.school_type.school_categories;
        $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
        $scope.selectedSchoolCategory = $scope.schoolCategories[0];
        $scope.classes = $scope.selectedSchoolCategory.classes;

        $scope.student = {
            school_category: '',
            school_class: '',
            admission_date: new Date()
        };

        $scope.enrollStudent = function (student, callback) {
            student.isUploading = true;
            $scope.loading();

            $http.post($scope.EnrollStudentPostUrl, student)
                .success(function (response) {
                    toaster.pop('success', 'Enroll Student', 'Added Successfully');
                })
                .error(function (response) {
                    toaster.pop('error', 'Enroll Student', 'Failed to Add');
                })
                .finally(function () {
                    student.isUploading = false;
                    if (angular.isDefined(callback) && callback !== null && angular.isFunction(callback)) {
                        callback();
                    }
                });
        };

        $scope.loading = function () {
            toaster.pop('wait', 'Enroll Student', 'Upload Started...', 3000);
        };

        $scope.openBirthDate = function ($event, student) {
            $event.stopPropagation();
            $event.preventDefault();
            student.birthDateOpened = true;
        };

        $scope.openAdmissionDate = function ($event, student) {
            $event.stopPropagation();
            $event.preventDefault();
            student.admissionDateOpened = true;
        };


        $rootScope.$on('SCHOOL_CONTEXT_CHANGED', function (event, obj) {
            console.log('Context changed');
            console.log(obj);
            $scope.student.school_class = obj.category_level.id;
            $scope.student.school_category = obj.school_category.id;
        });

        $scope.$watch('student.school_category', function (newV, oldV) {
            angular.forEach($scope.schoolCategories, function (value, key) {
                if (value.id == newV) {
                    $scope.selectedSchoolCategory = value;
                    $scope.classes = $scope.selectedSchoolCategory.classes;
                }
            });
        });
    }
]);


App.controller('StudentsImportController', ['$scope', 'SchoolDataService',
    function ($scope, SchoolDataService) {

        console.log(SchoolDataService.school.school_type.school_categories);

        $scope.current_school_classes = null;
        $scope.school_categories = SchoolDataService.school.school_type.school_categories;
        $scope.sessions = getSessionsFrom(SchoolDataService);

        $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
        $scope.form = {
            school_category: null
        };

        $scope.$watch('form.school_category', function (newV, oldV) {
            setCurrentSchoolClassesForSchoolType(newV);
        });

        function getSessionsFrom(SchoolDataService) {
            return SchoolDataService.school.sessions.sort(function (a, b) {
                if (a.name < b.name) {
                    return -1;
                }
                if (a.name > b.name) {
                    return 1;
                }
                return 0;
            });
        }


        function setCurrentSchoolClassesForSchoolType(newV) {
            var school_type = null;
            angular.forEach($scope.school_categories, function (value, key) {
                if (value.id == newV) {
                    school_type = value;
                    return;
                }
            });

            if (angular.isDefined(school_type) && school_type != null) {
                $scope.current_school_classes = school_type.classes;
            }
        }

    }
]);

App.controller('ManageStudentsController', ['$scope','Students', function ($scope,Students) {
    $scope.Students = Students;
}]);

App.controller('StudentQuickEnrollController', ['$scope', function ($scope) {

}]);