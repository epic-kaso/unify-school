<!-- START panel-->
    <div class="col-sm-4" ng-repeat="module in school.loaded_modules">
        <div id="panelPortlet6" class="panel panel-inverse">
            <div class="panel-heading portlet-handler" style="text-transform: uppercase;">@{{ module.name }}</div>
            <div class="panel-body">
                <scrollable height="200" class="list-group">
                    <!-- START list group item-->
                    <a class="list-group-item"
                       ui-sref="app.@{{ module.name }}.@{{ value.route }}"
                       ng-repeat="value in module.menu">@{{ value.name }}
                    </a>
                    <!-- END list group item-->
                </scrollable>
            </div>
            <div class="panel-footer"><span class="btn-btn-sm">
                            <span class="fa fa-gear"></span> Configure</span>
            </div>
        </div>
    </div>