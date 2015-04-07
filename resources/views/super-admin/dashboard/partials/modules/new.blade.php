<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <h2>New Module</h2>
            
        </div>
        <div class="row">
            <div class="col-lg-2">
                
            </div>
            <div class="col-lg-10">
                <div class="btn-group pull-right">
                    <button class="btn btn-info">All Modules</button>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="col-sm-6">
           <div class="row">
                 <div class="form-group">
            <input class="form-control" placeholder="Name Of Module" ng-model="module.name" />
        </div>

        <div class="form-group">
            <select class="form-control" ng-model="module.path">
                <option value="school/modules/admin">School Admin Module</option>
                <option value="school/modules/students">Student Module</option>
            </select>
        </div>


        <div class="form-group">
            <select class="form-control" placeholder="School Type" ng-model="module.school_type_id"
                    ng-options="school_type.id as school_type.name for school_type in school_types">
                <option value="">Select School Type</option>
            </select>
        </div>

        <div class="form-group" ng-init="module.menu = [{name: '',route: ''}]">
            <h3>Menu Configurations</h3>
            <ul class="list-group">
                <li class="list-group-item" ng-repeat="menu in module.menu">
                    <div class="row">
                        <div class="col-sm-6">
                            <input class="form-control" placeholder="Display Name" ng-model="menu.name" ng-blur="module.menu.push({name: '',route: ''})"/>
                        </div>

                        <div class="col-sm-6">
                            <input class="form-control" placeholder="Route Name" ng-model="menu.route" />
                        </div>
                    </div>
                </li>
            </ul>
        </div>


         <div class="form-group" ng-init="module.data = [{name: '',value: ''}]">
            <h3>Data Configurations</h3>
            <ul class="list-group">
                <li class="list-group-item" ng-repeat="menu in module.data">
                    <div class="row">
                        <div class="col-sm-6">
                            <input class="form-control" placeholder="Name" ng-model="menu.name" ng-blur="module.data.push({name: '',value: ''})"/>
                        </div>

                        <div class="col-sm-6">
                            <input class="form-control" placeholder="Value" ng-model="menu.value" />
                        </div>
                    </div>   
                </li>
            </ul>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" value="Add Module" ng-click="addNewModule(module)"/>
        </div>   
           </div>   
        </div> 
    </div>
</div>

