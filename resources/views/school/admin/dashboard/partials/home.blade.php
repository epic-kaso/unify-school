<h3>Dashboard</h3>
<div class="col-sm-12">
    <!-- START row-->
    <div class="row">
        {{--@include('school.admin.dashboard.blade-partials.home.widgets')--}}
    </div>

    <div ng-if="!school.setup_complete && !school.first_login" class="row" style="margin-bottom: 70px;">
        @include('school.admin.dashboard.blade-partials.home.incomplete-setup')
    </div>

    <div ng-if="school.first_login" class="row" style="margin-bottom: 70px;">
        @include('school.admin.dashboard.blade-partials.home.first-login-wizard')
    </div>

    <div ng-if="school.setup_complete && !school.first_login" class="row" style="margin-bottom: 70px;">
        @include('school.admin.dashboard.blade-partials.home.modules')
    </div>


</div>
