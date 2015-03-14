<table class="table">
    <tr>
        <td>Name</td>
        <td>{{ $school->name  }}</td>
    </tr>

    <tr>
        <td>Type</td>
        <td>{{ $school->school_type->display_name  }}</td>
    </tr>

    <tr>
        <td>Website</td>
        <td>{{ $school->website  }}</td>
    </tr>
    <tr>
        <td>Admin Portal</td>
        <td>{{ $school->admin_website  }}</td>
    </tr>

    <tr>
        <td>Students Portal</td>
        <td>{{ $school->student_website  }}</td>
    </tr>

    <tr>
        <td>Admin Email</td>
        <td>{{ $school->administrator->email  }}</td>
    </tr>
</table>