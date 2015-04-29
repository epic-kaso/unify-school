/**
 * Created by kaso on 11/6/2014.
 */

var app = angular.module('UnifySchoolApp',
    [
        'ui.router',
        "angular-loading-bar",
        'UnifySchoolApp.Services',
        'ui.checkbox',
        'ui.bootstrap',
        'ngCookies',
        'ngAnimate',
        'ngResource',
        'ngSanitize',
        'UnifySchoolApp.Controllers',
        'UnifySchoolApp.directives'
    ]);

app.constant('ViewBaseURL', '/wizard/partials');

app.config(function ($stateProvider, $urlRouterProvider, ViewBaseURL) {

    $urlRouterProvider.otherwise("/setup/step-one");

    $stateProvider
        .state('base', {
            url: "/setup",
            abstract: true,
            template: '<div ui-view></div>',
            resolve: {
                'Config': ['SchoolSetupService', function (SchoolSetupService) {
                    return SchoolSetupService.get();
                }]
            },
            controller: ['$scope', 'Config', 'SchoolService', '$state', '$rootScope', 'ToastService',
                function ($scope, Config, SchoolService, $state, $rootScope, ToastService) {
                $scope.config = Config;
                $scope.school = Config.school;

                $scope.removeCategory = function (selectedCategory, indexToRemove) {
                    $scope.config.school.school_types[selectedCategory].school_categories.splice(indexToRemove, 1);
                };

                $scope.addCategory = function (selectedCategory, school_category_name) {
                    $scope.config.school.school_types[selectedCategory].school_categories.push({
                        'display_name': school_category_name,
                        'name': school_category_name,
                        'arms': [
                            {
                                display_name: 'Default',
                                name: 'default',
                                arms: {
                                    default: {}
                                }
                            }
                        ]
                    });
                };

                $scope.nextStepTwo = function () {
                    $rootScope.currentProgress = '30%';
                    SchoolService.save($scope.config.school, function (data) {
                        console.log(data);

                        ToastService.success('School details saved!, Keep going');
                        $scope.school = data;
                        $state.go('base.step_two');
                        //SchoolService.get({id: data.id, school_slug: data.slug}, function (data) {
                        //    $scope.school = data;
                        //    $state.go('base.step_two');
                        //});

                    }, function () {
                        console.log('error occurred');
                        ToastService.error('Error Occurred, We couldn\'t save school details, Retry later.');
                    });
                };


                $scope.nextStepThree = function () {
                    $rootScope.currentProgress = '70%';
                    SchoolService.update(
                        {
                            id: $scope.school.id,
                            school_slug: $scope.school.slug,
                            action: 'school_categories_update'
                        },
                        $scope.school
                    ).$promise.then(function (data) {
                        console.log(data);
                        $scope.school = data;
                            ToastService.success('Okay, Details Saved. Keep going, Almost done.');
                            $state.go('base.step_three');

                    }, function () {
                        console.log('error occurred');
                            ToastService.error('Error Occurred, We couldn\'t save school details, Retry later.');
                    });
                };

                $scope.nextStepFour = function () {
                    $rootScope.currentProgress = '100%';
                    SchoolService.update(
                        {
                            id: $scope.school.id,
                            school_slug: $scope.school.slug,
                            action: 'admin_login_details_update'
                        },
                        $scope.school
                    ).$promise.then(function (data) {
                            console.log(data);
                            $scope.school = data;
                            ToastService.success('Okay, Details Saved. Keep going, Almost done.');

                            $state.go('base.step_four');

                        }, function () {
                            console.log('error occurred');
                            ToastService.error('Error Occurred, We couldn\'t save school details, Retry later.');
                        });
                }
            }]
        })
        .state('base.step_one', {
            url: "/step-one",
            templateUrl: ViewBaseURL + "/step-one.html",
            controller: ['$scope', '$state', function ($scope, $state) {

            }]
        })
        .state('base.step_two', {
            url: "/step-two",
            templateUrl: ViewBaseURL + "/step-two.html",
            controller: ['$scope', function ($scope) {

                $scope.createArms = function (baseName, school_arm, count) {
                    school_arm.arms = [];
                    for (var i = 1; i <= count; i++) {
                        school_arm.arms[i - 1] = {
                            'name': baseName + '_' + i,
                            'display_name': ''
                        }
                    }
                };

                $scope.removeArm = function (school_category_arms, index) {
                    school_category_arms.splice(index, 1);
                };

                $scope.addArm = function (school_category_arms, school_category_name) {
                    school_category_arms.push({
                        'display_name': school_category_name,
                        'name': school_category_name,
                        'arms': []
                    });
                };
            }]
        })
        .state('base.step_three', {
            url: "/step-three",
            templateUrl: ViewBaseURL + "/step-three.html",
            controller: ['$scope', '$state', function ($scope, $state) {
            }]
        })
        .state('base.step_four', {
            url: "/step-four",
            templateUrl: ViewBaseURL + "/step-four.html",
            controller: ['$scope', '$state', function ($scope, $state) {
            }]
        });
});

