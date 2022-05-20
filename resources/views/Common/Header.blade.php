<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Dataentry</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}">
  <!-- DataTables.net  -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/addons/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/addons/datatables-select.min.css') }}">  
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">  
  <!-- Your custom styles (optional) -->
  <!--------------Jquery------------------>
  <script src="{{asset('assets/js/jquery-3.4.1.min.js')}}"></script>

</head>

<body class="fixed-sn white-skin">

  <!-- Main Navigation -->
  <header>

    <!-- Sidebar navigation -->

    <!-- Sidebar navigation -->
	
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">
		<ul class="nav main-nav md-pills nav-justified pills-deep-blue pl-5">
			<li class="nav-item mb-n3">
				<a href="{{route('dashboard')}}" class="nav-link nav-bar img mb-n3"><img src="{{asset('assets/img/Rx360Logo.png')}}"></a>
				<label class="small">Data Entry</label>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Administration</span>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item {{ Request::routeIs('users') ? 'active' : '' }}" href="{{route('users')}}">Users & Phamacies</a>

					<a class="dropdown-item {{ Request::routeIs('categories') ? 'active' : '' }}" href="{{route('categories')}}">Categories</a>

					<a class="dropdown-item {{ Request::routeIs('FieldsList') ? 'active' : '' }}" href="{{route('FieldsList')}}">Fields</a>
					<a class="dropdown-item {{ Request::routeIs('DataentryForm') ? 'active' : '' }} {{ Request::routeIs('DataEntryFormView') ? 'active' : '' }}" href="{{route('DataentryForm')}}">DataEntry</a>
				</div>					
			</li>
			<li class="nav-item" style="width:12rem;">
				<a class="nav-link nav-bar {{ Request::routeIs('DataEntryReports') ? 'active' : '' }} {{ Request::routeIs('DataEntryReport') ? 'active' : '' }}" href="{{route('DataEntryReports')}}"><i class="fas fa-file-contract fa-lg" role="button" data-prefix="fas" data-id="box" data-unicode="f466" data-mdb-original-title="" title=""></i> Reports</a>
			</li>			
        </ul>
      <!-- Breadcrumb -->
      <div class="breadcrumb-dn mr-auto">
        <p></p>
      </div>
	 
      <div class="d-flex change-mode">

        <!-- Navbar links -->
        <ul class="nav navbar-nav nav-flex-icons ml-auto">

          <!-- Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Profile</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
            </div>
          </li>

        </ul>
        <!-- Navbar links -->

      </div>

    </nav>
    <!-- Navbar -->

    <!-- Fixed button -->
    <div class="fixed-action-btn clearfix d-none d-xl-block" style="bottom: 45px; right: 24px;">

    <!-- Fixed button -->
    <div class="alert-messages">
      @if(session()->has('msg'))
      <div class="alert alert-info alert-dismissible fade show" role="alert" >
        {{session('msg')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if(session()->has('errormsg'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('errormsg')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if(session()->has('successmsg'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('successmsg')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    </div>
  </header>