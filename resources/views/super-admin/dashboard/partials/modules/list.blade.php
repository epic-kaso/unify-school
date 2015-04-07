<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <h2>Modules</h2>
            
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="input-group pull-right">
                    <select class="input-sm form-control">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete</option>
                        <option value="2">Clone</option>
                        <option value="3">Export</option>
                    </select>
                   <span class="input-group-btn">
                      <button class="btn btn-sm btn-default">Apply</button>
                   </span>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="btn-group pull-right">
                    <a ui-sref="app.modules.add" class="btn btn-default">New Module</a>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
        <tr>
            <th>
                <div data-toggle="tooltip" data-title="Check All" class="checkbox c-checkbox">
                    <label>
                        <input type="checkbox" ng-model="selectAll"/>
                        <span class="fa fa-check"></span>
                    </label>
                </div>
            </th>
            <th>Description</th>
            <th>Active</th>
        </tr>
            </thead>
            <tbody>
            <tr ng-repeat="module in modules" ng-class="{'whirl standard': module.updating}">
                <td>
                    <div class="checkbox c-checkbox">
                        <label>
                            <input type="checkbox" ng-model="module.selected"/>
                            <span class="fa fa-check"></span>
                        </label>
                    </div>
            </td>
                <td>
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading">@{{ module.name }}</h4>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <label class="switch">
                        <input type="checkbox" ng-model="module.active"
                               ng-change="updateModule(module)"/>
                        <span></span>
                    </label>
                </td>
        </tr>
            </tbody>
    </table>
    </div>
</div>

