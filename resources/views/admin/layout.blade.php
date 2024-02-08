<?php $version = env('JS_VERSION'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>M/s New Nabaratna Hospitality Pvt. Ltd.</title>

    <link rel="stylesheet" type="text/css" href="{{url('bootstrap3/css/bootstrap.min.css')}}">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('date/bootstrap-time.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/custom.css?v='.$version)}}">
</head>
<body  ng-app="app">
	<div id="wrapper">
        <div class="container-fluid">
            <div id="content" style="display: flex;">
                <!-- <div class="ul" style="width:250px;background-color: #ececec59;position: fixed;top: 0;left: 0;height: 100vh;overflow-y: scroll;padding:0;"> -->
                <div class="ul" style="width:250px;background-color: #000;position: fixed;top: 0;left: 0;height: 100vh;overflow-y: scroll;padding:0;">
                    <div style="padding:16px;">
                        <span style="font-size: 18px;font-weight: bold;color: #FFF;">M/s New Nabaratna Hospitality Pvt. Ltd.</span> 
                        <div style="font-size: 12px; padding-top: 5px;color: #FFF;">Gorakhpur Railway Station | GSTIN : 18AAICN4763E1ZA</div>
                    </div>
                    <ul class="nav nav-pills nav-stacked">

                        <li class="@if(isset($sidebar)) @if($sidebar == 'dashboard') active @endif @endif">
                            <a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a>
                        </li>
                        
                        <li class="@if(isset($sidebar)) @if($sidebar == 'pods') active @endif @endif">
                            <a href="{{url('/admin/entries/1')}}"><i class="fa fa-podcast"></i>PODs</a>
                        </li>
                        <li class="@if(isset($sidebar)) @if($sidebar == 'scabins') active @endif @endif">
                            <a href="{{url('/admin/entries/2')}}"><i class="fa fa-tasks"></i>Single Suit Cabin</a>
                        </li>
                        <li class="@if(isset($sidebar)) @if($sidebar == 'beds') active @endif @endif">
                            <a href="{{url('/admin/entries/3')}}"><i class="fa fa-bed"></i>Double Beds</a>
                        </li>
                        <li class="@if(isset($sidebar)) @if($sidebar == 'shift') active @endif @endif">
                            <a href="{{url('/admin/shift/current')}}"><i class="fa fa-lock"></i>Shift</a>
                        </li>
                        @if(Auth::user()->priv == 1)
                            <li class="@if(isset($sidebar)) @if($sidebar == 'all-entries') active @endif @endif">
                                <a href="{{url('/admin/all-entries')}}"><i class="fa fa-navicon" aria-hidden="true"></i>All Entries</a>
                            </li>
                        @endif
                        @if(Auth::user()->priv == 1)
                            <li class="@if(isset($sidebar)) @if($sidebar == 'users') active @endif @endif">
                                <a href="{{url('/admin/users')}}"><i class="fa fa-users" aria-hidden="true"></i>Users</a>
                            </li>
                        @endif

                        <li class="@if(isset($sidebar)) @if($sidebar == 'change_pass') active @endif @endif">
                            <a href="{{url('/admin/reset-password')}}"><i class="fa fa-key" aria-hidden="true"></i>Reset Password</a>
                        </li>

                        <li>
                            <a href="{{url('/logout')}}"><i class="fa fa-sign-out"></i>Logout</a>
                        </li>
                     
                    </ul>
                    
                </div>
                <div class="" style="padding-left:250px;width: 100%;">
                    <div style="text-align:right;padding-top:8px;padding-bottom: 8px;padding-right:24px;margin: 0 -15px;background: #000;box-shadow:0 0 2px rgba(0,0,0,0.5);"><strong style="color: #fff;"> {{Auth::user()->name}}</strong></div>
                    <div style="padding:0 20px;"> 
                        @yield('main')
                    </div>
                </div>
             
            </div>
        </div>
		
    </div>
    <script type="text/javascript">
        var base_url = "{{url('/')}}";
        var CSRF_TOKEN = "{{ csrf_token() }}";
    </script>
    <script type="text/javascript" src="{{url('assets/scripts/jquery.min.js')}}"></script>
    <script src="{{url('assets/scripts/jquery-ui.min.js')}}"></script>
    
    <script type="text/javascript" src="{{url('bootstrap3/js/bootstrap.min.js')}}"></script>
    <!-- <script type="text/javascript" src="{{url('date/bootstrapp-time.min.js')}}"></script> -->

    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

    <script>
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            // format: 'dd/mm/YYYY',
        });
        $('.datepicker1').datepicker({
            uiLibrary: 'bootstrap4',
            // format: 'dd/mm/YYYY',
        });
        $('.datepicker2').datepicker({
            uiLibrary: 'bootstrap4',
            // format: 'dd/mm/YYYY',
        });
        $('.datepicker2').datepicker({
            uiLibrary: 'bootstrap4',
            // format: 'dd/mm/YYYY',
        });
        $('.datepicker3').datepicker({
            uiLibrary: 'bootstrap4',
            // format: 'dd/mm/YYYY',
        });
        $('.datepicker4').datepicker({
            uiLibrary: 'bootstrap4',
            // format: 'dd/mm/YYYY',
        });
    </script>

    <script type="text/javascript" src="{{url('assets/scripts/angular.min.js')}}" ></script>
    <script type="text/javascript" src="{{url('assets/scripts/jcs-auto-validate.js')}}" ></script>
    <script type="text/javascript" src="{{url('assets/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/scripts/core/app.js')}}" ></script>
    <script type="text/javascript" src="{{url('assets/scripts/core/services.js')}}" ></script>
    <script type="text/javascript" type="text/javascript" src="{{url('assets/scripts/core/controller.js?v='.$version)}}"></script>
    <script type="text/javascript" type="text/javascript" src="{{url('assets/scripts/core/user_ctrl.js?v='.$version)}}"></script>
    <script>
      angular.module("app").constant("CSRF_TOKEN", "{{ csrf_token() }}");
    </script>
    <!-- <script type="text/javascript">
        $(document).ready(function(){
            $('#timePicker').timepicker({
                minuteStep: 1,
            });
            $('#timePicker2').timepicker({
                minuteStep:1,
            });
        });
    </script> -->


</body>
</html>