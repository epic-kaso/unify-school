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
                            <h4>Configure Grading Systems</h4>
                            <hr/>
                            <div id="rowinfo">
                                <accordion>
                                    <accordion-group ng-if="gradingSystems.loading">
                                        <accordion-heading>
                                            <span class="fa fa-spin fa-spinner"></span> Loading..
                                        </accordion-heading>
                                    </accordion-group>

                                    <accordion-group ng-if="gradingSystems.empty">
                                        <accordion-heading>
                                            <span class="fa fa-question-circle"></span> No Grading System Added yet
                                        </accordion-heading>
                                    </accordion-group>

                                    <accordion-group ng-repeat="gradingSystem in gradingSystems.data" is-open="gradingSystem.accordionState">
                                        <accordion-heading>
                                            <span class="display_box" ng-hide="gradingSystem.edit">
                                                <span class="fa"
                                                      ng-class="{
                                                      'fa-minus': gradingSystem.accordionState,
                                                      'fa-plus': !gradingSystem.accordionState
                                                      }" ng-attr-tooltip="@{{ gradingSystem.accordionState ? 'Click to close' : 'Click to Expand' }}">
                                                </span>
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
                                            <span class="pull-right" ng-show="gradingSystem.deleting">
                                                <span class="fa fa-spin fa-spinner"></span> Deleting..
                                            </span>
                                            <span class="pull-right"
                                                  ng-show="!gradingSystem.deleting"
                                                  tooltip="Delete Grading System"
                                                  ng-click="gradingSystem.deleting = true;deleteGradingSystem($event,gradingSystems.data,$index)">
                                                <i class="fa fa-times"></i>
                                            </span>
                                        </accordion-heading>
                                        <div class="batch">
                                            <form name="GradeForm@{{ $index }}">
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
                                                        <input type="number" 
                                                        ng-model="grade.lowerRange"
                                                        class="form-control from-range" >
                                                    </label>
                                                </section>
                                                <section class="col-sm-2">
                                                    <label class="select">
                                                        <input type="number" 
                                                        class="form-control to-range"
                                                        ng-model="grade.upperRange">
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
                                                            ng-disabled="GradeForm@{{ $index }}.$invalid"
                                                            ng-click="saveGradingSystemChanges(gradingSystem)">Save
                                                        Changes
                                                    </button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </accordion-group>
                                </accordion>
                                <div>
                                    <span ng-show="gradingSystems.isAddingNewGradingSystem"> 
                                            <span class="fa fa-spin fa-spinner"></span> Adding New Grading System..
                                    </span>
                                </div>
                                <div>
                                    <button ng-hide="gradingSystems.isAddingNewGradingSystem" class="btn btn-primary" 
                                            ng-click="addNewGradingSystem()"
                                            >
                                        Add New Grading System

                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="row" style="margin-top: 50px">
                            <h4>Assign Grading Systems</h4>
                            <hr/>
                            <div class="row">
                                <div class="col-sm-4" ng-repeat="schoolCategory in schoolCategories">
                                    <div class="form-group">
                                        <label>@{{ schoolCategory.display_name }} Grading System</label>
                                        <select class="form-control" required
                                                ng-disabled="gradingSystems.loading"
                                                ng-model="assignedGradingSystem[schoolCategory.name]"
                                                ng-options="system.id as system.name for system in gradingSystems.data">
                                            <option value="">Select Grading System</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <button class="btn btn-success"
                                            ng-click="saveAssignedGradingSystem(assignedGradingSystem)">Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tab>
            <tab>
                <tab-heading>
                    Continuous Assessment System
                </tab-heading>
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <h4>Configure Grade Assessment Systems</h4>
                            <hr/>
                            <div id="rowinfo">
                                <accordion>
                                     <accordion-group ng-if="gradeAssessmentSystems.loading">
                                        <accordion-heading>
                                            <span class="fa fa-spin fa-spinner"></span> Loading..
                                        </accordion-heading>
                                    </accordion-group>

                                    <accordion-group ng-if="gradeAssessmentSystems.empty">
                                        <accordion-heading>
                                            <span class="fa fa-question-circle"></span> No Continous Assessment System Added yet
                                        </accordion-heading>
                                    </accordion-group>

                                    <accordion-group ng-repeat="gradeAssessmentSystem in gradeAssessmentSystems.data" is-open="gradeAssessmentSystem.accordionState">
                                        <accordion-heading>
                                            <span class="display_box" ng-hide="gradeAssessmentSystem.edit">
                                                <span class="fa"
                                                      ng-class="{
                                                      'fa-minus': gradeAssessmentSystem.accordionState,
                                                      'fa-plus': !gradeAssessmentSystem.accordionState
                                                      }" ng-attr-tooltip="@{{ gradeAssessmentSystem.accordionState ? 'Click to close' : 'Click to Expand' }}">
                                                </span> 
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
                                            <span class="pull-right" ng-show="gradeAssessmentSystem.deleting">
                                                <span class="fa fa-spin fa-spinner"></span> Deleting..
                                            </span>
                                            <span class="pull-right"
                                                    ng-show="!gradeAssessmentSystem.deleting"
                                                  ng-click="gradeAssessmentSystem.deleting = true;deleteGradeAssessmentSystem($event,gradeAssessmentSystems.data,$index)">
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
                                            <div class="row" style="padding-top:10px" ng-show="gradeAssessmentSystem.errors.sum">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="alert alert-danger">
                                                        <p>The Sum of All Division's Max Score Must be equal to Total Grand Score.</p>
                                                    </div>
                                                </div>
                                            </div>
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
                                                        <input type="number"
                                                               ng-maxlength="gradeAssessmentSystem.total_score"
                                                               class="form-control from-range" ng-model="grade.score">
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
                                <div ng-show="gradeAssessmentSystems.isAddingNewGradeAssessmentSystem">
                                    <span class="fa fa-spin fa-spinner"></span> Adding..
                                </div>
                                <div ng-show="!gradeAssessmentSystems.isAddingNewGradeAssessmentSystem">
                                    <button class="btn btn-primary" ng-click="addNewGradeAssessmentSystem()">
                                        Add New Grade Assessment System
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="row" style="margin-top: 50px">
                            <h4>Assign Grade Assessment Systems</h4>
                            <hr/>
                            <div class="row">
                                <div class="col-sm-4" ng-repeat="schoolCategory in schoolCategories">
                                    <div class="form-group">
                                        <label>Set @{{ schoolCategory.display_name }} Assessment</label>
                                        <select class="form-control" required
                                                ng-disabled="gradeAssessmentSystems.loading"
                                                ng-model="assignedGradeAssignmentSystem[schoolCategory.name]"
                                                ng-options="system.id as system.name for system in gradeAssessmentSystems.data">
                                            <option value="">Select Grade Assessment System</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <button class="btn btn-success"
                                            ng-click="saveAssignedGradeAssessmentSystem(assignedGradeAssignmentSystem)">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tab>
            <tab>
                <tab-heading>
                    Behaviour Assessment System
                </tab-heading>
                <div style="margin-top: 20px">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group" ng-init="cognitive_assessment = 'behaviour'">
                                <label ng-model="cognitive_assessment" btn-radio="'behaviour'" class="btn btn-primary">Behaviour</label>
                                <label ng-model="cognitive_assessment" btn-radio="'skill'"
                                       class="btn btn-primary">Skill</label>
                            </div>
                        </div>

                        <div class="col-sm-12" ng-if="cognitive_assessment == 'behaviour'">
                            <h3>Add New Behaviour</h3>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> Select Category</label>
                                        <select class="form-control" ng-model="behaviour.behaviour_category_id"
                                                ng-options="system.id as system.name for system in behaviourCategories">
                                            <option value="">Select Behaviour Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Enter Behaviour Name</label>

                                        <div class="input-group">
                                            <input ng-disabled="behaviour.adding" id="domain" class="form-control" type="text"
                                                   placeholder="Behaviour Name" ng-model="behaviour.name">
                                                 <span class="input-group-btn">
                                                      <button ng-show="!behaviour.adding" class="btn btn-primary" ng-click="addBehaviour(behaviour)">
                                                          <i class="fa fa-plus"></i> Add
                                                      </button>
                                                      <button class="btn btn-primary" disabled   ng-show="behaviour.adding"> 
                                                        <span class="fa fa-spin fa-spinner"></span> Adding..
                                                      </button>
                                                 </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h3>Current Behaviours</h3>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="list-group">
                                        <li class="list-group-item" ng-repeat="item in behaviours">
                                            <div>
                                                <span class="pull-right">
                                                    <button ng-show="!item.removing" class="btn btn-xs btn-danger" ng-click="removeBehaviour(item)"><span class="fa fa-times"></span></button>
                                                    <span  ng-show="item.removing"> 
                                                        <span class="fa fa-spin fa-spinner"></span> Removing..
                                                    </span>
                                                </span>
                                                <h4>@{{ item.name }}</h4>
                                                <p>@{{ item.behaviour_category.name }}</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>


                        <div class="col-sm-12" ng-if="cognitive_assessment == 'skill'">
                            <h3>Add New Skill</h3>
                            <hr>
                            <div class="form-group">
                                <label>Select Domain Type </label>

                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> Select Category</label>
                                        <select class="form-control" ng-model="skill.skill_category_id"
                                                ng-options="system.id as system.name for system in skillCategories">
                                            <option value="">Select Skill Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Enter Skill Name</label>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <input ng-disabled="skill.adding" id="domain" class="form-control" type="text"
                                                       placeholder="Skill Name" ng-model="skill.name">
                                                 <span class="input-group-btn">
                                                     <button ng-hide="skill.adding" class="btn btn-primary" ng-click="addSkill(skill)">
                                                         <i class="fa fa-plus"></i> Add
                                                     </button>
                                                     <button class="btn btn-primary" disabled ng-show="skill.adding"> 
                                                        <span class="fa fa-spin fa-spinner"></span> Adding..
                                                    </button>
                                                 </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h3>Current Skills</h3>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="list-group">
                                        <li class="list-group-item" ng-repeat="item in skills">
                                            <div>
                                                <span class="pull-right">
                                                    <button ng-show="!item.removing" class="btn btn-xs btn-danger" ng-click="removeSkill(item)">
                                                        <span class="fa fa-times"></span>
                                                    </button>

                                                    <span  ng-show="item.removing"> 
                                                        <span class="fa fa-spin fa-spinner"></span> Removing..
                                                    </span>

                                                </span>
                                                <h4>@{{ item.name }}</h4>
                                                <p>@{{ item.skill_category.name }}</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </tab>
        </tabset>

    </div>
</div>

<toaster-container toaster-options="{'close-button': true, 'position-class': 'toast-top-right' }"></toaster-container>