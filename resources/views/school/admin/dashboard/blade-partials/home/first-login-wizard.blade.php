<!-- START panel-->
<div class="panel panel-default">
    <div class="panel-heading">Form Wizard Horizontal (with validation)</div>
    <div class="panel-body">
        <form action="/" method="POST" form-wizard="" validate-steps="true" validate-form="" steps="4">
            <div class="form-wizard wizard-horizontal">
                <!-- START wizard steps indicator-->
                <ol class="row">
                    <li ng-class="{'active':wizard.active(1)}" ng-click="wizard.go(1)" class="col-md-3">
                        <h4>Login</h4>
                        <small class="text-muted">Duis volutpat nunc at ligula tincidunt non aliquam.</small>
                    </li>
                    <li ng-class="{'active':wizard.active(2)}" ng-click="wizard.go(2)" class="col-md-3">
                        <h4>Personal</h4>
                        <small class="text-muted">Nulla pharetra imperdiet sapien ac faucibus.</small>
                    </li>
                    <li ng-class="{'active':wizard.active(3)}" ng-click="wizard.go(3)" class="col-md-3">
                        <h4>Contact</h4>
                        <small class="text-muted">Sed elementum lorem dolor, id fermentum metus.</small>
                    </li>
                    <li ng-class="{'active':wizard.active(4)}" ng-click="wizard.go(4)" class="col-md-3">
                        <h4>Done!</h4>
                        <small class="text-muted">Nullam sit amet magna vestibulum libero.</small>
                    </li>
                </ol>
                <!-- END wizard steps indicator-->
                <!-- START Wizard Step inputs -->
                <div id="step1" ng-show="wizard.active(1)">
                    <fieldset>
                        <legend>Login</legend>
                        <!-- START row -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Username</label>
                                    <div class="controls">
                                        <input type="text" name="username" data-parsley-group="step1" placeholder="Your nick here" required="required" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="controls">
                                        <input type="password" name="password" data-parsley-group="step1" placeholder="Your password" required="required" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Retype Password</label>
                                    <div class="controls">
                                        <input type="password" name="password2" data-parsley-group="step1" placeholder="Confirmed password" required="required" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END row -->
                    </fieldset>
                    <ul class="pager">
                        <li class="next"><a href="#" ng-click="wizard.go(2)">Next <span>&rarr;</span></a>
                        </li>
                    </ul>
                </div>
                <!-- END Wizard Step inputs -->
                <!-- START Wizard Step inputs -->
                <div id="step2" ng-show="wizard.active(2)">
                    <fieldset>
                        <legend>Personal</legend>
                        <!-- START row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first-name" data-parsley-group="step2" placeholder="John" required="required" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last-name" data-parsley-group="step2" placeholder="Snow" required="required" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <!-- END row -->
                    </fieldset>
                    <ul class="pager">
                        <li class="previous">
                            <a href="#" ng-click="wizard.go(1)">
                                <span>&larr; Previous</span>
                            </a>
                        </li>
                        <li class="next"><a href="#" ng-click="wizard.go(3)">Next <span>&rarr;</span></a>
                        </li>
                    </ul>
                </div>
                <!-- END Wizard Step inputs -->
                <!-- START Wizard Step inputs -->
                <div id="step3" ng-show="wizard.active(3)">
                    <fieldset>
                        <legend>Contact</legend>
                        <!-- START row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" data-parsley-group="step3" placeholder="john@snow.com" required="required" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" data-parsley-group="step3" placeholder="11-2345-6789" required="required" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <!-- END row -->
                    </fieldset>
                    <ul class="pager">
                        <li class="previous">
                            <a href="#" ng-click="wizard.go(2)">
                                <span>&larr; Previous</span>
                            </a>
                        </li>
                        <li class="next"><a href="#" ng-click="wizard.go(4)">Next <span>&rarr;</span></a>
                        </li>
                    </ul>
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