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
                                <button class="btn btn-info btn-xs pull-right"
                                        ng-click="assignCourses(
                                        assign.school_category.id,
                                        assign.school_category.assigned_courses,
                                        assign.courses_to_assign)"
                                        >Assign</button>
                                <strong>All Courses</strong>
                            </div>
                            <div class="panel-body">
                                <select multiple="" size="15" class="form-control" style="width:100%"  ng-model="assign.courses_to_assign"
                                        ng-options="system as system.name for system in assign.school_category.scoped_courses">
                                    <option value="">Select Course Category</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <button class="btn btn-danger btn-xs pull-right"
                                        ng-click="unAssignCourses(
                                        assign.school_category.id,
                                        assign.school_category.assigned_courses,
                                        assign.courses_to_unassign)">Remove</button>
                                <strong>Assigned Courses</strong>
                            </div>
                            <div class="panel-body">
                                <select multiple="" size="15" class="form-control" style="width:100%" ng-model="assign.courses_to_unassign"
                                        ng-options="system as system.name for system in assign.school_category.assigned_courses">
                                    <option value="">Select Course Category</option>
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
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="form-group col-sm-6">
                                            <strong>Choose School Category:</strong>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <select ng-disabled="course.saving"
                                                    class="form-control" ng-model="current_school_category"
                                                    ng-options="system as system.name for system in school_categories">
                                                <option value="">Select School Category</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="panel-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <select ng-disabled="course.saving"
                                                                    class="form-control" ng-model="course.course_category"
                                                                    ng-options="system as system.name for system in current_school_category.scoped_course_categories">
                                                                <option value="">Select Course Category</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        <div class="form-group">
                                                            <input ng-disabled="course.saving" type="text" class="form-control" ng-model="course.name" placeholder="Course Name"/>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input ng-disabled="course.saving" type="text" class="form-control" ng-model="course.code" placeholder="Course Code"/>
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        <div class="form-group col-sm-6">
                                                            <button 
                                                                    ng-disabled="!current_school_category || !course.course_category || !course.name || !course.code"
                                                                    class="btn btn-success"
                                                                    ng-click="course.school_category = current_school_category;coursesToAdd.push(course);course = {}">
                                                                <span ng-show="!course.saving">Add Course</span>
                                                               
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <tr>
                                                    <td>Course Name</td>
                                                    <td>Course Code</td>
                                                    <td>Course Category</td>
                                                    <td>School Category</td>
                                                </tr>
                                                
                                                <tr  ng-show="!coursesToAdd || coursesToAdd.length < 1">
                                                    <td colspan="4" class="text-center"> <span class="fa fa-info"></span> No Course to be Added.</td>
                                                </tr>
                                                
                                                <tr ng-repeat="course in coursesToAdd">
                                                    <td>@{{ course.name }}</td>
                                                    <td>@{{ course.code }}</td>
                                                    <td>@{{ course.course_category.name }}</td>
                                                    <td>@{{ course.school_category.name }}</td>
                                                </tr>
                                            </tbody>
                                            
                                        </table>
                                        <div>
                                            <span ng-show="courses_saving">
                                                <span class="fa fa-spin fa-spinner"></span> Loading..
                                            </span>
                                            <button ng-disabled="!coursesToAdd || coursesToAdd.length < 1" class="btn btn-primary"  ng-click="saveCourses(coursesToAdd)">Save Courses</button>
                                        </div>
                                    </div>
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
                                <select ng-disabled="course_category_model.saving"
                                        class="form-control" ng-model="school_category_id"
                                        ng-options="system.id as system.name for system in school_categories">
                                    <option value="">Select School Category</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="text" ng-disabled="course_category_model.saving"
                                       class="form-control" ng-model="course_category_model.name"
                                       placeholder="Course Category Name"/>
                            </div>
                            <div class="form-group col-sm-4">
                                <button
                                        class="btn btn-success"
                                        ng-click="createCourseCategory(school_category_id,course_category_model)">
                                    <span ng-show="!course_category_model.saving">
                                        Add Course Category
                                    </span>
                                    <span ng-show="course_category_model.saving">
                                        <span class="fa fa-spin fa-spinner"></span> Loading..
                                    </span>
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
                                <span class="btn pull-right">
                                    <span ng-show="!course_category.saving">
                                        <i class="fa fa-times"></i>
                                    </span>
                                    <span ng-show="course_category.saving">
                                        <span class="fa fa-spin fa-spinner"></span> Loading..
                                    </span>
                                </span>
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