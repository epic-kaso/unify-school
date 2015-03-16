/**
 * Created by Ak on 2/19/2015.
 */
var app = angular.module("SchoolAdminApp",
    [
        'ngSanitize',
        'ui.bootstrap',
        'ui.router',
        'ngUpload',
        'ngAnimate',
        'ngResource',
        'angular-loading-bar',
        'SchoolAdminApp.directives',
        'SchoolAdminApp.controllers',
        'SchoolAdminApp.services',
        'ngCookies'
    ]
);

app.config(['$urlRouterProvider', '$stateProvider',
    function ($urlRouterProvider, $stateProvider) {

        $stateProvider.state('home',
            {
                url: '/',
                templateUrl: 'partials/device_models/dashboard.html',
                controller: ['$scope', 'SchoolDataService', function ($scope, SchoolDataService) {
                    $scope.school = SchoolDataService.school;
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


