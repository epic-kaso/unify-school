/// <reference path="../../../../../../../typings/angularjs/angular.d.ts"/>
/* global App */
App.constant('StudentsViewBaseURL', '/admin/dashboard/load-module/admin/students/ui');
App.constant('StudentsResourceURL', '/admin/modules/students/:id');
App.constant('ImportStudentsResourceURL', '/admin/resources/import-students');

App.factory('StudentsService',['$resource','StudentsResourceURL',function($resource,StudentsResourceURL){
    return $resource(StudentsResourceURL,{id: '@id'},{
        'update': {method: 'PUT'},
        'destroyMany': {method: 'DELETE',params: {action: 'destroy_students',id: 0}}
        });
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
                resolve: helper.resolveFor('toaster', 'inputmask', 'taginput', 'filestyle', 'slimscroll', 'ngUpload','xeditable'),
                controller: ['$scope', '$window', '$rootScope','editableOptions', 'editableThemes',
                    function ($scope, $window, $rootScope,editableOptions,editableThemes) {
                        
                        //template start
                        editableOptions.theme = 'bs3';
                        editableThemes.bs3.inputClass = 'input-xs';
                        editableThemes.bs3.buttonsClass = 'btn-sm';
                        editableThemes.bs3.submitTpl = '<button type="submit" class="btn btn-success"><span class="fa fa-check"></span></button>';
                        editableThemes.bs3.cancelTpl = '<button type="button" class="btn btn-default" ng-click="$form.$cancel()">' +
                        '<span class="fa fa-times text-muted"></span>' +
                        '</button>';
                        
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
             .state('app.students.view_student',
            {
                url: '/{id:int}',
                templateUrl: ViewBaseURL + '/view-student',
                title: 'View Student',
                controller: 'ViewStudentController',
                resolve: {
                    'Student': ['StudentsService','$stateParams',function(StudentsService,$stateParams){
                        return StudentsService.get({id: $stateParams.id});
                    }]
                }
            })
            .state('app.students.manage', {
                url: '/manage',
                templateUrl: ViewBaseURL + '/manage-students',
                title: 'Manage Students',
                controller: 'ManageStudentsController',
                resolve: {
                    'Students': ['StudentsService',function(StudentsService){
                        return StudentsService.get({});
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
        $scope.sessions = getSessionsFrom(SchoolDataService);
        $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
        $scope.selectedSchoolCategory = $scope.schoolCategories[0];
        $scope.classes = $scope.selectedSchoolCategory.classes;

        $scope.student = {
            school_category: '',
            school_class: '',
            admission_date: null
        };

        $scope.enrollStudent = function (student, callback) {
            student.school_category = student.school_category.id;
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
                    student = null;
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

        $scope.$on('refreshSchoolDataComplete',function(){
            $scope.sessions = getSessionsFrom(SchoolDataService);
            $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
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
    }
]);


App.controller('StudentsImportController', ['$scope', 'SchoolDataService','ImportStudentsResourceURL',
    function ($scope, SchoolDataService,ImportStudentsResourceURL) {

        console.log(SchoolDataService.school.school_type.school_categories);
        
        $scope.import = {
                            working: false,
                            error: false,
                            response: null,
                            url: ImportStudentsResourceURL,
                            completed: function(response){
                                console.log(response);
                                if(angular.isObject(response)){
                                    $scope.import.response = response;
                                }else{
                                    $scope.import.response = null;
                                    $scope.import.error = true;
                                }
                                
                                $scope.import.working = false;
                            },
                            isUploading: function(){
                                $scope.import.error = false;
                                $scope.import.working = true;
                            }
                        };

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

App.controller('ManageStudentsController', 
['$scope','StudentsService','$http','$state','$rootScope','SchoolDataService','toaster',
 function ($scope,StudentsService,$http,$state,$rootScope,SchoolDataService,toaster) {
    console.log(SchoolDataService.school.school_type.classes); 
    $scope.showContextMenu = false; 
    $scope.Students = {};
    $scope.classes = SchoolDataService.school.school_type.classes;
    $scope.ScopedSchoolCategory = {};
    $scope.studentActionMenuItems = [
        {
            name: 'Promote'
        },
        {
            name: 'Change Class'
        },
        {
            name: 'Demote'
        },
        {
            name: 'Delete'
        }
    ];
    
    $scope.menu = {
      promoteSelectedStudents: function(students){
          var selectedStudents = extractSelectedStudents(students);
          var selectedIDs = [];
          
          angular.forEach(selectedStudents,function(item){
              this.push(item.student.id);
          },selectedIDs); 
      },
      demoteSelectedStudents: function(students){
          var selectedStudents = extractSelectedStudents(students);
          var selectedIDs = [];
          
          angular.forEach(selectedStudents,function(item){
              this.push(item.student.id);
          },selectedIDs); 
      },
      changeSelectedStudentsClass: function(students){
          var selectedStudents = extractSelectedStudents(students);
          var selectedIDs = [];
          
          angular.forEach(selectedStudents,function(item){
              this.push(item.student.id);
          },selectedIDs); 
      },
      printSelectedStudents: function(students){
          var selectedStudents = extractSelectedStudents(students);
          var selectedIDs = [];
          
          angular.forEach(selectedStudents,function(item){
              this.push(item.student.id);
          },selectedIDs); 
      },
      exportSelectedStudentsToExcel: function(students){
          var selectedStudents = extractSelectedStudents(students);
          var selectedIDs = [];
          
          angular.forEach(selectedStudents,function(item){
              this.push(item.student.id);
          },selectedIDs); 
      },
      deleteSelectedStudents: function(students){
          $scope.loadingStudents = true;
          var selectedStudents = extractSelectedStudents(students);
         
          var selectedIDs = [];
          
          angular.forEach(selectedStudents,function(item){
              this.push(item.student.id);
          },selectedIDs); 
          
           console.log(students,selectedStudents,selectedIDs);
          
          StudentsService.destroyMany({ids: selectedIDs.join(',')}).$promise.then(function(response){
              
              angular.forEach(selectedStudents,function(item){
                  this.splice(item.index,1);
              },students); 
              toaster.pop('success', 'Student', 'Deleted Successfully');
              $scope.loadingStudents = false;
              
          },function(){
              toaster.pop('error', 'Student', 'Delete Failed');
              $scope.loadingStudents = false;
          });
      }
    };
    
    $scope.loadingStudents = false;
    
    $scope.toggled = function($event){
        $event.preventDefault();
        $event.stopPropagation();
    };
    
    $scope.fetchPage = function(url){
        
        $scope.loadingStudents = true;
        
        $http.get(url)
        .success(function(data){
            $scope.Students = data;   
        })
        .finally(function(){
            $scope.loadingStudents = false; 
        });
        
    }; 
    
    
    $scope.saveStudentEditMode = function(event,student,index){
        student.updating = true;
        student.action = 'updateStudent';
        
        StudentsService.update(student).$promise.then(function(response){
            toaster.pop('success', 'Student', 'Updated Successfully');
            student.updating = false;
            student = response;
            
            $scope.Students.data.splice(index,1,student);
            
        },function(err){
            toaster.pop('error', 'Student', 'Update Failed');
            student.updating = false;
        });
        event.preventDefault();
    };
    
    $scope.fetchStudents = function(category_id){
        $scope.loadingStudents = true;
        
        var successCallback = function(response){
                $scope.Students = response;
                $scope.loadingStudents = false;
            };
        var errorCallback  =   function(){
                //error
                $scope.loadingStudents = false;
            };
        
        if(angular.isUndefined(category_id) ||category_id == null){
            StudentsService.get({},successCallback,errorCallback);
        }else{
             StudentsService.get({school_category_id: category_id},successCallback,errorCallback);
        }
    };
    
    $scope.searchStudents = function(query){
        $scope.loadingStudents = true;
        
        var successCallback = function(response){
                $scope.Students = response;
                $scope.loadingStudents = false;
            };
        var errorCallback  =   function(){
                //error
                $scope.loadingStudents = false;
            };
        
        if(angular.isDefined(query) && query !== null){
            StudentsService.get({search: query},successCallback,errorCallback);
        }
    };
    
    $scope.viewStudent = function(student_id){
        $state.go('app.students.view_student',{id: student_id});
    };
    
    
    $scope.selectAllStudents = function(students,select_all_students){
        angular.forEach(students,function(student,index){
            student.selected = select_all_students;
            }
         );
         
         $scope.studentSelected(students);
    };
    
    $scope.studentSelected  = function(students,selected_student,$index){
        $scope.showContextMenu = false;
        
        if(angular.isDefined(selected_student) && selected_student != null && selected_student.selected){
            $scope.showContextMenu = true;
            return;
        }
        
        if(angular.isDefined(students) && angular.isArray(students)){
            angular.forEach(students,function(student,index){
                if(student.selected){
                    $scope.showContextMenu = true;
                }
            });
        }
    };
    
    function extractSelectedStudents(students){
        var response = [];
        if(angular.isDefined(students) && angular.isArray(students)){
            angular.forEach(students,function(student,index){
                if(student.selected){
                   this.push({student: student,index: index});
                }
            },response);
        }
        
        return response;
    }
    
    $scope.$watch('Students.data',function(newValue,oldValue){
        $scope.studentSelected($scope.Students.data);
    },true);
    
    $rootScope.$on('SCHOOL_CONTEXT_CHANGED', 
        function (event, obj) {
            console.log('I hear ya @ Student Module : SCHOOL_CONTEXT_CHANGED');
            console.log(obj);
        }
     );
     
     $rootScope.$on('refreshSchoolDataComplete',function(){
         $scope.classes = SchoolDataService.school.school_type.classes;
     });
     
     $rootScope.$on('selectedSchoolCategoryChanged',function(event, obj){
         console.log('I hear ya @ Student Module : selectedSchoolCategoryChanged');
         console.log(obj);
         
         $scope.ScopedSchoolCategory = obj.value;
         $scope.fetchStudents($scope.ScopedSchoolCategory.id);
     });
     
     
    $scope.fetchStudents();
    
}]);

App.controller('StudentQuickEnrollController', ['$scope', function ($scope) {

}]);

App.controller('ViewStudentController', ['$scope','Student', function ($scope,Student) {
    $scope.student = Student;
    $scope.gender = [
        {
            label: 'Male',
            value: 'male'
        },
        {
            label: 'Female',
            value: 'female'
        }
    ];
    
    $scope.religion = [
        {
            label: 'Christian',
            value: 'christian'
        },
        {
            label: 'Muslim',
            value: 'muslim'
        },
        {
            label: 'Other',
            value: 'other'
        }
    ];
    
}]);