<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <h2>Schools</h2>
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
            <div class="col-lg-10"></div>
        </div>
    </div>

    <div class="table-responsive">
        <table ng-table="tableParams" class="table table-striped table-bordered table-hover">
            <thead>
        <tr>
            <th>
                <div data-toggle="tooltip" data-title="Check All" class="checkbox c-checkbox">
                    <label>
                        <input type="checkbox" ng-model="selectAll" ng-change="$parent.selectAllSchool(selectAll)"/>
                        <span class="fa fa-check"></span>
                    </label>
                </div>
            </th>
            <th>Description</th>
            <th>Active</th>
        </tr>
            </thead>
            <tbody>
            <tr ng-repeat="school in $data" ng-class="{'whirl standard': school.updating}">
                <td>
                    <div class="checkbox c-checkbox">
                        <label>
                            <input type="checkbox" ng-model="school.$selected"/>
                            <span class="fa fa-check"></span>
                        </label>
                    </div>
            </td>
                <td>
                    <div class="media">
                        <a href="#" class="pull-left">
                            <img ng-src="@{{ school.logo }}" alt="" class="media-object img-responsive img-circle"/>
                        </a>

                        <div class="media-body">
                            <div class="pull-right badge baed-info">@{{ school.school_type.name }}</div>
                            <h4 class="media-heading">@{{ school.name }}</h4>

                            <p>Website: <a ng-href="@{{ school.website }}">@{{ school.website }}</a></p>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <label class="switch">
                        <input type="checkbox" ng-model="school.active"
                               ng-change="$parent.UpdateSchoolActiveState(school)"/>
                        <span></span>
                    </label>
                </td>
        </tr>
            </tbody>
    </table>
    </div>
</div>