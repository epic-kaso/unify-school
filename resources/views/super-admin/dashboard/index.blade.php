@extends('super-admin.dashboard.layout')

@section('script')
    document.data = {};
    document.data.schools = {!! $schools->toJson() !!};

    angular.module('SuperAdminApp')
    .factory('SchoolsDataService',[function(){
    return document.data;
    }]);
@stop

@section('navbar')
    <li><a href="#">Home</a></li>
@stop
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-4">
                <div class="list-group">
                    <a class="list-group-item" href="">Schools</a>
                </div>
            </div>

            <div class="col-sm-8">
                <div ui-view></div>
            </div>
        </div>
    </div>
@endsection