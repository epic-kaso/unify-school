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
                                <input type="text" placeholder="2014/2015" class="form-control"  ng-model="current.current_session" masked="" data-inputmask="'mask': '9999/9999'"/>
                            </div>
                            <div class="form-group col-sm-5">
                                <label>Select Current Term</label>
                                <select name="import_session" class="form-control" ng-model="current.current_sub_session"
                                        ng-options="sub_session.id as sub_session.name for sub_session in sub_sessions">
                                    <option value="">Select Term</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-2">

                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-success btn-sm" ng-click="saveCurrentSessionTerm(current)">Save</button>
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
                                                <input type="text" placeholder="Start Date" class="form-control" datepicker-popup ng-model="sub_session.startDate" is-open="sub_session.startDateOpened"/>
                                                <span class="input-group-btn">
                                                   <button type="button" ng-click="openStartDate($event,sub_session)" class="btn btn-default">
                                                       <em class="fa fa-calendar"></em>
                                                   </button>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="input-group">
                                                <input type="text" placeholder="End Date" class="form-control" datepicker-popup ng-model="sub_session.endDate" is-open="sub_session.endDateOpened"/>
                                                <span class="input-group-btn">
                                                   <button type="button" ng-click="openEndDate($event,sub_session)" class="btn btn-default">
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
                            <button class="btn btn-success btn-sm">Save</button>
                        </div>
                        </div>
                    </div>
                </div>
            </tab>
            <tab>
                <tab-heading>
                    <em class="fa-gear fa-sm"></em> Add New
                </tab-heading>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h4>Add Term</h4>
                            </div>
                            <div class="panel-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>First Term</strong>
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