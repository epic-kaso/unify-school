<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3>Import Students From Excel</h3>
        </div>

        <div class="panel-body">
            
            <div class="alert alert-danger" ng-show="!import.working && import.error">
                    <p>Failed to Import, Try Again</p>
                </div>
                
            <form 
                ng-show="!import.response"
                ng-class="{'whirl standard': import.working}"
                ng-attr-action="@{{ import.url }}"
                ng-upload-loading="import.isUploading()"
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
                        
                        <select name="session_id" class="form-control" ng-model="form.session">
                            <option value="">Select Session</option>
                            <option value="@{{ session.id }}" ng-repeat="session in sessions">@{{ session.name }}</option>
                        </select> 
                    </div>
                    
                </div>

                <div class="form-group col-sm-4">
                    <label>Select Term</label>
                    <select name="sub_session_id" class="form-control" ng-model="form.sub_session">
                        <option value="">Select Term</option>
                        <option value="@{{ sub_session.id }}" ng-repeat="sub_session in sub_sessions">@{{ sub_session.display_name }}</option>
                    </select>
                </div>

                <div class="form-group col-sm-4">
                    <label>Select School Category</label>
                    <select name="school_category_id"
                            class="form-control"
                            ng-model="form.school_category">
                        <option value="@{{ school_category.id }}" ng-repeat="school_category in school_categories">@{{ school_category.display_name }}</option>
                    </select>
                </div>

                <div class="form-group col-sm-4">
                    <label>Select Class</label>
                    <select name="sub_class_id"
                            class="form-control"
                            ng-model="form.class">
                        <option value="">Select Class</option>
                        <option value="@{{ sub_class.id }}" ng-repeat="sub_class in current_school_classes">@{{ sub_class.display_name }}</option>    
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
            
            <div class="row" ng-show="!import.working && import.response">
                <div class="form-group">
                    <button class="btn btn-primary" ng-click="import.response = null">Import Students</button>
                </div>
                <div class="alert alert-success">
                    <p>Successful Imports: @{{ import.response.successful.length }} Student(s)</p>
                </div>
                
                <div class="panel panel-danger" ng-show="import.response.failure.length > 0">
                    <div class="panel-heading">
                        <p>Failed Imports: @{{ import.response.failure.length }} Student(s)</p>
                    </div>
                    <table class="table table-striped">
                        <tr>
                            <td>Last Name</td>
                            <td>First Name</td>
                            <td>Middle Name</td>
                            <td>Sex</td>
                        </tr>
                        <tr ng-repeat="fail in import.response.failure">
                            <td>@{{ fail.lastname }}</td>
                            <td>@{{ fail.firstname }}</td>
                            <td>@{{ fail.middlename }}</td>
                            <td>@{{ fail.sex }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>