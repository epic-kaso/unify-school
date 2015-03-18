@extends('school.student.dashboard.layout')

@section('script')
    document.data = {};

    angular.module('StudentApp')
    .factory('ResourcesService',[function(){
    return {
    getMenuResourceUrl: function(){
    return '/student/resources/menu';
    }
    }
    }]);
@stop

@section('content')
    <div data-ui-view="" data-autoscroll="false" class="wrapper">
    </div>
@endsection
