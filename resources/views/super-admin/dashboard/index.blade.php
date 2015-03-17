@extends('super-admin.dashboard.layout')

@section('script')
    document.data = {};
    document.data.schools = {!! $schools->toJson() !!};
    document.data.adminUser = {!! Auth::user()->toJson() !!};


    angular.module('SuperAdminApp')
    .factory('SchoolsDataService',[function(){
    return document.data;
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