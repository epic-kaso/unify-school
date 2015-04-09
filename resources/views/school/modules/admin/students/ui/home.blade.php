<div>
    <div>
        <ul class="nav nav-pills">
            <li><a href="#" ng-click="goBack($event)"><span class="fa fa-chevron-left"></span> Back</a></li>
            <li><a ui-sref="app.menu"><span class="fa fa-home"></span> Home</a></li>
            <li>
                <a ui-sref="app.students.enroll_student" ui-sref-active="active">
                    Enroll A New Student
                </a>
            </li>
            <li>
                <a ui-sref="app.students.enroll_students" ui-sref-active="active">
                    Enroll Many Students
                </a>
            </li>
            <li>
                <a ui-sref="app.students.manage" ui-sref-active="active">
                    Manage Students
                </a>
            </li>
            <li>
                <a ui-sref="app.students.import" ui-sref-active="active">
                    Import Students
                </a>
            </li>
            <li>
                <a ui-sref="app.students.export" ui-sref-active="active">
                    Export Students
                </a>
            </li>
        </ul>
    </div>
    <div ui-view></div>
    <toaster-container toaster-options="{'close-button': true, 'position-class': 'toast-top-right' }"></toaster-container>
</div>