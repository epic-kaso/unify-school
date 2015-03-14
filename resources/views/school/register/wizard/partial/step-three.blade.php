<div class="col-sm-10 col-sm-offset-1">
    <h3>School Admin Login Details</h3>
    <hr/>
    <div class="form-group">
        <label>Enter School's Admin Email</label>
        <input type="text" required placeholder="Admin Email" name="email" ng-model="school.admin_email"
               class="form-control inmate-search-box"/>
    </div>

    <div class="form-group">
        <label>Enter School's Admin Password</label>
        <input type="password" required placeholder="Admin Password" name="password" ng-model="school.admin_password"
               class="form-control inmate-search-box"/>
    </div>

    <div class="form-group">
        <label>Enter School's Admin Password Confirmation</label>
        <input type="password" required placeholder="Admin Password Confirmation" name="password_confirmation"
               ng-model="school.admin_password_confirmation"
               class="form-control inmate-search-box"/>
    </div>


    <div class="row">
        <div class="col-sm-12" style="padding: 0">
            <div class="form-group">
                <button class="btn btn-info pull-right" ng-click="nextStepFour()">Next</button>
            </div>
        </div>
    </div>
</div>