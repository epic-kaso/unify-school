<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Staff Settings</h3>
        <hr/>
    </div>
    <div class="panel-body">
        <tabset justified="false" type="pills">
            <tab>
                <tab-heading>
                    Assignments
                </tab-heading>
                <div class="row">
                    <div class="col-sm-12 mt10" ng-show="currentStaff" >
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="media-box">
                                    <div class="pull-left">
                                        <img ng-src="@{{ currentStaff.picture.dataURL }}" alt="Image"
                                             class="media-box-object img-circle thumb32"/>
                                    </div>
                                    <div class="media-box-body clearfix">
                                        <small class="pull-right">@{{ currentStaff.status }}</small>
                                        <strong class="media-box-heading text-primary">
                                            <span class="circle circle-success circle-lg text-left"></span>@{{ currentStaff.last_name + ' ' + currentStaff.first_name }}
                                        </strong>

                                        <p class="mb-sm">
                                            <small>@{{ currentStaff.contact_phone }}</small>
                                        </p>
                                    </div>
                                </div>
                                <span>Assigned Class</span>
                                <input type="text" tagsinput="tagsinput" ng-value="currentStaff.assigned_classes.join(',')"
                                       ng-model="currentStaff.assigned_classes" placeholder="Assigned Classes">
                                <span>Assigned Courses</span>
                                <input type="text" tagsinput="tagsinput" ng-value="currentStaff.assigned_courses.join(',')"
                                       ng-model="currentStaff.assigned_courses" placeholder="Assigned Classes">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">

                        <div class="panel">
                            <div class="panel-heading" style="padding-left: 0;padding-right: 0">
                                <div class="pull-right label label-success">@{{ staffs.length}}</div>
                                <div class="panel-title"><h4>Select Staff</h4></div>
                                <div class="input-group">
                                    <input type="text" ng-model="filterStaff" placeholder="Search Staff .."
                                           class="form-control input-sm"/>
                                     <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default btn-sm"><i
                                                    class="fa fa-search"></i>
                                        </button>
                                     </span>
                                </div>
                            </div>
                            <!-- START list group-->
                            <scrollable height="360" class="list-group" ng-init="filterStaff = null;">
                                <!-- START list group item-->
                                <a href="#" ng-click="setCurrentStaff($event,staff)" class="list-group-item"
                                   ng-repeat="staff in staffs | filter:{$: filterStaff}">
                                    <div class="media-box">
                                        <div class="pull-left">
                                            <img ng-src="@{{ staff.picture.dataURL }}" alt="Image"
                                                 class="media-box-object img-circle thumb32"/>
                                        </div>
                                        <div class="media-box-body clearfix">
                                            <small class="pull-right">@{{ staff.status }}</small>
                                            <strong class="media-box-heading text-primary">
                                                <span class="circle circle-success circle-lg text-left"></span>@{{ staff.last_name + ' ' + staff.first_name }}
                                            </strong>

                                            <p class="mb-sm">
                                                <small>@{{ staff.contact_phone }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <!-- END list group item-->
                            </scrollable>
                            <!-- END list group-->
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel">
                            <div class="panel-heading" style="padding-left: 0;padding-right: 0">
                                <div class="pull-right label label-success">@{{ courses.length}}</div>
                                <div class="panel-title"><h4>Assign Course</h4></div>
                                <div class="input-group">
                                    <input type="text" ng-model="filterCourse" placeholder="Search Staff .."
                                           class="form-control input-sm"/>
                                     <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default btn-sm"><i
                                                    class="fa fa-search"></i>
                                        </button>
                                     </span>
                                </div>
                            </div>
                            <!-- START list group-->
                            <scrollable height="180" class="list-group" ng-init="filterCourse = null">
                                <!-- START list group item-->
                                <a href="#" class="list-group-item"
                                   ng-repeat="course in courses | filter:{$: filterCourse}">
                                    <div class="media-box">
                                        <div class="media-box-body clearfix">
                                            <small class="pull-right">@{{ course.code }}</small>
                                            <strong class="media-box-heading text-primary">
                                                @{{ course.name }}
                                            </strong>
                                        </div>
                                    </div>
                                </a>
                                <!-- END list group item-->
                            </scrollable>
                            <!-- END list group-->
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="panel" ng-init="filterClass = null;">
                            <div class="panel-heading" style="padding-left: 0;padding-right: 0">
                                <div class="pull-right label label-success">@{{ classes.length}}</div>
                                <div class="panel-title"><h4>Assign Class</h4></div>
                                <div class="input-group">
                                    <input type="text" ng-model="filterClass" placeholder="Search Classes .."
                                           class="form-control input-sm"/>
                                     <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default btn-sm"><i
                                                    class="fa fa-search"></i>
                                        </button>
                                     </span>
                                </div>
                            </div>
                            <!-- START list group-->
                            <scrollable height="180" class="list-group">
                                <!-- START list group item-->
                                <a href="#" class="list-group-item"
                                   ng-repeat="class in classes | filter:{$: filterClass}">
                                    <div class="media-box">
                                        <div class="media-box-body clearfix">
                                            <small class="pull-right">@{{ class.has_subdivisions }}</small>
                                            <strong class="media-box-heading text-primary">
                                                @{{ class.display_name }}
                                            </strong>
                                        </div>
                                    </div>
                                </a>
                                <!-- END list group item-->
                            </scrollable>
                            <!-- END list group-->
                        </div>
                    </div>
                </div>
            </tab>
            <tab>
                <tab-heading>
                    Add New Staff
                </tab-heading>
                <div class="row">
                    <div class="col-sm-12">
                        <h3>Staff Details</h3>
                        <hr/>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal">
                            <h5 class="mt5"><strong>Personal Information</strong></h5>
                            <hr/>
                            <div class="form-group mt5">
                                <div class="col-sm-6">
                                    <input type="text" ng-model="staff.last_name" class="form-control"
                                           placeholder="Last Name"/>
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" ng-model="staff.first_name" class="form-control"
                                           placeholder="First Name"/>
                                </div>
                            </div>
                            <div class="form-group mt5">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" ng-model="staff.middle_name"
                                           placeholder="Middle Name"/>
                                </div>

                                <div class="col-sm-6">
                                    <select class="form-control" ng-model="staff.sex">
                                        <option value="">Sex</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mt5">
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" ng-model="staff.birth_date"
                                           placeholder="Birth Date"/>
                                </div>

                                <div class="col-sm-6">
                                    <select class="form-control" ng-model="staff.religion">
                                        <option value="">Religion</option>
                                        <option value="christian">Christian</option>
                                        <option value="muslim">Muslim</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mt5">
                                <div class="col-sm-6" ng-model="staff.country">
                                    <select class="form-control">
                                        <option value="">Country</option>
                                        <option value="nigeria">Nigeria</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <select class="form-control" ng-model="staff.state">
                                        <option value="">State</option>
                                        <option value="abia">Abia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mt5">
                                <div class="col-sm-6" ng-model="staff.lga">
                                    <select class="form-control">
                                        <option value="">LGA</option>
                                        <option value="abia">Abia</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <select class="form-control" ng-model="staff.marital_status">
                                        <option value="">Marital Status</option>
                                        <option value="abia">Single</option>
                                    </select>
                                </div>
                            </div>
                            <h5 class="mt5"><strong>Employment Information</strong></h5>
                            <hr/>
                            <div class="form-group mt5">
                                <div class="col-sm-6">
                                    <input type="date" ng-model="staff.employment_date" class="form-control"
                                           placeholder="Employment Date"/>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" ng-model="staff.employment_status">
                                        <option value="">Employment Status</option>
                                        <option value="active">Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt5">
                                <div class="col-sm-12">
                                    <input type="text" tagsinput="tagsinput" ng-value="staff.qualifications.join(',')"
                                           ng-model="staff.qualifications" placeholder="Qualifications">
                                </div>
                            </div>

                            <h5 class="mt5"><strong>Medical Information</strong></h5>
                            <hr/>
                            <div class="form-group mt5">
                                <div class="col-sm-6">
                                    <select class="form-control" ng-model="staff.blood_group">
                                        <option value="">Blood Group</option>
                                        <option value="active">Active</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <select class="form-control" ng-model="staff.genotype">
                                        <option value="">Genotype</option>
                                        <option value="active">Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt5">
                                <div class="col-sm-12">
                                    <input type="text" tagsinput="tagsinput" ng-value="staff.disabilities.join(',')"
                                           ng-model="staff.disabilities" placeholder="Disabilities"
                                           class="form-control">
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-horizontal">
                            <div class="form-group mt5">
                                <div class="col-sm-12">
                                    <img style="max-height: 300px" class="img-responsive"
                                         ng-src="@{{staff.picture.dataURL || '/img/placeholder.jpg'}}"
                                         type="@{{staff.picture.file.type}}"/>
                                </div>
                            </div>
                            <div class="form-group mt5">
                                <div class="col-sm-12 mt5">
                                    <input id="inputImage"
                                           filestyle=""
                                           type="file"
                                           data-classbutton="btn btn-default"
                                           data-classinput="form-control inline"
                                           style="max-width: 250px"
                                           class="form-control"
                                           accept="image/*"
                                           image="staff.picture"/>
                                </div>
                            </div>

                            <h5 class="mt5"><strong>Contact Information</strong></h5>
                            <hr/>
                            <div class="form-group mt5">
                                <div class="col-sm-6">
                                    <input type="text" ng-model="staff.contact_phone" class="form-control"
                                           placeholder="Contact Phone"/>
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" ng-model="staff.contact_email"
                                           placeholder="Contact Email"/>
                                </div>
                            </div>

                            <div class="form-group mt5">
                                <div class="col-sm-12">
                                    <textarea placeholder="Contact Address" ng-model="staff.contact_address" cols="30"
                                              rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success" ng-click="saveStaff(staff)">Save
                            Changes
                        </button>
                    </div>
                </div>
            </tab>
        </tabset>

    </div>
</div>


<toaster-container toaster-options="{'close-button': true, 'position-class': 'toast-top-right' }"></toaster-container>