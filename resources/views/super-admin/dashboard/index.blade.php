@extends('super-admin.dashboard.layout')

@section('script')
    angular.module('SuperAdminApp')
    .factory('SchoolsDataService',[ '$rootScope','SchoolService', function($rootScope,SchoolService){

        var data = {};
        data.schools = {!! $schools->toJson() !!};

        $rootScope.$on('refreshSchoolsData',
            function(evt){
                 SchoolService.query({},
                        function(response){
                            data.schools = response;
                            console.log('schools successfully refreshed');
                            $rootScope.$broadcast('refreshSchoolsDataComplete');
                        },
                        function(){
                            console.log('could not refresh school data');
                        }
                 );
        });
    return data;
    }])
    .factory('ResourcesService',[function(){
    return {
    getMenuResourceUrl: function(){
    return '/unify/resources/menu';
    }
    }
    }]);
@stop

@section('content')
    <div data-ui-view="" data-autoscroll="false" class="wrapper">
    </div>
@endsection