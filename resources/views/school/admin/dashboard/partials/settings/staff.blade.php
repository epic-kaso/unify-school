<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Staff Settings</h3><hr/>
    </div>
    <div class="panel-body">
        <tabset justified="false" type="pills">
            <tab>
                <tab-heading>
                    Assignments
                </tab-heading>
                <div class="row">
                    <div class="col-sm-6">
                        <select class="form-control" ng-model="school_category_id"
                                ng-options="system.id as system.name for system in school_categories">
                            <option value="">Select Staff</option>
                        </select>
                    </div>


                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Assign Course</h3><hr/>
                                <select class="form-control" ng-model="school_category_id"
                                        ng-options="system.id as system.name for system in school_categories">
                                    <option value="">Select Staff</option>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <h3>Assign Class</h3><hr/>

                                <select class="form-control" ng-model="school_category_id"
                                        ng-options="system.id as system.name for system in school_categories">
                                    <option value="">Select Staff</option>
                                </select>
                            </div>
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
                                    <input type="text" ng-model="staff.last_name" class="form-control" placeholder="Last Name"/>
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" ng-model="staff.first_name" class="form-control" placeholder="First Name" />
                                </div>
                            </div>
                            <div class="form-group mt5">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" ng-model="staff.middle_name" placeholder="Middle Name"/>
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
                                    <input type="date" class="form-control" ng-model="staff.birth_date" placeholder="Birth Date"/>
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
                                        <option value="abia">Single </option>
                                    </select>
                                </div>
                            </div>
                            <h5 class="mt5"><strong>Employment Information</strong></h5>
                            <hr/>
                            <div class="form-group mt5">
                                <div class="col-sm-6">
                                    <input type="date" ng-model="staff.employment_date" class="form-control" placeholder="Employment Date" />
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" ng-model="staff.employment_status">
                                        <option value="">Employment Status</option>
                                        <option value="active">Active </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt5">
                                <div class="col-sm-12">
                                    <input type="text" tagsinput="tagsinput" ng-value="staff.qualifications.join(',')" ng-model="staff.qualifications" placeholder="Qualifications" >
                                </div>
                            </div>

                            <h5 class="mt5"><strong>Medical Information</strong></h5>
                            <hr/>
                            <div class="form-group mt5">
                                <div class="col-sm-6">
                                    <select class="form-control" ng-model="staff.blood_group">
                                        <option value="">Blood Group</option>
                                        <option value="active">Active </option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <select class="form-control" ng-model="staff.genotype">
                                        <option value="">Genotype</option>
                                        <option value="active">Active </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt5">
                                <div class="col-sm-12">
                                    <input type="text" tagsinput="tagsinput" ng-value="staff.disabilities.join(',')" ng-model="staff.disabilities" placeholder="Disabilities" class="form-control">
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-horizontal">
                        <div class="form-group mt5">
                            <div class="col-sm-12">
                                <img style="max-height: 300px" class="img-responsive" ng-src="@{{staff.image.dataURL || '/img/placeholder.jpg'}}"
                                     type="@{{staff.image.file.type}}"/>
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
                                   image="staff.image"/>
                                </div>
                        </div>

                            <h5 class="mt5"><strong>Contact Information</strong></h5>
                            <hr/>
                        <div class="form-group mt5">
                            <div class="col-sm-6">
                                <input type="text" ng-model="staff.contact_phone" class="form-control" placeholder="Contact Phone"/>
                            </div>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" ng-model="staff.contact_email" placeholder="Contact Email" />
                            </div>
                        </div>

                        <div class="form-group mt5">
                            <div class="col-sm-12">
                                <textarea placeholder="Contact Address" ng-model="staff.contact_address" cols="30" rows="5" class="form-control"></textarea>
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