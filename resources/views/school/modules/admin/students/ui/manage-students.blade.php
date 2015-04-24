<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 style="display: inline">All Students</h3>
                <hr/>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-3" ng-repeat="student in Students">
                        <div id="panelPortlet5" class="panel widget">
                            <div class="portlet-handler">
                                <div class="row row-table row-flush">
                                    <div class="col-xs-4 bg-inverse text-center">
                                        <em class="fa fa-code-fork fa-2x"></em>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="panel-body text-center bg-inverse">
                                            <h4 class="mt0">@{{ student.last_name }} @{{ student.first_name }}</h4>

                                            <p class="mb0 text-muted">@{{ student.reg_number }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>