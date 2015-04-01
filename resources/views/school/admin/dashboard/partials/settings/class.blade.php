<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Classes Settings</h3>
        <hr/>
    </div>
    <div class="panel-body">
        <tabset justified="false" type="pills">
            <tab>
                <tab-heading>
                    Manage School Categories
                </tab-heading>
                <div class="row">
                    <div class="col-sm-12" style="margin-top: 20px;">
                        <h3>Add School Category</h3><hr/>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <input type="text" placeholder="Enter School Category Name" class="form-control" ng-model="school_category_name"/>
                            </div>
                            <div class="form-group col-sm-2">
                                <button class="btn btn-info"
                                      ng-click="
                                      addSchoolCategory(school.school_type,school_category_name);
                                      school_category_name = null;
                                      ">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <h3>Manage School Categories</h3><hr/>
                        <div class="form-group"
                             ng-repeat="school_category in school.school_type.school_categories">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4>
                                        @{{ school_category.display_name }}
                                        <span class="btn btn-xs btn-default pull-right"
                                              ng-click="removeSchoolCategory(school.school_type,$index)">
                                            <i class="fa fa-times"></i> Remove Category
                                        </span>
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <label>Manage Levels</label>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            Add more.. <span class="btn btn-xs btn-primary pull-right"
                                                             ng-hide="onAddCategoryArmType"
                                                             ng-click="onAddCategoryArmType = true">Add</span>
                                            <span class="btn btn-xs btn-primary pull-right" ng-show="onAddCategoryArmType"
                                                  ng-click="onAddCategoryArmType = false">Hide</span>

                                            <div ng-show="onAddCategoryArmType">
                                                <div class="form-group">
                                                    <label>Category Title</label>
                                                    <input type="text" class="form-control" ng-model="school_arm_name"/>
                                                </div>
                                                <div>
                                    <span class="btn btn-info"
                                          ng-click="
                                          addArm(school_category,school_arm_name);
                                          onAddCategoryArmType = false;
                                          school_arm_name = null;
                                          ">
                                        Save
                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li
                                                ng-repeat="school_arm in school_category.school_category_arms"
                                                class="list-group-item">
                                            <span class="school_category_title">@{{ school_arm.display_name }}</span>

                        <span class="btn btn-xs btn-danger pull-right"
                              ng-click="removeArm(school_category.school_category_arms,$index)">Remove Arm</span>
                                            <label class="pull-right" style="margin-right: 20px;">Has Arms? <input
                                                        type="checkbox"
                                                        ng-model="school_arm.has_subdivisions"/></label>

                                            <div class="row" ng-show="school_arm.has_subdivisions">
                                                <div class="form-group col-sm-12">
                                                    <button ng-click="createArmSubdivision(school_arm.display_name,school_arm)"
                                                            class="btn btn-sm btn-warning">Add Arm
                                                    </button>
                                                </div>

                                                <div ng-if="school_arm.school_category_arm_subdivisions.length > 1">
                                                    <div ng-repeat="arm in school_arm.school_category_arm_subdivisions">
                                                        <div class="form-group col-sm-8">
                                                            <input type="text" ng-model="arm.display_name" required
                                                                   placeholder="Arm Name e.g (A)"
                                                                   class="form-control sm"/>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <span class="btn btn-xs pull-right" style="color: red;"
                                                                  ng-click="removeArmSubDivision(school_arm.school_category_arm_subdivisions,$index)">
                                                                <i class="fa fa-times"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <button class="btn btn-success btn-sm" ng-click="saveArmSubDivision(school_arm,$index)">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tab>
            <tab>
                <tab-heading>
                    Manage Classes
                </tab-heading>
                <div>
                </div>
            </tab>
        </tabset>

    </div>
</div>
<toaster-container toaster-options="{'close-button': true, 'position-class': 'toast-top-right' }"></toaster-container>