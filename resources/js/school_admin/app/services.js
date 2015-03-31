
App.factory('GradingSystemService', ['$resource', function ($resource) {
    return $resource('/admin/resources/grading-systems/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'assignGradingSystem': {method: 'POST',params: {'action': 'assignGradingSystem'}},
        'getAssignedGradingSystem': {method: 'GET',params: {'action': 'assignGradingSystem'}}
    });
}]);

App.factory('GradeAssessmentSystemService', ['$resource', function ($resource) {
    return $resource('/admin/resources/grade-assessment-systems/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'assignGradeAssessmentSystem': {method: 'POST',params: {'action': 'assignGradeAssessmentSystem'}},
        'getAssignedGradeAssessmentSystem': {method: 'GET',params: {'action': 'assignGradeAssessmentSystem'}}
    });
}]);


App.service('TableDataService', ['SchoolDataService', function (SchoolDataService) {

    var TableData = {
        cache: SchoolDataService.schools,
        getData: function ($defer, params) {

            filterdata($defer, params);

            function filterdata($defer, params) {
                var from = (params.page() - 1) * params.count();
                var to = params.page() * params.count();
                var filteredData = TableData.cache.slice(from, to);

                params.total(TableData.cache.length);
                $defer.resolve(filteredData);
            }

        }
    };

    return TableData;

}]);

App.factory('SchoolService', ['$resource', function ($resource) {
    return $resource('/admin/resources/school/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });
}]);