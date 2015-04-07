/**
 * Created by Ak on 4/5/2015.
 */
App.config(['$stateProvider', '$locationProvider', '$urlRouterProvider', 'RouteHelpersProvider', 'ViewBaseURL',
    function ($stateProvider, $locationProvider, $urlRouterProvider, helper, ViewBaseURL) {
        'use strict';

        // Set the following to true to enable the HTML5 Mode
        // You may have to set <base> tag in index and a routing configuration in your server
        $locationProvider.html5Mode(false);

        // default route
        $urlRouterProvider.otherwise('/app/schools');

        //
        // Application Routes
        // -----------------------------------


        $stateProvider
            .state('app', {
                url: '/app',
                abstract: true,
                templateUrl: ViewBaseURL + '/ui/app',
                controller: 'AppController',
                resolve: helper.resolveFor('modernizr', 'icons', 'toaster')
            })
            .state('app.schools',
            {
                url: '/schools',
                templateUrl: ViewBaseURL + '/schools/schools_list',
                title: 'Schools',
                resolve: helper.resolveFor('ngTable', 'ngTableExport'),
                controller: 'SchoolController'
            })
            .state('app.show_school',
            {
                url: '/schools/{id}',
                templateUrl: ViewBaseURL + '/schools/view',
                title: 'School',
                resolve: {
                    'school': function(SchoolService,$stateParams){
                        return SchoolService.get({id: $stateParams.id});
                    },
                    'modules': function(ModuleService){
                        return ModuleService.query({});
                    }
                },
                controller: 'ViewSchoolController'
            })
            .state('app.modules',
            {
                url: '/modules',
                template: '<div ui-view></div>' +
                '<toaster-container toaster-options="{\'close-button\': true, \'position-class\': \'toast-top-right\' }">' +
                '</toaster-container>',
                title: 'Modules',
                abstract: true,
                resolve: helper.resolveFor('toaster'),
                controller: 'ModulesController'
            })
            .state('app.modules.list',
            {
                url: '/list',
                templateUrl: ViewBaseURL + '/modules/list',
                title: 'Modules'
            })
            .state('app.modules.add',
            {
                url: '/add',
                templateUrl: ViewBaseURL + '/modules/new',
                title: 'Add Module'
            }
        );
        //
        // CUSTOM RESOLVES
        //   Add your own resolves properties
        //   following this object extend
        //   method
        // -----------------------------------
        // .state('app.someroute', {
        //   url: '/some_url',
        //   templateUrl: 'path_to_template.html',
        //   controller: 'someController',
        //   resolve: angular.extend(
        //     helper.resolveFor(), {
        //     // YOUR RESOLVES GO HERE
        //     }
        //   )
        // })
        ;


    }])