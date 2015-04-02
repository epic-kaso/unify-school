<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Courses Settings</h3><hr/>
    </div>
    <div class="panel-body">
        <tabset justified="false" type="pills">
            <tab>
                <tab-heading>
                    Assign Courses
                </tab-heading>
                <div class="row" style="margin-top: 10px">
                    <div class="col-sm-6">
                        <h3>Assign Courses to categories</h3>
                        <hr/>
                        <div class="form-group">
                            <label>Select School Category</label>
                            <select name="import_session" class="form-control" ng-model="assign.school_category"
                                    ng-options="system as system.name for system in school_categories">
                                <option value="">Select School Category</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <button class="btn btn-info btn-xs pull-right">Assign</button>
                                <strong>All Courses</strong>
                            </div>
                            <div class="panel-body">
                                <select multiple="" size="15" class="" style="width:100%">
                                    <option value="1">ENGLISH</option>
                                    <option value="2">MATHEMATICS</option>
                                    <option value="7">AGRIC</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <button class="btn btn-danger btn-xs pull-right">Remove</button>
                                <strong>Assigned Courses</strong>
                            </div>
                            <div class="panel-body">
                                <select multiple="" size="15" class="" style="width:100%">
                                    <option value="1">ENGLISH</option>
                                    <option value="2">MATHEMATICS</option>
                                    <option value="7">AGRIC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </tab>
            <tab>
                <tab-heading>
                    Add New Courses
                </tab-heading>
                <div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div style="margin-top: 20px">
                                <h3>Add New Course</h3>
                                <hr/>
                                <div class="form-group col-sm-6">
                                    <select class="form-control" ng-model="course.school_category"
                                            ng-options="system as system.name for system in school_categories">
                                        <option value="">Select School Category</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <select class="form-control" ng-model="course.course_category"
                                            ng-options="system as system.name for system in course.school_category.scoped_course_categories">
                                        <option value="">Select Course Category</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control" ng-model="course.name" placeholder="Course Name"/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control" ng-model="course.code" placeholder="Course Code"/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <button
                                            class="btn btn-success"
                                            ng-click="createCourse(course)">
                                        Add Course
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h3>Manage Courses</h3>
                            <hr/>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <select class="form-control" ng-model="current_school_cat_name"
                                            ng-options="system.name as system.name for system in school_categories">
                                        <option value="">All</option>
                                    </select>
                                </li>
                                <li class="list-group-item" ng-repeat="course in courses">
                                    <span class="btn pull-right"><i class="fa fa-times"></i></span>
                                    <strong>@{{ course.name }}</strong>
                                    <p>@{{ course.code }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </tab>
            <tab>
                <tab-heading>
                    Add New Course Category
                </tab-heading>
                <div class="row">
                    <div class="col-sm-12">
                        <div style="margin-top: 20px">
                            <h3>Add New Course Category</h3>
                            <hr/>
                            <div class="form-group col-sm-4">
                                <select class="form-control" ng-model="school_category_id"
                                        ng-options="system.id as system.name for system in school_categories">
                                    <option value="">Select School Category</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="text" class="form-control" ng-model="course_category_name" placeholder="Course Category Name"/>
                            </div>
                            <div class="form-group col-sm-4">
                                <button
                                        class="btn btn-success"
                                        ng-click="createCourseCategory(school_category_id,course_category_name)">
                                    Add Course Category
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h3>Manage Course Categories</h3>
                        <hr/>

                        <ul class="list-group">
                            <li class="list-group-item">
                                <select class="form-control" ng-model="current_school_cat_name"
                                        ng-options="system.name as system.name for system in school_categories">
                                    <option value="">All</option>
                                </select>
                            </li>
                            <li class="list-group-item" ng-repeat="course_category in course_categories">
                                <span class="btn pull-right"><i class="fa fa-times"></i></span>
                                <strong>@{{ course_category.name }}</strong>
                                <p>@{{ course_category.scoped_school_category.display_name }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </tab>
        </tabset>

    </div>
</div>
<toaster-container toaster-options="{'close-button': true, 'position-class': 'toast-top-right' }"></toaster-container>