/**
 * Created by kaso on 11/6/2014.
 */

var app = angular.module('UnifySchoolApp.directives', []);


app.directive('toast', function ($animate, $timeout) {
    return {
        'restrict': 'EA',
        'template': '<div class="toast alert alert-{{ type }} text-center" ><ul><li ng-repeat="message in messages"> {{ message }}</li></ul></div>',
        scope: {
            type: '=type',
            messages: '=messages',
            show: '=show'
        },
        'link': function link(scope, element, attrs) {
            function showToast() {
                //$animate.addClass(element,'toast-alert');
                element.css({opacity: 1});
                $timeout(hideToast, 10000);
            }

            function hideToast() {
                element.css({opacity: 0});
                //$animate.removeClass(element,'toast-alert');
            }

            showToast();
            scope.$watch(function () {
                return scope.show;
            }, function (newV, oldV) {
                if (newV == true) {
                    showToast();
                } else {
                    hideToast();
                }
            })
        }
    }
});

/**
 * Created by kaso on 11/6/2014.
 */

var app = angular.module('UnifySchoolApp.Controllers', []);
/**
 * Created by kaso on 11/6/2014.
 */
var app = angular.module('UnifySchoolApp.Services', []);

app.factory('SchoolService', ['$resource', function ($resource) {
    return $resource('/resources/school/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });
}]);

app.factory('SchoolSetupService', ['$resource', function ($resource) {
    return $resource('/resources/school-setup/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });
}]);

app.factory('PreloadTemplates',function ($templateCache, $http,ViewBaseURL) {
    var templates = [
        ViewBaseURL+"/device-make.html",
        ViewBaseURL+"/device-model.html",
        ViewBaseURL+"/device-size.html",
        ViewBaseURL+"/device-network.html",
        ViewBaseURL+"/device-condition.html",
        ViewBaseURL+"/device-reward.html",
        ViewBaseURL+"/book-appointment.html",
        ViewBaseURL+"/book-success.html",
        ViewBaseURL+"/swap-location.html"
    ];
    return {
        run: function(){
            templates.forEach(function(currentItem){
                $http.get(currentItem, { cache: $templateCache });
            });
        }
    }
});


app.factory('ToastService', ['$rootScope', function ($rootScope) {

    if (angular.isUndefined($rootScope.toast)) {
        $rootScope.toast = {messages: [], show: false, type: 'info'};
    }

    return {
        error: function (message) {
            $rootScope.toast = {messages: [message], show: true, type: 'danger'};
        },
        info: function (message) {
            $rootScope.toast = {messages: [message], show: true, type: 'info'};
        },
        success: function (message) {
            $rootScope.toast = {messages: [message], show: true, type: 'success'};
        }
    }
}]);
//# sourceMappingURL=main.js.map