<div class="col-sm-10 col-sm-offset-1">
    <h3>School Types Setup</h3>
    <hr/>

    <div class="row">

        <div class="col-sm-6"  ng-repeat="school_category in school.school_types[school.selected_school_type].school_categories">
        <div class="panel">
            <div class="panel-heading">
                <h4>@{{ school_category.display_name }}</h4>
            </div>

            <div class="panel-body" style="padding: 0">
                <div class="form-group col-sm-6">
                    <label class="sm">How Many levels exists here</label>
                    <select required class="form-control sm">
                        <option>-- select --</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </div>

                <div class="form-group col-sm-6">
                    <label class="sm">Custom name for this level</label>
                    <input type="text" required placeholder="Custom Level Name e.g (Jss or Beginner)" name="password_confirmation"
                           ng-model="school.admin.password_confirmation"
                           class="form-control sm"/>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-sm-12" style="padding: 0">
            <div class="form-group">
                <button  class="btn btn-info pull-right" ng-click="next()">Next</button>
            </div>
        </div>
    </div>
</div>