<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3>Import Students From Excel</h3>
        </div>

        <div class="panel-body">
            <form ng-attr-action="@{{ import.url }}"
                  ng-upload="import.completed(content)" >

                <div class="form-group col-sm-4">
                    <label>Select Session</label>
                    
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button tooltip="Add New Session"
                                    ng-dialog="addNewSessionDialog.html"
                                    ng-dialog-class="ngdialog-theme-default"
                                    ng-dialog-controller="AddSessionDialogController"
                                    ng-dialog-close-previous
                                    class="btn btn-default"><span class="fa fa-plus"></span>
                             </button>
                        </span>
                        
                        <select name="import_session" class="form-control" ng-model="form.session"
                            ng-options="session.id as session.name for session in sessions">
                            <option value="">Select Session</option>
                        </select>
                    </div>
                    
                </div>

                <div class="form-group col-sm-4">
                    <label>Select Term</label>
                    <select name="import_term" class="form-control" ng-model="form.sub_session"
                            ng-options="sub_session.id as sub_session.display_name for sub_session in sub_sessions">
                        <option value="">Select Term</option>
                    </select>
                </div>

                <div class="form-group col-sm-4">
                    <label>Select School Category</label>
                    <select name="import_school_type"
                            class="form-control"
                            ng-model="form.school_category"
                            ng-options="school_category.id as school_category.display_name for school_category in school_categories">
                        <option value="">Select School Category</option>
                    </select>
                </div>

                <div class="form-group col-sm-4">
                    <label>Select Class</label>
                    <select name="import_class"
                            class="form-control"
                            ng-model="form.class"
                            ng-options="class.id as class.display_name for class in current_school_classes">
                        <option value="">Select Class</option>
                    </select>
                </div>

                <div class="form-group col-sm-4">
                    <label>Select Excel File to Upload</label>
                    <input  name="excel_file" filestyle="" type="file" data-classbutton="btn btn-default"
                           data-classinput="form-control inline" class="form-control"
                     />
                </div>

                <div class="form-group col-sm-4">
                    <br/>
                    <input ng-disabled="$isUploading" type="submit" class="btn btn-primary" value="Upload"/>
                </div>
            </form>
        </div>
    </div>
</div>