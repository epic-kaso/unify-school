/**
 * Created by Ak on 4/7/2015.
 */

App.controller('HomeController',['$scope','SchoolDataService','$window',
    function ($scope,SchoolDataService,$window) {
        $scope.school = SchoolDataService.school;
        console.log($scope.school);
    }]
);