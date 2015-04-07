/**
 * Created by Ak on 4/5/2015.
 */
App.service('TableDataService', ['SchoolsDataService', function (SchoolsDataService) {

    var TableData = {
        cache: SchoolsDataService.schools,
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