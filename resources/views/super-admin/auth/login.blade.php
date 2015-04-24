@extends('super-admin.auth.layout')

@section('content')
    <div class="block-center mt-xl wd-xl">
        <!-- START panel-->
        <div class="panel panel-dark panel-flat">
            <div class="panel-heading text-center">
                <a href="#">
                    <img src="/app/img/klipboard-purple.png" alt="Image" class="block-center img-rounded"/>
                </a>
            </div>
            <div class="panel-body">
                <h2 style="text-align: center">Super Admin Login</h2>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form role="form" method="POST" action="/unify/auth/login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <div class="col-md-12" style="margin-bottom: 10px">
                            <input type="email" placeholder="E-Mail Address" class="form-control" name="email"
                                   value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12" style="margin-bottom: 10px">
                            <input type="password" placeholder="Password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="checkbox c-checkbox pull-left mt0">
                                <label>
                                    <input type="checkbox" name="remember"/>
                                    <span class="fa fa-check"></span>Remember Me</label>
                                </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block"
                                    style="margin-right: 15px;padding: 10px;font-size: 22px;margin-bottom: 5px;">
                                Login
                            </button>

                            <a href="/password/email">Forgot Your Password?</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- END panel-->
        <div class="p-lg text-center">
            <span>&copy;</span>
            <span>{{ \Carbon\Carbon::now()->year }}</span>
            <span>-</span>
            <span>Unify</span>
            <br/>
            <span>Advance school management system</span>
        </div>
    </div>
@endsection
