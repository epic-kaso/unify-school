/**
 * Created by Ak on 2/19/2015.
 */
var module = angular.module('SchoolAdminApp.controllers', ['SchoolAdminApp.services']);

module.controller('NavBarController', [
        '$scope', '$rootScope', 'SchoolDataService',
        function ($scope, $rootScope, SchoolDataService) {
            $scope.schoolCategories = SchoolDataService.school.school_type.school_categories;
            $scope.selectedSchoolCategory = $scope.schoolCategories[0];

            $scope.prepareSchoolCategory = function ($event, category) {
                $scope.selectedSchoolCategory = category;
                $event.preventDefault();
        };

            $scope.$watch('selectedSchoolCategory', function (newV, oldV) {
                console.log('selectedSchoolCategoryChanged event');
                $rootScope.$emit('selectedSchoolCategoryChanged', {value: newV});
                console.log('selectedSchoolCategoryChanged raised');
        });
        }]
);


module.controller('SideBarController', ['$scope', 'SchoolDataService', function ($scope, SchoolDataService) {
    $scope.school = SchoolDataService.school;

    $scope.schoolCategoryClasses = $scope.school.school_type.school_categories[0].school_category_arms;
    console.log($scope.schoolCategoryClasses);

    $scope.$on('selectedSchoolCategoryChanged', function ($event, data) {
        console.log('selectedSchoolCategoryChanged occured');
        console.log(data);
    })
}]);