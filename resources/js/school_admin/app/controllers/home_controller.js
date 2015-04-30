/**
 * Created by Ak on 4/7/2015.
 */

App.controller('HomeController',['$scope','SchoolDataService','$window','$rootScope','SchoolService','toaster',
    function ($scope,SchoolDataService,$window,$rootScope,SchoolService,toaster) {
        $scope.school = SchoolDataService.school;
        console.log($scope.school);

        $rootScope.$on('SCHOOL_CONTEXT_CHANGED',function(event,obj){
            console.log('I hear ya @ HomeController');
        });
        
        $scope.updateFirstTimeLoginState = function(){
            SchoolService.updateFirstTimeLoginState({id: $scope.school.id},{}).$promise.then(function(){
                $scope.$emit('refreshSchoolData'); 
            },function(){
                toaster.pop('error', "School Status Update", "Failed Saving changes");
            });
        }

        $scope.$on('refreshSchoolDataComplete',function(){
            $scope.school = SchoolDataService.school;
        });
    }]
);

