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
            controller: ['$scope', 'Config', 'SchoolService', '$state', function ($scope, Config, SchoolService, $state) {
                $scope.config = Config;
                $scope.school = Config.school;


                $scope.removeCategory = function (selectedCategory, indexToRemove) {
                    $scope.school.school_types[selectedCategory].school_categories.splice(indexToRemove, 1);
                };

                $scope.addCategory = function (selectedCategory, school_category_name) {
                    $scope.school.school_types[selectedCategory].school_categories.push({
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
                    SchoolService.save($scope.school, function (data) {
                        console.log(data);

                        SchoolService.get({id: data.id, school_slug: data.slug}, function (data) {
                            $scope.school = data;
                            $state.go('base.step_two');
                        });

                    }, function () {
                        console.log('error occurred');
                    });
                };


                $scope.nextStepThree = function () {
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
                        $state.go('base.step_three');

                    }, function () {
                        console.log('error occurred');
                    });
                }

                $scope.nextStepFour = function () {
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
                            $state.go('base.step_four');

                        }, function () {
                            console.log('error occurred');
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

var app = angular.module('UnifySchoolApp.Controllers', []);
/**
 * Created by kaso on 11/6/2014.
 */

var app = angular.module('UnifySchoolApp.directives', []);

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
//# sourceMappingURL=main.js.map