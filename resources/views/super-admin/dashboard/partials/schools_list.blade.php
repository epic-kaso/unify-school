<div class="panel">
    <div class="panel-heading">
        <h3>Schools</h3>
    </div>
    <table class="table">
        <tr>
            <td>S/N</td>
            <td>Name</td>
            <td>Active</td>
        </tr>

        <tr ng-repeat="school in schools">
            <td>@{{ $index + 1 }}</td>
            <td>@{{ school.name }}</td>
            <td>
                <span class="label label-@{{ school.active ? 'success' : 'warning' }}">@{{ school.active ? 'Active' : 'InActive' }}</span>
            </td>
        </tr>
    </table>
</div>