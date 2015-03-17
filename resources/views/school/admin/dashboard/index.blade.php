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
    <div class="btn-group" dropdown>
        <button type="button" class="btn btn-danger navbar-btn"><span
                    ng-bind="selectedSchoolCategory.display_name"></span></button>
        <button type="button" class="btn btn-danger navbar-btn dropdown-toggle" dropdown-toggle>
            <span class="caret"></span>
            <span class="sr-only">Split button!</span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li ng-if="schoolCategories.length > 1">
                <a href="#">All</a>
            </li>
            <li ng-repeat="category in schoolCategories">
                <a href="#" ng-click="prepareSchoolCategory($event,category)">@{{ category.display_name }}</a>
            </li>
        </ul>
    </div>
@stop
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-4" ng-controller="SideBarController">
                <accordion close-others="true">
                    <accordion-group is-open="Classes.status.open">
                        <accordion-heading>
                            Classes <span class="fa pull-right"
                                          ng-class="{'fa-chevron-down': Classes.status.open,'fa-chevron-right': !Classes.status.open}"></span>
                        </accordion-heading>

                        <div class="list-group">
                            <a class="list-group-item" href=""
                               ng-repeat="class in schoolCategoryClasses">@{{ class.display_name }}</a>
                        </div>
                    </accordion-group>

                    <accordion-group is-open="Students.status.open">
                        <accordion-heading>
                            Students <span class="fa pull-right"
                                           ng-class="{'fa-chevron-down': Students.status.open,'fa-chevron-right': !Students.status.open}"></span>
                        </accordion-heading>

                        <div class="list-group">
                            <a class="list-group-item" href="">Students</a>
                            <a class="list-group-item" href="">Classes</a>
                            <a class="list-group-item" href="">Academics</a>
                            <a class="list-group-item" href="">Reports</a>
                        </div>
                    </accordion-group>

                    <accordion-group is-open="Academics.status.open">
                        <accordion-heading>
                            Academics <span class="fa pull-right"
                                            ng-class="{'fa-chevron-down': Academics.status.open,'fa-chevron-right': !Academics.status.open}"></span>
                        </accordion-heading>

                        <div class="list-group">
                            <a class="list-group-item" href="">Students</a>
                            <a class="list-group-item" href="">Classes</a>
                            <a class="list-group-item" href="">Academics</a>
                            <a class="list-group-item" href="">Reports</a>
                        </div>
                    </accordion-group>

                    <accordion-group is-open="Reports.status.open">
                        <accordion-heading>
                            Reports <span class="fa pull-right"
                                          ng-class="{'fa-chevron-down': Reports.status.open,'fa-chevron-right': !Reports.status.open}"></span>
                        </accordion-heading>

                        <div class="list-group">
                            <a class="list-group-item" href="">Students</a>
                            <a class="list-group-item" href="">Classes</a>
                            <a class="list-group-item" href="">Academics</a>
                            <a class="list-group-item" href="">Reports</a>
                        </div>
                    </accordion-group>
                </accordion>
            </div>

            <div class="col-sm-8">
                <div ui-view></div>
            </div>
        </div>
    </div>
@endsection
