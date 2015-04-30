<div class="col-sm-8 col-sm-offset-2">
    <!-- START panel-->
    <div class="panel panel-default">
        <div class="panel-body">
            <form form-wizard="" validate-steps="true" validate-form="" steps="4">
                <div class="form-wizard wizard-horizontal">
                    <!-- START wizard steps indicator-->
                    <ol class="row">
                        <li ng-class="{'active':wizard.active(1)}" ng-click="wizard.go(1)" class="col-md-3">
                            <h4>Welcome</h4>
                            <small class="text-muted">Unify's School Project</small>
                        </li>
                        <li ng-class="{'active':wizard.active(2)}" ng-click="wizard.go(2)" class="col-md-3">
                            <h4>1st Setup</h4>
                            <small class="text-muted">Quick configurations</small>
                        </li>
                        <li ng-class="{'active':wizard.active(3)}" ng-click="wizard.go(3)" class="col-md-3">
                            <h4>2nd Setup</h4>
                            <small class="text-muted">Quick configurations</small>
                        </li>
                        <li ng-class="{'active':wizard.active(4)}" ng-click="wizard.go(4)" class="col-md-3">
                            <h4>Done!</h4>
                            <small class="text-muted">All done, please proceed.</small>
                        </li>
                    </ol>
                    <!-- END wizard steps indicator-->
                    <!-- START Wizard Step inputs -->
                    <div id="step1" ng-show="wizard.active(1)">
                        <div class="row" style="margin-top: 50px;">
                            <div class="col-sm-12">
                                <h4>Introduction</h4>
                                <hr/>
                            </div>
                            <div class="col-sm-3 text-center">
                                <span class="fa fa-5x fa-bell-o"></span>
                            </div>

                            <div class="col-sm-9">
                                <p>
                                    In vulputate mattis ipsum vitae vehicula. Praesent at arcu non arcu convallis pellentesque.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    In vulputate mattis ipsum vitae vehicula. Praesent at arcu non arcu convallis pellentesque.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    In vulputate mattis ipsum vitae vehicula. Praesent at arcu non arcu convallis pellentesque.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <span class="btn btn-labeled btn-default pull-right"
                                   ng-click="wizard.go(2)">Next
                                    <span class="btn-label btn-label-right">
                                       <i class="fa fa-arrow-right"></i>
                                   </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- END Wizard Step inputs -->
                    <!-- START Wizard Step inputs -->
                    <div id="step2" ng-show="wizard.active(2)">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Academic Settings</h4>
                            </div>
                            <div class="col-sm-12" ng-controller="SettingsAcademicsController">
                                <table class="table">
                                    <tr>
                                        <td><label>Create a Default Grading system</label></td>
                                        <td>
                                            <button ng-show="gradingSystems.data.length <= 0"
                                                    class="btn btn-primary" ng-click="addNewGradingSystem()" >Create</button>

                                            <span ng-show="gradingSystems.data.length > 0" class="alert" style="color: #27c24c"><span class="fa fa-lg fa-check"></span></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label>Create a Default Grade Assessment System</label></td>
                                        <td>
                                            <button ng-show="gradeAssessmentSystems.data.length <= 0" class="btn btn-primary" ng-click="addNewGradeAssessmentSystem()">Create</button>

                                            <span ng-show="gradeAssessmentSystems.data.length > 0" class="alert" style="color: #27c24c"><span class="fa fa-lg fa-check"></span></span>
                                        </td>
                                    </tr>

                                    {{--<tr>--}}
                                        {{--<td><label>Create a Default Behaviour Assessment System</label></td>--}}
                                        {{--<td><button class="btn btn-primary">Create</button></td>--}}
                                    {{--</tr>--}}
                                </table>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">


                                <span class="btn btn-labeled btn-default pull-left"
                                      ng-click="wizard.go(1)">
                                    <span class="btn-label btn-label-right">
                                       <i class="fa fa-arrow-left"></i>
                                   </span> Previous
                                </span>

                                <span class="btn btn-labeled btn-default pull-right"
                                     ng-disabled="(gradingSystems.data.length <= 0) || (gradeAssessmentSystems.data.length <= 0)"
                                      ng-click="wizard.go(3)">Next
                                    <span class="btn-label btn-label-right">
                                       <i class="fa fa-arrow-right"></i>
                                   </span>
                                </span>
                            </div>
                        </div>

                    </div>
                    <!-- END Wizard Step inputs -->
                    <!-- START Wizard Step inputs -->
                    <div id="step3" ng-show="wizard.active(3)">
                        <div class="row">
                            <div class="col-sm-12" ng-controller="SettingsSessionTermController">
                                <div class="col-sm-12">
                                    <h4>Session & Term Settings</h4>
                                </div>
                                <div class="col-sm-12">
                                    <table class="table">
                                        <tr>
                                            <td><label>Set current session</label></td>
                                            <td ng-hide="!sessions || sessions.length <= 0">
                                                <span class="alert" style="color: #27c24c"><span class="fa fa-lg fa-check"></span></span>
                                            </td>
                                            <td ng-show="!sessions || sessions.length <= 0">
                                                <select
                                                        ng-change="saveCurrentSessionTerm(current)"
                                                        ng-model="current.current_session"
                                                        class="form-control" ng-options="session.name as session.name for session in sessions">
                                                    <option value="">Select Session</option>
                                                </select>
                                            </td>
                                            <td ng-show="!sessions || sessions.length <= 0">
                                                <button title="Add New Session"
                                                        ng-dialog="addNewSessionDialog.html"
                                                        ng-dialog-class="ngdialog-theme-default"
                                                        ng-dialog-controller="AddSessionDialogController"
                                                        ng-dialog-close-previous
                                                        class="btn btn-default btn-xs"><span class="fa fa-plus"></span></button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><label>Select current term</label></td>
                                            <td ng-hide="!sub_sessions || sub_sessions.length <= 0">
                                                <span class="alert" style="color: #27c24c"><span class="fa fa-lg fa-check"></span></span>
                                            </td>
                                            <td ng-show="!sub_sessions || sub_sessions.length <= 0">
                                                <select ng-change="saveCurrentSessionTerm(current)"
                                                        ng-model="current.current_sub_session"
                                                        class="form-control" ng-options="session.id as session.name for session in sub_sessions">
                                                    <option value="">Select Term</option>
                                                </select>
                                            </td>
                                            <td ng-show="!sub_sessions || sub_sessions.length <= 0">
                                                <button title="Add New Term" class="btn btn-default btn-xs"><span class="fa fa-plus"></span></button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">

                                <span class="btn btn-labeled btn-default pull-left"
                               
                                      ng-click="wizard.go(2)">
                                    <span class="btn-label btn-label-right">
                                       <i class="fa fa-arrow-left"></i>
                                   </span>
                                    Previous
                                </span>

                                <span class="btn btn-labeled btn-default pull-right"
                                      ng-disabled="sessions.length <= 0"
                                      ng-click="wizard.go(4)">Next
                                    <span class="btn-label btn-label-right">
                                       <i class="fa fa-arrow-right"></i>
                                   </span>
                                </span>
                            </div>
                        </div>

                    </div>
                    <!-- END Wizard Step inputs -->
                    <!-- START Wizard Step inputs -->
                    <div id="step4" ng-show="wizard.active(4)">
                        <div class="jumbotron">
                            <h1>Done!</h1>
                            <p>Your school setup is complete, you can now enjoy the unify school plaform.</p>
                            <p>
                                <button type="button" class="btn btn-info btn-lg" ng-click="updateFirstTimeLoginState()">You can Proceed Now</button>
                            </p>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">

                                <span class="btn btn-labeled btn-default pull-left"
                                      ng-click="wizard.go(3)">
                                    <span class="btn-label btn-label-right">
                                       <i class="fa fa-arrow-left"></i>
                                   </span>
                                    Previous
                                </span>

                            </div>
                        </div>
                    </div>
                    <!-- END Wizard Step inputs -->
                </div>
            </form>
        </div>
    </div>
    <!-- END panel -->
</div>

<toaster-container toaster-options="{'close-button': true, 'position-class': 'toast-top-right' }"></toaster-container>