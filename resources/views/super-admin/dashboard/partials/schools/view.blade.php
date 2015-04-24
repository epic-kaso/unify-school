<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <h2>@{{ school.name }}</h2>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <button ng-disabled="school.deleting" class="btn btn-danger" ng-click="deleteSchool(school)">
                    <span ng-show="!school.deleting">Delete</span>
                    <span ng-show="school.deleting"><span class="fa fa-spinner fa-spin"></span> Deleting</span>
                </button>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="h4">Modules</div>
        <hr/>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Active</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="module in modules" ng-class="{'whirl standard': school.updating}">
                    <td>
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading">@{{ module.name }}</h4>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <label class="switch">
                            <input type="checkbox" ng-model="school.modules[module.id]" ng-change=""/>
                            <span></span>
                        </label>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" ng-click="saveSchool(school)">Save Changes</button>
        </div>

    </div>

</div>

<toaster-container toaster-options="{'close-button': true, 'position-class': 'toast-top-right' }"></toaster-container>