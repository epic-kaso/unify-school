@extends('school.admin.dashboard.layout')

@section('script')
    document.data = {};
    document.data.school = {!! $school->toJson() !!};

    angular.module('SchoolAdminApp')
    .factory('SchoolDataService',[function(){
    return document.data;
    }]);
@stop

@section('navbar')
    @if(count($school->school_type->school_categories) > 1)
        <li><a href="#">All</a></li>
    @endif
    @foreach($school->school_type->school_categories as $category)
        <li><a href="#" ng-click="prepareSchoolCategory({{ $category->id }})">{{ $category->display_name }}</a></li>
    @endforeach
@stop
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-4">
                <div class="list-group">
                    <a class="list-group-item" href="">Students</a>
                    <a class="list-group-item" href="">Classes</a>
                    <a class="list-group-item" href="">Academics</a>
                    <a class="list-group-item" href="">Reports</a>
                </div>
            </div>

            <div class="col-sm-8">
                <div ui-view></div>
            </div>
        </div>
    </div>
@endsection
