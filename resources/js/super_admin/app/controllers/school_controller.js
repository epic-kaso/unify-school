App.controller('SchoolController', ['$scope', 'SchoolsDataService', 'ngTableParams', 'TableDataService', 'SchoolService', 'toaster',
                    function ($scope, SchoolsDataService, ngTableParams, ngTableDataService, SchoolService, toaster) {
                        $scope.schools = SchoolService.query({});//SchoolsDataService.schools;
                        $scope.tableParams = new ngTableParams({
                            page: 1,            // show first page
                            count: 10           // count per page
                        }, {
                            total: 0,           // length of data
                            counts: [],         // hide page counts control
                            getData: function ($defer, params) {
                                ngTableDataService.getData($defer, params);
                            }
                        });

                        $scope.UpdateSchoolActiveState = function (school) {
                            school.updating = true;
                            SchoolService.update({
                                id: school.id,
                                action: 'updateActiveState'
                            }, {'active': school.active}).$promise
                                .then(function (data) {
                                    school.updating = false;
                                }, function (data) {
                                    toaster.pop('error', 'Schoo; Active State', 'Failed to change school\'s active state.');
                                    school.updating = false;
                                });
                        };
                        $scope.selectAllSchool = function (newV) {

                            console.log('selectAllSchool change: ' + newV);
                            angular.forEach($scope.tableParams.data, function (value, key) {
                                value.$selected = newV;
                                console.log(value);
                            });
                        }
                    }]);

App.controller('ViewSchoolController',[
    '$scope','school','modules','SchoolService','toaster','$state',
    function($scope,school,modules,SchoolService,toaster,$state){
        $scope.school = school;
        $scope.modules = modules;

        if(angular.isUndefined($scope.school.modules) || $scope.school.modules === null || $scope.school.modules.length <= 0) {
            $scope.school.modules = {};
        }

        $scope.saveSchool =  function(school){
            SchoolService.updateModules(school,function(response){
                toaster.pop('success','School','Saved Successfully');
            },function(data){
                toaster.pop('error','School','Failed');
            });
        };

        $scope.deleteSchool =  function(school){
            school.deleting = true;
            console.log(school);
            SchoolService.delete({id: school.id},function(response){
                toaster.pop('success','School','Deleted Successfully');
                school.deleting = false;
                $state.go('app.schools');
            },function(){
                toaster.pop('error','School','Failed');
                school.deleting = false;
            })
        };
}]);