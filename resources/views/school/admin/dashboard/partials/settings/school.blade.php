<div class="panel panel-default">
    <div class="panel-heading">
        <h3>School Settings</h3>
        <hr/>
    </div>
    <div class="panel-body">
        <tabset justified="false" type="pills">
            <tab>
                <tab-heading>
                    School Profile
                </tab-heading>
                <div class="row">
                    <div class="col-sm-12">
                        <h3>School Profile</h3>
                        <hr/>
                    </div>
                    <div class="col-md-6">
                        <div class="form-horizontal">
                            <div class="form-group m0">
                                <label class="col-sm-5 control-label">Name:</label>

                                <div class="col-sm-7">
                                    <p class="form-control-static"><a href="#"
                                                                      editable-text="school.school_profile.name">@{{ school.school_profile.name || &apos;empty&apos; }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group m0">
                                <label class="col-sm-5 control-label">Date Established:</label>

                                <div class="col-sm-7">
                                    <p class="form-control-static"><a href="#"
                                                                      editable-date="school.school_profile.established_date">@{{ school.school_profile.established_date || &apos;empty&apos; }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group m0">
                                <label class="col-sm-5 control-label">Motto:</label>

                                <div class="col-sm-7">
                                    <p class="form-control-static"><a href="#"
                                                                      editable-text="school.school_profile.motto">@{{ school.school_profile.motto || &apos;empty&apos; }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group m0">
                                <label class="col-sm-5 control-label">Mission:</label>

                                <div class="col-sm-7">
                                    <p class="form-control-static"><a href="#"
                                                                      editable-text="school.school_profile.mission">@{{ school.school_profile.mission || &apos;empty&apos; }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group m0">
                                <label class="col-sm-5 control-label">Vision:</label>

                                <div class="col-sm-7">
                                    <p class="form-control-static"><a href="#"
                                                                      editable-text="school.school_profile.vision">@{{ school.school_profile.vision || &apos;empty&apos; }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group m0">
                                <label class="col-sm-5 control-label">Website:</label>

                                <div class="col-sm-7">
                                    <p class="form-control-static"><a href="#"
                                                                      editable-url="school.school_profile.website_url">@{{ school.school_profile.website_url || &apos;empty&apos; }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group m0">
                                <label class="col-sm-5 control-label">Contact Email:</label>

                                <div class="col-sm-7">
                                    <p class="form-control-static"><a href="#"
                                                                      editable-email="school.school_profile.contact_email">@{{ school.school_profile.contact_email || &apos;empty&apos; }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group m0">
                                <label class="col-sm-5 control-label">Contact Phone:</label>

                                <div class="col-sm-7">
                                    <p class="form-control-static"><a href="#"
                                                                      editable-tel="school.school_profile.contact_phone_number"
                                                                      e-pattern="\d{11}"
                                                                      e-title="xxxxxxxxxxx">@{{ school.school_profile.contact_phone_number || &apos;empty&apos; }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <img style="max-height: 300px" class="img-responsive" ng-src="@{{school.school_profile.image.dataURL || school.school_profile.logo.dataURL}}"
                                 type="@{{school.school_profile.image.file.type}}"/>
                        </div>
                        <div class="form-group">
                            <input id="inputImage"
                                   type="file"
                                   style="max-width: 250px"
                                   class="form-control"
                                   accept="image/*"
                                   image="school.school_profile.image"/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success" ng-click="saveSchoolProfile(school.school_profile)">Save
                            Changes
                        </button>
                    </div>
                </div>
            </tab>
            <tab>
                <tab-heading>
                    Home Page
                </tab-heading>
                <div class="row">
                    <div class="col-sm-12">
                        <h3>Home Page Specific Settings</h3>
                        <hr/>
                        <div class="form-group">
                            <img ng-show="image" ng-src="@{{school.school_profile.wallpaper.dataURL}}"
                                 type="@{{school.school_profile.wallpaper.file.type}}"/>
                        </div>
                        <div class="form-group">
                            <input id="inputImage"
                                   filestyle=""
                                   type="file"
                                   data-classbutton="btn btn-default"
                                   data-classinput="form-control inline"
                                   style="max-width: 250px"
                                   class="form-control"
                                   accept="image/*"
                                   image="school.school_profile.wallpaper"/>
                        </div>
                        <div class="form-horizontal">
                            <div class="form-group m0">
                                <label class="col-sm-5 control-label">About School</label>

                                <div class="col-sm-7">
                                    <p class="form-control-static"><a href="#" editable-textarea="school.school_profile.about"
                                                                      e-rows="3"
                                                                      e-cols="30">@{{ school.school_profile.about || 'no description' }}    </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tab>
        </tabset>

    </div>
</div>


<toaster-container toaster-options="{'close-button': true, 'position-class': 'toast-top-right' }"></toaster-container>