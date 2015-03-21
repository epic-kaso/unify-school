<div class="panel">
    <div class="panel-heading">
        <h3>Grades Settings</h3><hr/>
    </div>
    <div class="panel-body">
        <tabset justified="false" type="pills">
            <tab>
                <tab-heading>
                    <em class="icon-equalizer fa-sm"></em> Set Current
                </tab-heading>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Select Session</label>
                            <select name="import_session" class="form-control" ng-model="form.session"
                                    ng-options="session.id as session.name for session in sessions">
                                <option value="">Select Session</option>
                            </select><br/>
                            <button class="btn btn-primary btn-sm">Update</button>
                        </div>

                        <div class="form-group">
                            <label>Select Term</label>
                            <select name="import_term" class="form-control" ng-model="form.sub_session"
                                    ng-options="sub_session.id as sub_session.display_name for sub_session in sub_sessions">
                                <option value="">Select Term</option>
                            </select><br/>
                            <button class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </div>
                </div>
            </tab>
            <tab>
                <tab-heading>
                    <em class="fa-gear fa-sm"></em> Add New
                </tab-heading>
                <div>
                    Coming soon..
                </div>
            </tab>
        </tabset>

    </div>
</div>