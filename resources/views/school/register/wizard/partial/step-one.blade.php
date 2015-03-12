<div class="col-sm-10 col-sm-offset-1">
    <h3>Basic Information</h3>
    <hr/>
    <div class="form-group">
        <input type="text" required placeholder="School Name in Full" name="name" ng-model="school.name"
               class="form-control inmate-search-box"/>
    </div>

    <div class="form-group evaluate">
        <label>Select School Type</label>
        <select class="form-control" required ng-model="school.selected_school_type">
            <option value="@{{ $index }}"
                    ng-repeat="school_type in school.school_types">@{{ school_type.display_name }}</option>
        </select>
    </div>

    <div class="form-group" ng-show="school.school_types[school.selected_school_type].session != null">
        <label>Session System</label>

        <div>
            <ul class="list-group">
                <li class="list-group-item">
                    @{{
                    school.school_types[school.selected_school_type].session.session_type + ' '+
                    school.school_types[school.selected_school_type].session.session_divisions_display_name+' '+
                    school.school_types[school.selected_school_type].session.session_display_name
                    }}
                    <span class="btn btn-xs btn-primary pull-right" ng-hide="onEdit"
                          ng-click="onEdit = true">Edit</span>

                    <div ng-show="onEdit">
                        <div class="form-group">
                            <label>Session Division</label>
                            <select class="form-control" id=""
                                    ng-model="school.school_types[school.selected_school_type].session.session_type">
                                <option value="one">One</option>
                                <option value="two">Two</option>
                                <option value="three">Three</option>
                                <option value="four">Four</option>
                                <option value="five">Five</option>
                                <option value="six">Six</option>
                                <option value="seven">Seven</option>
                                <option value="eight">Eight</option>
                                <option value="nine">Nine</option>
                                <option value="ten">Ten</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Session Sub-division Name</label>
                            <input type="text" class="form-control"
                                   ng-model="school.school_types[school.selected_school_type].session.session_divisions_display_name"/>
                        </div>
                        <div>
                            <span class="btn btn-info" ng-click="onEdit = false">Save</span>
                        </div>
                    </div>

                </li>
            </ul>
        </div>
    </div>

    <div class="form-group" ng-show="school.selected_school_type != ''">
        <div>
            <label>Select all supported school types</label>
            <ul class="list-group">
                <li class="list-group-item">
                    Add more.. <span class="btn btn-xs btn-primary pull-right" ng-hide="onAddSchoolType"
                                     ng-click="onAddSchoolType = true">Add</span>
                    <span class="btn btn-xs btn-primary pull-right" ng-show="onAddSchoolType"
                          ng-click="onAddSchoolType = false">Hide</span>

                    <div ng-show="onAddSchoolType">
                        <div class="form-group">
                            <label>Category Title</label>
                            <input type="text" class="form-control" ng-model="school_category_name"/>
                        </div>
                        <div>
                                    <span class="btn btn-info"
                                          ng-click="
                                          addCategory(school.selected_school_type,school_category_name);
                                          onAddSchoolType = false;
                                          school_category_name = null;
                                          ">
                                        Save
                                    </span>
                        </div>
                    </div>
                </li>
                <li
                        ng-repeat="school_category in school.school_types[school.selected_school_type].school_categories"
                        class="list-group-item">
                    <span class="school_category_title">@{{ school_category.display_name }}</span>
                    <span class="btn btn-xs btn-danger pull-right"
                          ng-click="removeCategory(school.selected_school_type,$index)">Remove</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="col-sm-12" style="padding: 0">
        <div class="form-group">
            <button class="btn btn-info pull-right" ng-click="next()">Next</button>
        </div>
    </div>
</div>