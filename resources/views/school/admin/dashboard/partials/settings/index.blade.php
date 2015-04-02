<div class="row" style="min-height: 550px">

    <div class="col-sm-3">
        <ul class="nav nav-pills nav-stacked">
            <!-- Iterates over all sidebar items-->
            <li><a ui-sref="app.settings.academics" ui-sref-active="active">Academics</a></li>
            <li><a ui-sref="app.settings.session_term" ui-sref-active="active">Session & Term</a></li>
            <li><a ui-sref="app.settings.classes" ui-sref-active="active">Classes</a></li>
            <li><a ui-sref="app.settings.courses" ui-sref-active="active">Courses</a></li>
            <li><a ui-sref="app.settings.school" ui-sref-active="active">School Profile</a></li>
            <li><a ui-sref="app.settings.staff" ui-sref-active="active">Staff</a></li>
            <li><a ui-sref="app.settings.students" ui-sref-active="active">Students</a></li>
            <li><a ui-sref="app.settings.reports" ui-sref-active="active">Reports</a></li>
            <li><a ui-sref="app.settings.financials" ui-sref-active="active">Financial</a></li>
            <li><a ui-sref="app.settings.notifications" ui-sref-active="active">Notification</a></li>
            <li><a ui-sref="app.settings.administrators" ui-sref-active="active">Administrators</a></li>
        </ul>
    </div>

    <div class="col-sm-9">
        <div ui-view>
            <div class="row">
                <h3>Frequently Used Settings</h3><hr/>

            </div>
        </div>
    </div>

</div>