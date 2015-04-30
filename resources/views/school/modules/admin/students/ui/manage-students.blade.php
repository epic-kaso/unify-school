<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 style="display: inline">All Students</h3>
                <hr/>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4" ng-repeat="student in Students">
                        <div id="panelPortlet5" class="panel widget">
                            <div class="portlet-handler">
                                <div class="row row-table row-flush">
                                    <div class="col-xs-3 bg-inverse text-center">
                                        <img style="height: 55px;border-radius: 100px;" class="img-responsive img-rounded img-thumbnail" ng-src="@{{ student.picture.dataURL || '/img/placeholder.jpg'}}" alt=""/>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="panel-body text-left bg-inverse">
                                            <h4 class="mt0">@{{ student.last_name }} @{{ student.first_name }}</h4>

                                            <p class="mb0 text-muted"><strong>Reg Number:</strong> @{{ student.reg_number }}</p>
                                            <p class="mb0 text-muted"><strong>Class:</strong> @{{ student.current_class_student.school_class.display_name || 'N/A' }}</p>
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