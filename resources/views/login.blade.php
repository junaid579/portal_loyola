<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Metronic | User Login 1</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <!--<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />-->
        <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/select2/css/select2.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/global/css/components.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/global/css/plugins.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/pages/css/login.min.css') }}" />
        
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="{{ URL::asset('assets/pages/img/logo-big.png') }}" alt="Loyola Hight School" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="login" method="POST">
                <h3 class="form-title font-green">Sign In</h3>
                @if(Session::has('error_message'))
                    <div class="alert alert-danger display-show">
                        <button class="close" data-close="alert"></button>
                        <span> {{ Session::get('error_message') }} </span>
                    </div>
                @endif
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Year</label>
                    <select name="year" class="form-control">
                        @foreach($idyears as $idyear)
                            <option value="{{ $idyear->id }}">{{ $idyear->academic_year }}</option>
                        @endforeach
                    </select></div>
                <div class="form-actions">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <button type="submit" class="btn green uppercase">Login</button>
                </div>
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <div class="copyright"> 2017 © Loyola Hight School.</div>
        
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/js.cookie.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery.blockui.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/select2/js/select2.full.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/global/scripts/app.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/pages/scripts/login.min.js') }}"></script>


        
    </body>

</html>