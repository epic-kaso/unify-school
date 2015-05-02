<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 style="display: inline">@{{ ScopedSchoolCategory.display_name }} Students</h3>
            </div>

            <div class="panel-body">
                @include('school.modules.admin.students.blade-partials.students-table')
            </div>
        </div>
    </div>
</div>