/**
 * Created by Ak on 2/19/2015.
 */
var app = angular.module("SchoolAdminApp",
    [
        'ngSanitize',
        'ui.bootstrap',
        'ui.router',
        'ngAnimate',
        'ngResource',
        'angular-loading-bar',
        'SchoolAdminApp.directives',
        'SchoolAdminApp.controllers',
        'SchoolAdminApp.services',
        'ngCookies'
    ]
);

app.constant('ViewBaseURL', '/admin/dashboard/partial');

app.config(['$urlRouterProvider', '$stateProvider', 'ViewBaseURL',
    function ($urlRouterProvider, $stateProvider, ViewBaseURL) {

        $stateProvider.state('home',
            {
                url: '/',
                templateUrl: ViewBaseURL + '/home',
                controller: ['$scope', 'SchoolDataService', function ($scope, SchoolDataService) {
                    $scope.school = SchoolDataService.school;

                    $scope.schoolCategoryClasses = $scope.school.school_type.school_categories[0].school_category_arms;
                    console.log($scope.schoolCategoryClasses);

                    $scope.$on('selectedSchoolCategoryChanged', function ($event, data) {
                        console.log('selectedSchoolCategoryChanged occured');
                        console.log(data);
                    })
                }]
            }
        );

        $urlRouterProvider.otherwise('/');
    }]);

app.factory('sessionInjector', ['$location', function ($location) {
    return {
        request: function (config) {
            config.headers['X-Requested-With'] = 'XMLHttpRequest';
            console.log('Header modified');
            return config;
        },
        responseError: function (response) {
            if (response.status == 401) {
                location.href = '/admin/auth/login';
                return response;
            }
            return response;
        },
        response: function (response) {
            if (response.status == 401) {
                location.href = '/admin/auth/login';
                return response;
            }
            return response;
        }
    };
}]);

app.config(['$httpProvider', function ($httpProvider) {
    $httpProvider.interceptors.push('sessionInjector');
}]);

app.run(['$http', '$rootScope', 'CSRF_TOKEN',
    function ($http, $rootScope, CSRF_TOKEN) {
        $rootScope.CSRF_TOKEN = CSRF_TOKEN;
        $http.defaults.headers.common['csrf_token'] = CSRF_TOKEN;
    }]);


