<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Heozeo') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('extra-css')

</head>
<body class="nav-md">
    <div class="container body">
      
        <div class="main_container">
            <div class="col-md-3 left_col">

                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title">
                            <i class="fa fa-header"></i> 
                            <span>
                                {{ config('app.name', 'Heozeo') }}
                            </span>
                        </a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ asset('images/user.png') }}" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>
                                {{ Auth()->user()->name }}
                            </h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <div class="clearfix"></div>
                            <ul class="nav side-menu">
                                <li>
                                    <a href="{{ route('add') }}" target="_blank">
                                        <i class="fa fa-user"></i> 
                                        Add
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('home') }}" target="_blank">
                                        <i class="fa fa-list"></i> 
                                        List
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

    		<!-- top navigation -->
    		<div class="top_nav">
    			
                <div class="nav_menu">
    				
                    <nav>
    					<div class="nav toggle">
    						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
    					</div>

    					<ul class="nav navbar-nav navbar-right">
        					<li class="">
        						<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        							<img src="{{ asset('images/user.png') }}"" alt="">
        							{{ Auth::user()->name }}
        							<span class=" fa fa-angle-down"></span>
        						</a>
        						<ul class="dropdown-menu dropdown-usermenu pull-right">
        							<li>
        								<a href="{{ route('logout') }}"
                                           	onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out pull-right"></i> 
                                        	{{ __('Logout') }}
                                        </a>
        								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
        							</li>
        						</ul>
        					</li>
    					</ul>
    				</nav>

    			</div>

    		</div>
    		<!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    {{ config('app.name', 'Heozeo') }} - Test Project By by <a href="{{ url('/') }}">Sachin</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>

    </div>

    <!-- jQuery -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('extra-js')

</body>
</html>
