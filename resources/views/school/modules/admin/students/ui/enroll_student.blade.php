<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3>Enroll Student</h3>
                <hr/>
            </div>

            <div class="panel-body">
                <form action="{{ route('admin.modules.students.store',[],false)  }}"
                      name="enrollStudentForm"
                      ng-upload="enrollStudentCompleted(content)"
                      ng-upload-loading="loading()"
                        >
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-horizontal">
                                <h5 class="mt5"><strong>Personal Information</strong></h5>
                                <hr/>
                                <div class="form-group mt5">
                                    <div class="col-sm-6">
                                        <input type="text"
                                               required=""
                                               ng-model="student.last_name"
                                               name="student.last_name"
                                               class="form-control"
                                               placeholder="Last Name"/>
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text"
                                               required=""
                                               ng-model="student.first_name"
                                               name="student.first_name"
                                               class="form-control"
                                               placeholder="First Name"/>
                                    </div>
                                </div>
                                <div class="form-group mt5">
                                    <div class="col-sm-6">
                                        <input type="text"
                                               required=""
                                               class="form-control"
                                               ng-model="student.middle_name"
                                               name="student.middle_name"
                                               placeholder="Middle Name"/>
                                    </div>

                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                required=""
                                                ng-model="student.sex"
                                                name="student.sex">
                                            <option value="">Sex</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mt5">
                                    <div class="col-sm-6">
                                        <input type="date"
                                               class="form-control"
                                               ng-model="student.birth_date" name="student.birth_date"
                                               placeholder="Birth Date"/>
                                    </div>

                                    <div class="col-sm-6">
                                        <select class="form-control" ng-model="student.religion" name="student.religion">
                                            <option value="">Religion</option>
                                            <option value="christian">Christian</option>
                                            <option value="muslim">Muslim</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mt5">
                                    <div class="col-sm-6">
                                        <select class="form-control" ng-model="student.country" name="student.country">
                                            <option value="">Country</option>
                                            <option value="nigeria">Nigeria</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <select class="form-control" ng-model="student.state" name="student.state">
                                            <option value="">State</option>
                                            <option value="abia">Abia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mt5">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" ng-model="student.lga" name="student.lga"
                                               placeholder="L.G.A"/>
                                    </div>

                                    <div class="col-sm-6">
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-horizontal">
                                <h5 class="mt5"><strong>School Information</strong></h5>
                                <hr/>
                                <div class="form-group mt5">
                                    <div class="col-sm-6">
                                        <input type="date"
                                               ng-model="student.session"
                                               required=""
                                               name="student.session"
                                               class="form-control"
                                               placeholder="Session"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                required=""
                                                ng-model="student.sub_session"
                                                name="student.sub_session">
                                            <option value="">Term</option>
                                            <option value="first">First</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mt5">
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                required=""
                                                ng-model="student.school_category"
                                                name="student.school_category">
                                            <option value="">Nursery</option>
                                            <option value="active">Primary</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                required=""
                                                ng-model="student.school_class"
                                                name="student.school_class">
                                            <option value="">Class</option>
                                            <option value="active">JSS 1</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mt5">
                                    <div class="col-sm-6">
                                        <input type="date"
                                               required=""
                                               ng-model="student.admission_date"
                                               name="student.admission_date"
                                               class="form-control"
                                               placeholder="Date of Admission"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                required=""
                                                ng-model="student.admission_status"
                                                name="student.admission_status">
                                            <option value="">Active</option>
                                            <option value="first">First</option>
                                        </select>
                                    </div>
                                </div>


                                <h5 class="mt5"><strong>Medical Information</strong></h5>
                                <hr/>
                                <div class="form-group mt5">
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                ng-model="student.blood_group"
                                                name="student.blood_group">
                                            <option value="">Blood Group</option>
                                            <option value="active">Active</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                ng-model="student.genotype"
                                                name="student.genotype">
                                            <option value="">Genotype</option>
                                            <option value="active">Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mt5">
                                    <div class="col-sm-12">
                                        <input type="text" tagsinput="tagsinput" ng-value="student.disabilities.join(',')"
                                               ng-model="student.disabilities"
                                               name="student.disabilities"
                                               placeholder="Disabilities"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-horizontal">
                                <div class="form-group mt5">
                                    <div class="col-sm-12">
                                        <img style="max-height: 120px" class="img-responsive"
                                             ng-src="@{{student.picture.dataURL || '/img/placeholder.jpg'}}"
                                             type="@{{student.picture.file.type}}"/>
                                    </div>
                                </div>
                                <div class="form-group mt5">
                                    <div class="col-sm-12 mt5">
                                        <input id="inputImage"
                                               filestyle=""
                                               type="file"
                                               data-classbutton="btn btn-default"
                                               data-classinput="form-control inline"
                                               class="form-control"
                                               accept="image/*"
                                               name="student.picture"
                                               image="student.picture"/>
                                    </div>
                                </div>

                                <h5 class="mt5"><strong>Contact Information</strong></h5>
                                <hr/>
                                <div class="form-group mt5">
                                    <div class="col-sm-6">
                                        <input type="text"
                                               ng-model="student.contact_phone"
                                               name="student.contact_phone"
                                               class="form-control"
                                               placeholder="Contact Phone"/>
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control"
                                               ng-model="student.contact_email"
                                               name="student.contact_email"
                                               placeholder="Contact Email"/>
                                    </div>
                                </div>

                                <div class="form-group mt5">
                                    <div class="col-sm-12">
                                    <textarea placeholder="Contact Address"
                                              ng-model="student.contact_address"
                                              name="student.contact_address" cols="30"
                                              rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <span class="pull-right">
                                <span ng-show="$isUploading">
                                <span class="fa fa-spin fa-spinner"></span> Uploading...
                            </span>
                            <input type="submit"
                                   value="Save"
                                   class="btn btn-success"
                                   ng-disabled="$isUploading" />
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>