<!DOCTYPE html>
<html lang="en" ng-app="SchoolAdminApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{ asset('landing_page/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('school_admin/css/school.css') }}" rel="stylesheet">
    {{-- Laravel Based  --}}
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('landing_page/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<nav class="navbar navbar-default" ng-controller="NavBarController">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{{ $school->name }}</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @yield('navbar')
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="/admin/auth/login">Login</a></li>
                @else
                    <li class="dropdown" dropdown on-toggle="toggled(open)">
                        <a href class="dropdown-toggle" dropdown-toggle>
                            {{ Auth::user()->email }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/auth/logout">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<script src="{{ asset('app/libs/core.js') }}"></script>
<script src="{{ asset('app/libs/others.js') }}"></script>
<script src="{{ asset('school_admin/js/main.js') }}"></script>


<script>
    @yield('script')
</script>
<script>
    angular.module('SchoolAdminApp').constant('CSRF_TOKEN', '{{ csrf_token() }}');
</script>
</body>
</html>
