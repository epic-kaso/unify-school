<div class="panel">
    <div class="panel-heading">
        <h3>Session & Term Settings</h3><hr/>
    </div>
    <div class="panel-body">
        <tabset justified="false" type="pills">
            <tab>
                <tab-heading>
                    <em class="icon-equalizer fa-sm"></em> Current
                </tab-heading>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Select Session</label>
                            <select name="import_session" class="form-control" ng-model="form.session"
                                    ng-options="session.id as session.name for session in sessions">
                                <option value="">Select Session</option>
                            </select><br/>
                            <button class="btn btn-primary btn-sm">Update</button>
                        </div>
                        <div class="form-group">
                            <label>Select Session</label>
                            <select name="import_session" class="form-control" ng-model="form.session"
                                    ng-options="session.id as session.name for session in sessions">
                                <option value="">Select Session</option>
                            </select><br/>
                            <button class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Configure Terms</label>
                            <table class="table">
                                <tr ng-repeat="sub_session in sub_sessions" class="list-group-item">
                                    <td class="name">@{{ sub_session.display_name }}</td>
                                    <td class="date" id="term_start_date">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   datepicker-popup="yyyy/MM/dd"
                                                   ng-model="dt"
                                                   ng-required="true"
                                                   close-text="Close" />
                                                  <span class="input-group-btn">
                                                    <button type="button"
                                                            class="btn btn-default"
                                                            ng-click="open($event)">
                                                        <i class="glyphicon glyphicon-calendar"></i>
                                                    </button>
                                                  </span>
                                        </div>
                                    </td>
                                    <td class="date" id="term_end_date">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   datepicker-popup="yyyy/MM/dd"
                                                   ng-model="dt"
                                                   ng-required="true"
                                                   close-text="Close" />
                                                  <span class="input-group-btn">
                                                    <button type="button"
                                                            class="btn btn-default"
                                                            ng-click="open($event)">
                                                        <i class="glyphicon glyphicon-calendar"></i>
                                                    </button>
                                                  </span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
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
                                <h4>Add Session</h4>
                            </div>
                            <div class="panel-body">

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h4>Add Term</h4>
                            </div>
                            <div class="panel-body">

                            </div>
                        </div>
                    </div>
                </div>

            </tab>
        </tabset>

    </div>
</div>