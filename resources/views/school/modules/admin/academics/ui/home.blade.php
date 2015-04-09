<div>
    <div>
        <ul class="nav nav-pills">
            <li><a href="#" ng-click="goBack($event)"><span class="fa fa-chevron-left"></span> Back</a></li>
            {{--<li>--}}
                {{--<a ui-sref="" ui-sref-active="active">--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
    </div>
    <div ui-view></div>
    <toaster-container toaster-options="{'close-button': true, 'position-class': 'toast-top-right' }"></toaster-container>
</div>