<!DOCTYPE html>
<html class="no-js" ng-app="UnifySchoolApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    {{-- Laravel Based  --}}
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('app/css/main.css') }}">
</head>
<body>

<div class="container-fluid" ng-init="currentProgress = '0%'">
    <h1>School Registration</h1>

    <div class="progress">
        <div class="progress-bar progress-bar-info" ng-style="{width: currentProgress }"></div>
    </div>
</div>

<div class="container" style="margin-top: 20px;padding-bottom: 100px">
    <div class="row">
        <div class="col-md-12 col-lg-offset-1 col-lg-10">
            <div class="widget-canvas">
                <div ui-view class="v">
                    <div class="" style="
                        padding-top: 50px;
                    ">
                        <img src="{{ asset('app/img/loading.gif') }}" class="img-responsive" style="
                            margin-left: auto;
                            margin-right: auto;
                        ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('app/libs/core.js') }}"></script>
<script src="{{ asset('app/libs/others.js') }}"></script>
<script src="{{ asset('app/js/main.js') }}"></script>
</body>
</html>
