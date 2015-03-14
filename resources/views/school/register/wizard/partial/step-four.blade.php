<div class="col-sm-10 col-sm-offset-1">
    <h3>Congratulations!</h3>

    <p>School created successfully</p>
    <hr/>

    <table class="table">
        <tr>
            <td>Name</td>
            <td>@{{ school.name  }}</td>
        </tr>

        <tr>
            <td>Type</td>
            <td>@{{ school.school_type.display_name  }}</td>
        </tr>

        <tr>
            <td>Website</td>
            <td>@{{ school.website  }}</td>
        </tr>
        <tr>
            <td>Admin Portal</td>
            <td>@{{ school.admin_website  }}</td>
        </tr>

        <tr>
            <td>Students Portal</td>
            <td>@{{ school.student_website  }}</td>
        </tr>

        <tr>
            <td>Admin Email</td>
            <td>@{{ school.administrator.email  }}</td>
        </tr>
    </table>


    <div class="row">
        <div class="col-sm-12" style="padding: 0">
            <div class="form-group">
                <a class="btn btn-info pull-right" href="@{{ school.website  }}">Close</button>
            </div>
        </div>
    </div>
</div>