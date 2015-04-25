<h3>Dashboard</h3>
<div class="col-sm-12">
    <!-- START row-->
    <div class="row">
        <!-- START widget-->
        {{--<div class="col-sm-4">--}}
        {{--<div id="panelPortlet5" class="panel widget">--}}
            {{--<div class="portlet-handler">--}}
                {{--<div class="row row-table row-flush">--}}
                    {{--<div class="col-xs-4 bg-inverse text-center">--}}
                        {{--<em class="fa fa-code-fork fa-2x"></em>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-8">--}}
                        {{--<div class="panel-body text-center bg-inverse">--}}
                            {{--<h4 class="mt0">150</h4>--}}

                            {{--<p class="mb0 text-muted">Students</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        <!-- END widget-->
    </div>

    <div ng-if="!school.setup_complete" class="row" style="margin-bottom: 70px;">
        <!-- START panel-->
        <div class="col-sm-6 col-sm-offset-3">
            <div id="panelPortlet6" class="panel panel-inverse">
                <div class="panel-heading portlet-handler" style="text-transform: uppercase;">
                    <h1>Incomplete Setup</h1>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-sm-2">
                            <span class="fa-5x icon-info"></span>
                        </div>

                        <div class="col-sm-10">
                            <p>
                                Hello, Thanks for signing up to our platform.
                                To begin to use the platform and have access to
                                the available modules you will need to completed
                                configure important settings that are required for
                                this platform to work properly.
                            </p>
                            <p>
                                Click the button below to complete configuration
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a ui-sref="app.settings" class="btn btn-lg btn-success">
                            <span class="fa fa-gear"></span> Complete Configuration
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div ng-if="school.setup_complete" class="row" style="margin-bottom: 70px;">
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
    </div>
</div>
