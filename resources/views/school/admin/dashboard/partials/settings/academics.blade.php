<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Grades Settings</h3>
        <hr/>
    </div>
    <div class="panel-body">
        <tabset justified="false" type="pills">
            <tab>
                <tab-heading>
                    Grading System
                </tab-heading>
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <h4>Configure Grading Systems</h4><hr/>
                            <div id="rowinfo">
                                <accordion>
                                    <accordion-group ng-repeat="gradingSystem in gradingSystems">
                                        <accordion-heading>
                                            <span class="display_box" ng-hide="gradingSystem.edit">
                                                @{{ gradingSystem.name }}
                                                <button class="btn btn-default btn-xs"
                                                        ng-click="setGradingSystemEditMode($event,gradingSystem,true)">
                                                    Rename
                                                </button>
                                            </span>
                                            <span class="edit-box" style="display: inline-block;width: 320px;"
                                                  ng-show="gradingSystem.edit">
                                                <input style="width: 250px;display: inline-block" type="text"
                                                       ng-model="gradingSystem.name"
                                                       ng-click="preventDefaultAction($event)"
                                                       class="form-control"/>
                                                <span class="btn btn-default"
                                                      style="width: 60px"
                                                      ng-click="setGradingSystemEditMode($event,gradingSystem,false)">Save</span>
                                            </span>
                                            <span class="pull-right"
                                                  ng-click="deleteGradingSystem($event,gradingSystems,$index)">
                                                <i class="fa fa-times"></i>
                                            </span>
                                        </accordion-heading>
                                        <div class="batch">
                                            <div class="row" style="padding-top:10px">
                                                <section class="col-sm-3 text-center">
                                                    <label>
                                                        <span class="form-control-static">Symbol</span>
                                                    </label>
                                                </section>
                                                <section class="col-sm-4 text-center">
                                                    <label>
                                                        <span class="form-control-static">Score Range</span>
                                                    </label>
                                                </section>
                                                <section class="col-sm-4 text-center">
                                                    <label>
                                                        <span class="form-control-static">Remark</span>
                                                    </label>
                                                </section>
                                                <section class="col-sm-1 text-center">

                                                </section>
                                            </div>
                                            <div ng-repeat="grade in gradingSystem.grades" class="row"
                                                 style="padding-top:10px">
                                                <section class="col-sm-3">
                                                    <label class="input">
                                                        <input type="text" ng-model="grade.symbol" class="form-control"
                                                               placeholder="eg A, C5, B3">
                                                    </label>
                                                </section>
                                                <section class="col-sm-2">
                                                    <label class="select">
                                                        <select class="form-control from-range"
                                                                ng-model="grade.lowerRange">
                                                            @for($i = 0;$i <= 100;$i++ )
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </label>
                                                </section>
                                                <section class="col-sm-2">
                                                    <label class="select">
                                                        <select class="form-control to-range"
                                                                ng-model="grade.upperRange">
                                                            @for($i = 0;$i <= 100;$i++ )
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </label>
                                                </section>
                                                <section class="col-sm-4">
                                                    <label class="input">
                                                        <input type="text" ng-model="grade.remark" class="form-control"
                                                               placeholder="eg excellent">
                                                    </label>
                                                </section>
                                                <section class="col-sm-1">
                                            <span class="shutdown" ng-click="removeGrade(gradingSystem,$index)"
                                                  style="cursor: pointer; text-decoration: underline;">
                                                <i class="fa fa-times"></i>
                                            </span>
                                                </section>
                                            </div>
                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-sm-4 text-center">
                                                    <button class="btn btn-warning" ng-click="addGrade(gradingSystem)">
                                                        Add Grade
                                                    </button>
                                                    <button class="btn btn-success"
                                                            ng-click="saveGradingSystemChanges(gradingSystem)">Save
                                                        Changes
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </accordion-group>
                                </accordion>

                                <div>
                                    <button class="btn btn-primary" ng-click="addNewGradingSystem()"
                                            ng-disabled="isAddingNewGradingSystem">
                                        Add New Grading System
                                        <span class="icon-reload fa fa-spin" ng-show="isAddingNewGradingSystem"></span>
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="row" style="margin-top: 50px">
                            <h4>Assign Grading Systems</h4><hr/>
                            <div class="row">
                                <div class="col-sm-4" ng-repeat="schoolCategory in schoolCategories">
                                    <div class="form-group">
                                        <label>@{{ schoolCategory.display_name }} Grading System</label>
                                        <select class="form-control" required  ng-model="assignedGradingSystem[schoolCategory.name]"
                                                ng-options="system.id as system.name for system in gradingSystems">
                                            <option value="">Select Grading System</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </tab>
            <tab>
                <tab-heading>
                    <em class="icon-equalizer fa-sm"></em> Continuous Assessment System
                </tab-heading>
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div id="rowinfo">
                                <accordion>
                                    <accordion-group ng-repeat="gradeAssessmentSystem in gradeAssessmentSystems">
                                        <accordion-heading>
                                            <span class="display_box" ng-hide="gradeAssessmentSystem.edit">
                                                @{{ gradeAssessmentSystem.name }}
                                                <button class="btn btn-default btn-xs"
                                                        ng-click="setGradeAssessmentEditMode($event,gradeAssessmentSystem,true)">
                                                    Rename
                                                </button>
                                            </span>
                                            <span class="edit-box" style="display: inline-block;width: 320px;"
                                                  ng-show="gradeAssessmentSystem.edit">
                                                <input style="width: 250px;display: inline-block" type="text"
                                                       ng-model="gradeAssessmentSystem.name"
                                                       ng-click="preventDefaultAction($event)"
                                                       class="form-control"/>
                                                <span class="btn btn-default"
                                                      style="width: 60px"
                                                      ng-click="setGradeAssessmentEditMode($event,gradeAssessmentSystem,false)">Save</span>
                                            </span>
                                            <span class="pull-right"
                                                  ng-click="deleteGradeAssessmentSystem($event,gradeAssessmentSystems,$index)">
                                                <i class="fa fa-times"></i>
                                            </span>
                                        </accordion-heading>
                                        <div class="batch">
                                            <div class="row" style="padding-top:10px"
                                                 ng-init="gradeAssessmentSystem.total_divisions = gradeAssessmentSystem.divisions.length ">
                                                <section class="col-sm-4 text-center">
                                                    <label>
                                                        <span class="form-control-static">Number of Grade Divisions</span>
                                                    </label>
                                                    <input type="text" ng-model="gradeAssessmentSystem.total_divisions"
                                                           ng-change="updateGradeDivisions(gradeAssessmentSystem.total_divisions,gradeAssessmentSystem)"
                                                           class="form-control"/>
                                                </section>
                                                <section class="col-sm-4 text-center">
                                                    <label>
                                                        <span class="form-control-static">Total Grade Score</span>
                                                    </label>
                                                    <input type="text" ng-model="gradeAssessmentSystem.total_score"
                                                           class="form-control"/>
                                                </section>
                                                <div class="col-sm-4">

                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row" style="padding-top:10px">
                                                <section class="col-sm-4 text-center">
                                                    <label>
                                                        <span class="form-control-static">Division Name</span>
                                                    </label>
                                                </section>
                                                <section class="col-sm-4 text-center">
                                                    <label>
                                                        <span class="form-control-static">Division Max Score</span>
                                                    </label>
                                                </section>
                                                <div class="col-sm-4">

                                                </div>
                                            </div>
                                            <div ng-repeat="grade in gradeAssessmentSystem.divisions" class="row"
                                                 style="padding-top:10px">
                                                <section class="col-sm-4">
                                                    <label class="input">
                                                        <input type="text" ng-model="grade.name" class="form-control"
                                                               placeholder="Test 1, Exam etc">
                                                    </label>
                                                </section>
                                                <section class="col-sm-4">
                                                    <label class="select">
                                                        <input type="number" ng-maxlength="gradeAssessmentSystem.total_score" class="form-control from-range" ng-model="grade.score">
                                                    </label>
                                                </section>
                                                <section class="col-sm-4">
                                                    <span class="shutdown"
                                                          ng-click="removeDivision(gradeAssessmentSystem,$index)"
                                                          style="cursor: pointer; text-decoration: underline;">
                                                        <i class="fa fa-times"></i>
                                                    </span>
                                                </section>
                                            </div>
                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-sm-8">
                                                    <button class="btn btn-warning"
                                                            ng-click="addDivision(gradeAssessmentSystem)">Add Division
                                                    </button>
                                                    <button class="btn btn-success"
                                                            ng-click="saveGradeAssessmentSystemChanges(gradeAssessmentSystem)">
                                                        Save Changes
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </accordion-group>
                                </accordion>

                                <div>
                                    <button class="btn btn-primary" ng-click="addNewGradeAssessmentSystem()"
                                            ng-disabled="isAddingNewGradeAssessmentSystem">
                                        Add New Grade Assessment System
                                        <span class="icon-reload fa fa-spin"
                                              ng-show="isAddingNewGradeAssessmentSystem"></span>
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="row" style="margin-top: 50px">
                            <h4>Assign Grade Assessment Systems</h4><hr/>
                            <div class="row">
                                <div class="col-sm-4" ng-repeat="schoolCategory in schoolCategories">
                                    <div class="form-group">
                                        <label>Set @{{ schoolCategory.display_name }} Assessment</label>
                                        <select class="form-control" required  ng-model="assignedGradeAssessmentSystem[schoolCategory.name]"
                                                ng-options="system.id as system.name for system in gradeAssessmentSystems">
                                            <option value="">Select Grade Assessment System</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </tab>
            <tab>
                <tab-heading>
                    <em class="fa-gear fa-sm"></em> Behaviour Assessment System
                </tab-heading>
                <div>
                    Coming soon..
                </div>
            </tab>
        </tabset>

    </div>
</div>