var app = angular.module('SchoolAdminApp');

app.controller('StudentsImportController',['$scope','SchoolDataService',
    function ($scope,SchoolDataService) {

        console.log(SchoolDataService.school.school_type.school_categories);

        $scope.current_school_classes = null;
        $scope.school_categories = SchoolDataService.school.school_type.school_categories;
        $scope.sessions = getSessionsFrom(SchoolDataService);

        $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
        $scope.form = {
            school_category: null
        };

        $scope.$watch('form.school_category',function(newV,oldV){
            setCurrentSchoolClassesForSchoolType(newV);
        });

        function getSessionsFrom(SchoolDataService){
            return SchoolDataService.school.sessions.sort(function(a,b){
                if (a.name < b.name) {
                    return -1;
                }
                if (a.name > b.name) {
                    return 1;
                }
                return 0;
            });
        }


        function setCurrentSchoolClassesForSchoolType(newV){
            var school_type = null;
            angular.forEach($scope.school_categories,function(value,key){
                if(value.id == newV){
                    school_type = value;
                    return ;
                }
            });

            if(angular.isDefined(school_type) && school_type != null){
                $scope.current_school_classes = school_type.classes;
            }
        }

    }
]);