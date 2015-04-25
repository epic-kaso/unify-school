<div class="col-sm-8 col-sm-offset-2">
    <!-- START panel-->
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="/" method="POST" form-wizard="" validate-steps="true" validate-form="" steps="4">
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
                                <p>Setup data goes here</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">

                                <span class="btn btn-labeled btn-default pull-left"
                                      ng-click="wizard.go(1)">
                                    <span class="btn-label btn-label-right">
                                       <i class="fa fa-arrow-left"></i>
                                   </span>
                                    Previous
                                </span>

                                <span class="btn btn-labeled btn-default pull-right"
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
                            <div class="col-sm-12">
                                <p>Setup 3</p>
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
                            <p>In vulputate mattis ipsum vitae vehicula. Praesent at arcu non arcu convallis pellentesque. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p>
                                <button type="button" class="btn btn-info btn-lg">You can Proceed Now</button>
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

                        <ul class="pager">
                            <li class="previous">
                                <a href="#" ng-click="wizard.go(3)">
                                    <span>&larr; Previous</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Wizard Step inputs -->
                </div>
            </form>
        </div>
    </div>
    <!-- END panel -->
</div>