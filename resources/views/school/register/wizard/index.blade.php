<!DOCTYPE html>
<html class="no-js" ng-app="UnifySchoolApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('landing_page/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- Laravel Based  --}}
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('landing_page/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('app/css/main.css') }}">
</head>
<body>

<div class="container-fluid" ng-init="currentProgress = '0%'" style="padding: 0px;
  position: fixed;top: 0;width: 100%;z-index: 100;background-color: black;">
    <h1 style="padding: 10px;font-weight: 400;color: #fed136;">School Registration</h1>

    <div class="progress">
        <div class="progress-bar progress-bar-info" ng-style="{width: currentProgress }"></div>
    </div>
</div>

<div class="container" style="margin-top: 120px;padding-bottom: 100px">
    <div class="row">
        <div class="col-md-12 col-lg-offset-1 col-lg-10">
            <div class="widget-canvas">
                <div ui-view class="v">
                    <div class="" style="
                        padding-top: 50px;
                    ">
                        <span style="color: #fed136;font-size: 100px; display: block;text-align: center;width: 120px; margin-left: auto;margin-right: auto;">
                            <span class="fa fa-spin fa-spinner"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<toast type="toast.type" show="toast.show" messages="toast.messages"></toast>

<script src="{{ asset('app/libs/core.js') }}"></script>
<script src="{{ asset('app/libs/others.js') }}"></script>
<script src="{{ asset('app/js/main.js') }}"></script>
</body>
</html>
