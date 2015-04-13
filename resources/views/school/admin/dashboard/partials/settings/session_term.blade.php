<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Session & Term Settings</h3>
        <hr/>
    </div>
    <div class="panel-body">
        <tabset justified="false" type="pills">
            <tab>
                <tab-heading>
                    Current Session & Term
                </tab-heading>
                <div class="row">
                    <div class="col-sm-12">
                        <h3>Set Current Session & term</h3>
                        <hr/>
                        <div class="row">
                            <div class="form-group col-sm-5">
                                <label>Set Current Session</label>
                                <input type="text" placeholder="2014/2015"
                                       class="form-control"
                                       ng-model="current.current_session"
                                       masked=""
                                       ng-disabled="current.saving || current.loading"
                                       data-inputmask="'mask': '9999/9999'"/>
                            </div>
                            <div class="form-group col-sm-5">
                                <label>Select Current Term</label>
                                <select name="import_session"
                                        ng-disabled="current.saving || current.loading"
                                        class="form-control"
                                        ng-model="current.current_sub_session"
                                        ng-options="sub_session.id as sub_session.name for sub_session in sub_sessions">
                                    <option value="">Select Term</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-2">

                            </div>
                            <div class="col-sm-4">
                                <button ng-disabled="current.saving" class="btn btn-success btn-sm" ng-click="saveCurrentSessionTerm(current)">
                                    <span ng-show="!current.saving">Save</span>
                                    <span ng-show="current.saving"><span class="fa fa-spin fa-spinner"></span> Loading..</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <br/>

                    <div class="col-sm-12">
                        <h3>Set Session & Term Start and End Dates</h3>
                        <hr/>
                        <div class="row">
                        <div class="form-group col-sm-12">
                            <label>Terms start & end dates</label>
                            <ul class="list-group">
                                <li ng-repeat="sub_session in sub_sessions" class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-4">@{{ sub_session.display_name }}</div>
                                        <div class="col-sm-4" id="term_start_date" >
                                            <p class="input-group">
                                                <input  ng-disabled="sub_sessions.saving" type="text"
                                                        placeholder="Start Date" class="form-control"
                                                        datepicker-popup ng-model="sub_session.start_date"
                                                        is-open="sub_session.startDateOpened"/>
                                                <span class="input-group-btn">
                                                   <button type="button"
                                                           ng-click="openStartDate($event,sub_session)"
                                                           class="btn btn-default">
                                                       <em class="fa fa-calendar"></em>
                                                   </button>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="input-group">
                                                <input  ng-disabled="sub_sessions.saving" type="text"
                                                        placeholder="End Date" class="form-control"
                                                        datepicker-popup ng-model="sub_session.end_date"
                                                        is-open="sub_session.endDateOpened"/>
                                                <span class="input-group-btn">
                                                   <button type="button"
                                                           ng-click="openEndDate($event,sub_session)"
                                                           class="btn btn-default">
                                                       <em class="fa fa-calendar"></em>
                                                   </button>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <button ng-disabled="sub_sessions.saving"
                                    ng-click="saveSubSessionsDate(sub_sessions)"
                                    class="btn btn-success btn-sm">
                                <span ng-show="!sub_sessions.saving">Save</span>
                                <span ng-show="sub_sessions.saving"><span class="fa fa-spin fa-spinner"></span> Loading..</span>
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            </tab>
            <tab>
                <tab-heading>
                    Manage Terms
                </tab-heading>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3>Manage Terms</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        Add more.. <span class="btn btn-xs btn-primary pull-right" ng-hide="onAddTerm"
                                                         ng-click="onAddTerm = true">Add</span>
                                    <span class="btn btn-xs btn-primary pull-right" ng-show="onAddTerm"
                                          ng-click="onAddTerm = false">Hide</span>
                                    <div ng-show="onAddTerm">
                                        <div class="form-group">
                                            <label>Term Name</label>
                                            <input ng-disabled="term.saving" type="text" class="form-control" ng-model="term.name"/>
                                        </div>
                                        <div>
                                            <span ng-disabled="term.saving" class="btn btn-info"
                                                  ng-click="
                                                  addNewTerm(term);
                                                  ">
                                                <span ng-show="!term.saving">Save</span>
                                                <span ng-show="term.saving"><span class="fa fa-spin fa-spinner"></span> Saving..</span>
                                            </span>
                                        </div>
                                    </div>
                                    </li>
                                    <li ng-repeat="sub_session in sub_sessions"
                                        class="list-group-item">
                                       <div class="row">
                                           <div class="col-sm-8">
                                               <h4>@{{ sub_session.display_name }}</h4></div>
                                           <div class="col-sm-4">
                                            <span ng-disabled="sub_session.saving"
                                                  class="btn btn-xs btn-danger pull-right"
                                                  ng-click="removeTerm(sub_session)">
                                                <span ng-show="!sub_session.saving">Remove</span>
                                                <span ng-show="sub_session.saving">
                                                    <span class="fa fa-spin fa-spinner"></span> Deleting..
                                                </span>
                                            </span>
                                           </div>
                                       </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </tab>
        </tabset>

    </div>
</div>

<toaster-container toaster-options="{'close-button': true, 'position-class': 'toast-top-right' }"></toaster-container>