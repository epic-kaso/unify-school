@extends('school.admin.dashboard.layout')

@section('assets')
    <script>
        {!! $assets !!}
    </script>
@stop
@section('script')
<script>

    angular.module('SchoolAdminApp')
    .factory('SchoolDataService',[ '$rootScope','SchoolService', function($rootScope,SchoolService){

        var data = {};
        data.school = {!! $school->toJson() !!};

        $rootScope.$on('refreshSchoolData',
            function(evt){
                 SchoolService.get({id: data.school.id},
                        function(response){
                            data.school = response;
                            console.log('school successfully refreshed');
                            $rootScope.$broadcast('refreshSchoolDataComplete');
                        },
                        function(){
                            console.log('could not refresh school data');
                        }
                 );
        });

        data.getCourseCategories = function(){
            return data.school.school_type.school_categories;
        };
    return data;
    }])
    .factory('ResourcesService',[function(){
        return {
            getMenuResourceUrl: function(){
             return '/admin/resources/menu';
            }
        }
    }]);
</script>
@stop

@section('content')
    <div data-ui-view="" data-autoscroll="false" class="wrapper">
        <div class="text-center" style="margin-top: 25%">
            <h1><span class="fa fa-spin fa-spinner fa-lg"></span> Loading..</h1>
        </div>
    </div>
@endsection
