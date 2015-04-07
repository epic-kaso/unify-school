App.factory('SchoolService', ['$resource', function ($resource) {
    return $resource('/unify/resources/school/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'updateModules': {method: 'PUT', params: {action: 'updateModules'}}
    });
}]);


App.factory('SchoolSetupService', ['$resource', function ($resource) {
    return $resource('/resources/school-setup/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });
}]);

App.factory('ModuleService', ['$resource', function ($resource) {
    return $resource('/unify/resources/modules/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });
}]);