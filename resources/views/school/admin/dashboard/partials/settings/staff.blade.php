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
                <div class="row" style="padding-top: 15px">
                    <div class="col-sm-12" ng-show="currentStaff" >
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h4>Currently Selected Staff</h4>
                                <div class="media-box">
                                    <div class="pull-left">
                                        <img ng-src="@{{ currentStaff.picture.dataURL || 'data:image/png;base64,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'}}" alt="Image"
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
                                            <img ng-src="@{{ staff.picture.dataURL || 'data:image/png;base64,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'}}" alt="Image"
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
                                <div class="btn-group" dropdown>
                                    <button type="button"
                                            class="btn btn-default navbar-btn">
                                        <span ng-bind="courses.selected.name"></span></button>
                                    <button type="button"
                                            class="btn btn-default navbar-btn dropdown-toggle"
                                            dropdown-toggle>
                                        <span class="caret"></span>
                                        <span class="sr-only">Split button!</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li ng-repeat="course in courses">
                                            <a href="#" ng-click="selectCourse($event,course,courses)">@{{ course.name }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <span class="btn btn-primary">
                                    Assign
                                </span>
                            </div>
                            <!-- START list group-->
                            <scrollable height="360" class="list-group" ng-init="filterCourse = null">
                                <span>Assigned Courses</span>
                                <!-- START list group item-->
                                <a href="#" class="list-group-item"
                                   ng-repeat="course in currentStaff.assigned_courses">
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

                                <div class="btn-group" dropdown>
                                    <button type="button"
                                            class="btn btn-default navbar-btn">
                                        <span ng-bind="classes.selected.display_name"></span>
                                    </button>
                                    <button type="button"
                                            class="btn btn-default navbar-btn dropdown-toggle"
                                            dropdown-toggle>
                                        <span class="caret"></span>
                                        <span class="sr-only">Split button!</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li ng-repeat="arm in classes">
                                            <a href="#" ng-click="selectCourse($event,arm,classes)">@{{ arm.display_name }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <span class="btn btn-primary">
                                    Assign
                                </span>
                            </div>
                            <!-- START list group-->
                            <scrollable height="360" class="list-group">
                                <span>Assigned Classes</span>
                                <!-- START list group item-->
                                <a href="#" class="list-group-item"
                                   ng-repeat="class in currentStaff.assigned_classes">
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