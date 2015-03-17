<div class="panel">
    <div class="panel-heading">
        <h3>Schools</h3>
    </div>
    <table class="table">
        <tr>
            <td>S/N</td>
            <td>Name</td>
            <td>Active</td>
            <td>...</td>
        </tr>

        <tr ng-repeat="school in schools">
            <td>@{{ $index + 1 }}</td>
            <td>@{{ school.name }}</td>
            <td colspan="2">
                <span class="label label-@{{ school.active ? 'success' : 'warning' }}">@{{ school.active ? 'Active' : 'InActive' }}</span>

                <button type="button" class="btn btn-@{{ school.active ? 'danger' : 'success' }} btn-xs pull-right"
                        ng-model="school.active" btn-checkbox>
                    @{{ school.active ? 'Deactivate' : 'Activate' }}
                </button>
            </td>

        </tr>
    </table>
</div>