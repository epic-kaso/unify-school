<h1>School Created Successfully</h1>
<p>Here is your school access details, keep it for reference.</p>

<table class="table">
    <tr>
        <td>Name</td>
        <td>{{ $school['name'] or $school->name  }}</td>
    </tr>

    <tr>
        <td>Type</td>
        <td>{{ $school['school_type']['display_name'] or $school->school_type->display_name }}</td>
    </tr>

    <tr>
        <td>Website</td>
        <td>{{ $school['website'] or $school->website }}</td>
    </tr>
    <tr>
        <td>Admin Portal</td>
        <td>{{ $school['admin_website'] or $school->admin_website }}</td>
    </tr>

    <tr>
        <td>Students Portal</td>
        <td>{{ $school['student_website'] or $school->student_website }}</td>
    </tr>

    <tr>
        <td>Admin Email</td>
        <td>{{ $school['administrator']['email'] or $school->administrator->email }}</td>
    </tr>
</table>