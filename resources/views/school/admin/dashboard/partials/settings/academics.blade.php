<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Grades Settings</h3><hr/>
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
                            <div id="rowinfo">
                                <accordion>
                                    <accordion-group ng-repeat="gradingSystem in gradingSystems">
                                        <accordion-heading>
                                            <span class="display_box" ng-hide="gradingSystem.edit">
                                                @{{ gradingSystem.name }}
                                                <button class="btn btn-default btn-xs"
                                                        ng-click="setGradingSystemEditMode($event,gradingSystem,true)">Rename</button>
                                            </span>
                                            <span class="edit-box" style="display: inline-block;width: 320px;" ng-show="gradingSystem.edit">
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
                                            <div ng-repeat="grade in gradingSystem.grades" class="row" style="padding-top:10px">
                                                <section class="col-sm-3">
                                                    <label class="input">
                                                        <input type="text"  ng-model="grade.symbol" class="form-control" placeholder="eg A, C5, B3">
                                                    </label>
                                                </section>
                                                <section class="col-sm-2">
                                                    <label class="select">
                                                        <select class="form-control from-range" ng-model="grade.lowerRange">
                                                            @for($i = 0;$i <= 100;$i++ )
                                                                <option ng-if="grade.lowerRange == {{ $i }}" selected>{{ $i }}</option>
                                                                <option ng-if="grade.lowerRange != {{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </label>
                                                </section>
                                                <section class="col-sm-2">
                                                    <label class="select">
                                                        <select class="form-control to-range" ng-model="grade.upperRange">
                                                            @for($i = 0;$i <= 100;$i++ )
                                                                <option ng-if="grade.upperRange == {{ $i }}" selected>{{ $i }}</option>
                                                                <option ng-if="grade.upperRange != {{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </label>
                                                </section>
                                                <section class="col-sm-4">
                                                    <label class="input">
                                                        <input type="text" ng-model="grade.remark" class="form-control" placeholder="eg excellent">
                                                    </label>
                                                </section>
                                                <section class="col-sm-1">
                                            <span class="shutdown" ng-click="removeGrade(gradingSystem,$index)" style="cursor: pointer; text-decoration: underline;">
                                                <i class="fa fa-times"></i>
                                            </span>
                                                </section>
                                            </div>
                                                <div class="row" style="margin-top: 15px;">
                                                    <div class="col-sm-4 text-center">
                                                        <button class="btn btn-warning" ng-click="addGrade(gradingSystem)">Add Grade</button>
                                                        <button class="btn btn-success" ng-click="saveGradingSystemChanges(gradingSystem)">Save Changes</button>
                                                    </div>
                                                </div>
                                        </div>
                                    </accordion-group>
                                </accordion>

                                <div>
                                    <button class="btn btn-primary" ng-click="addNewGradingSystem()" ng-disabled="isAddingNewGradingSystem" >
                                        Add New Grading System
                                        <span class="icon-reload fa fa-spin" ng-show="isAddingNewGradingSystem"></span>
                                    </button>
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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="row">
                                <section class="col col-3">
                                    <label class="select">
                                        <select id="cad">
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option selected="">3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <i></i>
                                    </label>
                                </section>
                                <section class="col col-3">
                                    <label class="select">
                                        <select id="cas">
                                            <option>0</option>
                                            <option>10</option>
                                            <option>20</option>
                                            <option>30</option>
                                            <option selected="">40</option>
                                            <option>50</option>
                                            <option>60</option>
                                            <option>70</option>
                                            <option>80</option>
                                            <option>90</option>
                                            <option>100</option>
                                        </select><i></i>
                                    </label>
                                </section>
                                <section class="col col-3">
                                    <label class="input">
                                        <input type="text" name="exam" id="exam" readonly="">
                                    </label>
                                </section>
                                <section class="col col-3">
                                    <span class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></span>
                                </section>
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