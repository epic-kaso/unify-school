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
                }

                $scope.nextStepTwo = function () {
                    $state.go('base.step_two');
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