@extends('school.admin.dashboard.layout')

@section('script')
    document.data = {};
    document.data.school = {!! $school->toJson() !!};

    angular.module('SchoolAdminApp')
    .factory('SchoolDataService',[function(){
    return document.data;
    }]).factory('ResourcesService',[function(){
    return {
    getMenuResourceUrl: function(){
    return '/admin/resources/menu';
    }
    }
    }]);
@stop

@section('content')
    <div data-ui-view="" data-autoscroll="false" class="wrapper">
        <div class="text-center" style="margin-top: 25%">
            <h1><span class="fa fa-spin fa-spinner fa-lg"></span> Loading..</h1>
        </div>
    </div>
@endsection
