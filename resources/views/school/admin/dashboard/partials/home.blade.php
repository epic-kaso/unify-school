<div class="pull-right">
    <button type="button" class="btn btn-default btn-sm"><span class="fa fa-gears"></span> Change</button>
</div>
<h3>Dashboard</h3>
<div class="col-sm-12">
    <!-- START row-->
    <div class="row">
        <!-- START widget-->
        <div class="col-sm-4">
        <div id="panelPortlet5" class="panel widget">
            <div class="portlet-handler">
                <div class="row row-table row-flush">
                    <div class="col-xs-4 bg-inverse text-center">
                        <em class="fa fa-code-fork fa-2x"></em>
                    </div>
                    <div class="col-xs-8">
                        <div class="panel-body text-center bg-inverse">
                            <h4 class="mt0">150</h4>

                            <p class="mb0 text-muted">Students</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- END widget-->
    </div>
    <div class="row">
            <!-- START panel-->
            <div class="col-sm-4" ng-repeat="module in school.loaded_modules">
                <div id="panelPortlet6" class="panel panel-inverse">
                    <div class="panel-heading portlet-handler">@{{ module.name }}</div>
                    <div class="panel-body">
                        <div class="list-group">
                            <a class="list-group-item" ui-sref="app.students.@{{ value.route }}" ng-repeat="value in module.menu">@{{ value.name }}</a>
                        </div>
                    </div>
                    <div class="panel-footer"><span class="btn-btn-sm"><span class="fa fa-gear"></span> Configure</span></div>
                </div>
            </div>
    </div>
</div>
