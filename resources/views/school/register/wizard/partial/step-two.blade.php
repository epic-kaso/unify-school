<div class="col-sm-10 col-sm-offset-1">
    <h3>School Types Setup</h3>
    <hr/>


    <div class="form-group"
         ng-repeat="school_category in school.school_type.school_categories">
        <div class="panel">
            <div class="panel-heading">
                <h3>@{{ school_category.display_name }}</h3>
            </div>
            <div class="panel-body">
                <label>Configure Levels</label>
                <ul class="list-group">
                    <li class="list-group-item">
                        Add more.. <span class="btn btn-xs btn-primary pull-right" ng-hide="onAddCategoryArmType"
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
                                          addArm(school_category.school_category_arms,school_arm_name);
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
                              ng-click="removeArm(school_category.school_category_arms,$index)">Remove</span>
                        <label class="pull-right" style="margin-right: 20px;">Has Arms? <input type="checkbox"
                                                                   ng-model="school_arm.has_arms"/></label>

                        <div class="row" ng-show="school_arm.has_arms">
                            <div class="form-group col-sm-12">
                                <label class="sm">How Many Arms?</label>
                                <select ng-model="school_arm.arms_count"
                                        ng-change="createArms(school_arm.display_name,school_arm,school_arm.arms_count)"
                                        required class="form-control sm">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                </select>
                            </div>

                            <div ng-if="school_arm.arms_count > 0">
                                <div ng-repeat="arm in school_arm.arms">
                                    <div class="col-sm-4">
                                        <label class="sm">@{{ $index + 1 }}.   @{{ school_arm.display_name }}</label>
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <input type="text" ng-model="arm.display_name" required
                                               placeholder="Arm Name e.g (A)"
                                               class="form-control sm"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{--<div class="row">--}}

    {{--<div class="col-sm-6"  ng-repeat="school_category in school.school_types[school.selected_school_type - 1].school_categories">--}}
    {{--<div class="panel">--}}
    {{--<div class="panel-heading">--}}
    {{--<h4>@{{ school_category.display_name }}</h4>--}}
    {{--</div>--}}

    {{--<div class="panel-body" style="padding: 0">--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    <div class="row">
        <div class="col-sm-12" style="padding: 0">
            <div class="form-group">
                <button class="btn btn-info pull-right" ng-click="nextStepThree()">Next</button>
            </div>
        </div>
    </div>
</div>