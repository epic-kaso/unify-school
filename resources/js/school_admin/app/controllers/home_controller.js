/**
 * Created by Ak on 4/7/2015.
 */

App.controller('HomeController',['$scope','SchoolDataService','$window','$rootScope',
    function ($scope,SchoolDataService,$window,$rootScope) {
        $scope.school = SchoolDataService.school;
        console.log($scope.school);

        $rootScope.$on('SCHOOL_CONTEXT_CHANGED',function(event,obj){
            console.log('I hear ya @ HomeController');
        });
    }]
);

