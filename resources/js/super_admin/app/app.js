/**
 * Created by Ak on 2/19/2015.
 */
var app = angular.module("SuperAdminApp",
    [
        'ngSanitize',
        'ui.bootstrap',
        'ui.router',
        'ngAnimate',
        'ngResource',
        'angular-loading-bar',
        'SuperAdminApp.directives',
        'SuperAdminApp.controllers',
        'SuperAdminApp.services',
        'ngCookies'
    ]
);

app.constant('ViewBaseURL', '/unify/dashboard/partial');

app.config(['$urlRouterProvider', '$stateProvider', 'ViewBaseURL',
    function ($urlRouterProvider, $stateProvider, ViewBaseURL) {

        $stateProvider.state('schools',
            {
                url: '/schools',
                templateUrl: ViewBaseURL + '/schools_list',
                controller: ['$scope', 'SchoolsDataService', function ($scope, SchoolsDataService) {
                    $scope.schools = SchoolsDataService.schools;
                }]
            }
        );

        $urlRouterProvider.otherwise('/schools');
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
                location.href = '/unify/auth/login';
                return response;
            }
            return response;
        },
        response: function (response) {
            if (response.status == 401) {
                location.href = '/unify/auth/login';
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
        }]
);


