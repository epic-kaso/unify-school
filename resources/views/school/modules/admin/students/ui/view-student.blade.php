<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-5">
                <img style="height: 55px;border-radius: 100px;" 
                 class="img-responsive img-rounded img-thumbnail pull-left" 
                 ng-src="@{{ student.picture.dataURL || '/img/placeholder.jpg'}}" alt=""/>
                 <span style="font-size: 22px;margin-left: 10px;">@{{ student.last_name }} @{{ student.first_name }}</span> <br/>
                 <span style="margin-left: 10px;">Reg Number: <strong>@{{ student.reg_number }}</strong></span>
            </div>
            
            <div class="col-sm-7">
                <div class="btn-group">
                    <button class="btn btn-default">Promote</button>
                    <button class="btn btn-default">Demote</button>
                    <button class="btn btn-default">Change Class</button>
                    
                </div>
                
                <div class="btn-group">
                    <button class="btn btn-success">Save Changes</button>
                </div>
            </div>
        
        </div>
        
        <hr/>
    </div>
    <div class="panel-body">
         <div class="row">
            <div class="col-md-4">
                <div class="form-horizontal">
                    <h5 class="mt5"><strong>Personal Information</strong></h5>
                    <hr/>
                    
                    <div class="form-group mt5">
                        <div class="col-sm-6">
                            <label>Last Name</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.last_name">@{{ student.last_name || &apos;empty&apos; }}</a>
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <label>First Name</label>
                           <p class="form-control-static">
                                <a href="#" editable-text="student.first_name">@{{ student.first_name || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                    </div>
                    <div class="form-group mt5">
                        <div class="col-sm-6">
                            <label>Middle Name</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.middle_name">@{{ student.middle_name || &apos;empty&apos; }}</a>
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <label>Gender</label>
                            <p class="form-control-static">
                                <a href="#" e-ng-options="s.value as s.label for s in gender" editable-select="student.sex">@{{ student.sex || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                    </div>
                    <div class="form-group mt5">
                        <div class="col-sm-6">
                            <label>Date</label>
                            <p class="form-control-static">
                              <a href="#" editable-bsdate="student.birth_date" e-datepicker-popup="dd-MMMM-yyyy">
                                @{{ (student.birth_date | date:"dd/MM/yyyy") || 'empty' }}
                              </a>
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <label>Religion</label>
                            <p class="form-control-static">
                                <a href="#" e-ng-options="s.value as s.label for s in religion" editable-select="student.religion">@{{ student.religion || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                    </div>
                    <div class="form-group mt5">
                        <div class="col-sm-6">
                            <label>Country</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.country">@{{ student.country || &apos;empty&apos; }}</a>
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <label>State</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.state">@{{ student.state || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                    </div>
                    <div class="form-group mt5">
                        <div class="col-sm-6">
                            <label>L.G.A</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.lga">@{{ student.lga || &apos;empty&apos; }}</a>
                            </p>
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
                            <label>Session</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.session">@{{ student.session || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <label>Term</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.sub_session">@{{ student.sub_session || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                    </div>

                    <div class="form-group mt5">
                        <div class="col-sm-6">
                            <label>School Category</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.school_category">@{{ student.school_category || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <label>Class </label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.school_class">@{{ student.school_class || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                    </div>

                    <div class="form-group mt5">
                        <div class="col-sm-6">
                            <label>Admision Date</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.admission_date">@{{ student.admission_date || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                        {{--<div class="col-sm-6">--}}
                            {{--<select class="form-control"--}}
                                    {{--required=""--}}
                                    {{--ng-model="student.admission_status"--}}
                                    {{--name="student.admission_status">--}}
                                {{--<option value="">Active</option>--}}
                                {{--<option value="first">First</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    </div>


                    <h5 class="mt5"><strong>Medical Information</strong></h5>
                    <hr/>
                    <div class="form-group mt5">
                        <div class="col-sm-6">
                            <label>Blood Group</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.blood_group">@{{ student.blood_group || &apos;empty&apos; }}</a>
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <label>Genotype</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.genotype">@{{ student.genotype || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                    </div>

                    <div class="form-group mt5">
                        <div class="col-sm-12">
                            <label>Disabilities</label>
                            <p class="form-control-static">
                                <a href="#" e-tagsinput="tagsinput" e-ng-value="student.disabilities.join(',')" 
                                editable-text="student.disabilities">@{{ student.disabilities || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                    </div>

                    <div class="form-group mt5">
                        <div class="col-sm-12">
                            <label>Medical Conditions</label>
                             <p class="form-control-static">
                                <a href="#" e-tagsinput="tagsinput" e-ng-value="student.medical_conditions.join(',')" 
                                editable-text="student.medical_conditions">@{{ student.medical_conditions || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-horizontal">
                    

                    <h5 class="mt5"><strong>Contact Information</strong></h5>
                    <hr/>
                    <div class="form-group mt5">
                        <div class="col-sm-6">
                            <label>Contact Phone</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.contact_phone">@{{ student.contact_phone || &apos;empty&apos; }}</a>
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <label>Contact Email</label>
                            <p class="form-control-static">
                                <a href="#" editable-text="student.contact_email">@{{ student.contact_email || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                    </div>

                    <div class="form-group mt5">
                        <div class="col-sm-12">
                            <label>Contact Address</label>
                        <p class="form-control-static">
                                <a href="#" editable-textarea="student.contact_address">@{{ student.contact_address || &apos;empty&apos; }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <input type="submit"
                       value="Save"
                       ng-hide="student.isUploading"
                       class="btn btn-success"
                       ng-click="updateStudent(student)"
                       ng-disabled="student.isUploading" />
                </span>
            </div>
        </div>
               
    </div>
</div>


<toaster-container toaster-options="{'close-button': true, 'position-class': 'toast-top-right' }"></toaster-container>