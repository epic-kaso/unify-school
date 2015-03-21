<div>
    <div class="panel">
        <div class="panel-heading">
            <h3>Import Students From Excel</h3>
        </div>

        <div class="panel-body">
            <form action="{{ route('resources.import-students.store') }}" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Select Session</label>
                    <select name="import_session" class="form-control">
                        {{--@foreach($sessions as $session)--}}
                            {{--<option value="{{ $session->id }}">{{ $session->display_name }}</option>--}}
                        {{--@endforeach--}}
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Term</label>
                    <select name="import_term" class="form-control" ng-model="form.sub_session"
                            ng-options="sub_session.id as sub_session.display_name for sub_session in sub_sessions">
                        <option value="">Select Term</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select School Category</label>
                    <select name="import_school_type"
                            class="form-control"
                            ng-model="form.school_category"
                            ng-options="school_category.id as school_category.display_name for school_category in school_categories">
                        <option value="">Select School Category</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Class</label>
                    <select name="import_class"
                            class="form-control"
                            ng-model="form.class"
                            ng-options="class.id as class.display_name for class in current_school_classes">
                        <option value="">Select Class</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Excel File to Upload</label>
                    <input class="form-control" type="file" name="excel_file"/>
                </div>
                <div class="form-group">

                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Upload"/>
                </div>
            </form>
        </div>
    </div>
</div>