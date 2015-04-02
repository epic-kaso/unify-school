App.factory('SchoolService', ['$resource', function ($resource) {
    return $resource('/admin/resources/school/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });
}]);

//
App.factory('CategoryClassSettingsService', ['$resource', function ($resource) {
    return $resource('/admin/resources/category-class-settings/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'addCategory': {method: 'POST',params: {'action': 'school_category'}},
        'addCategoryArm': {method: 'POST',params: {'action': 'school_category_arms'}},
        'addCategoryArmSubDivision': {method: 'POST',params: {'action': 'school_category_arm_subarms'}},
        'removeCategory': {method: 'DELETE',params: {'action': 'school_category'}},
        'removeCategoryArm': {method: 'DELETE',params: {'action': 'school_category_arms'}},
        'removeCategoryArmSubDivision': {method: 'DELETE',params: {'action': 'school_category_arm_subarms'}},
        'removeAllCategoryArmSubDivisions': {method: 'DELETE',params: {'action': 'remove_all_school_category_arm_subarms'}},
        'getAssignedGradingSystem': {method: 'GET',params: {'action': 'assignGradingSystem'}}
    });
}]);

App.factory('GradingSystemService', ['$resource', function ($resource) {
    return $resource('/admin/resources/grading-systems/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'assignGradingSystem': {method: 'POST',params: {'action': 'assignGradingSystem'}},
        'getAssignedGradingSystem': {method: 'GET',params: {'action': 'assignGradingSystem'}}
    });
}]);

//
App.factory('CoursesSettingsService', ['$resource', function ($resource) {
    return $resource('/admin/resources/courses-settings/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'getCourseCategory': {method: 'GET',params: {'action': 'add_course_category'},'isArray': true},
        'addCourseCategory': {method: 'POST',params: {'action': 'add_course_category'}},
        'removeCourseCategory': {method: 'DELETE',params: {'action': 'add_course_category'}}
    });
}]);


App.factory('GradeAssessmentSystemService', ['$resource', function ($resource) {
    return $resource('/admin/resources/grade-assessment-systems/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'assignGradeAssessmentSystem': {method: 'POST',params: {'action': 'assignGradeAssessmentSystem'}},
        'getAssignedGradeAssessmentSystem': {method: 'GET',params: {'action': 'assignGradeAssessmentSystem'}}
    });
}]);


App.factory('BehaviourAssessmentSystemService', ['$resource', function ($resource) {
    return $resource('/admin/resources/behaviour-assessment-systems/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });
}]);

App.factory('SkillAssessmentSystemService', ['$resource', function ($resource) {
    return $resource('/admin/resources/skill-assessment-systems/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });
}]);

App.factory('SessionTermsSettingsService', ['$resource', function ($resource) {
    return $resource('/admin/resources/sessions-terms-settings/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'saveSubSessionDates': {method: 'POST',params: {'action': 'sub_session_start_and_end_dates'}},
        'addSubSession': {method: 'POST',params: {'action': 'add_sub_session'}},
        'removeSubSession': {method: 'DELETE',params: {'action': 'add_sub_session'}}
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