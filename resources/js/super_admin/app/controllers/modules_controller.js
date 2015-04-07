App.controller('ModulesController',
    ['$scope', 'ModuleService', 'toaster','SchoolSetupService',
    function ($scope,ModuleService, toaster,SchoolSetupService) {
        $scope.modules = ModuleService.query();

        SchoolSetupService.get({},function(response){
            $scope.school_types = response.school.school_types;
        },function(data){
            alert('reload page please');
        });

        $scope.removeModule = function (school) {
        };
        $scope.addNewModule = function (module) {
            ModuleService.save(module,function(response){
                toaster.pop('success','Module Settings','Added');
            },function(response){
                toaster.pop('error','Module Settings','Failed to add');
            })
        };
        $scope.deactivateModule = function (module) {
        };
        $scope.updateModule = function (module) {
        };

    }]
);