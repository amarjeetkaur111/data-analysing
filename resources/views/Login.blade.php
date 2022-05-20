<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Data Entry</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }} " rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="{{ asset('assets/css/mdb.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/loginstyle.css') }}" rel="stylesheet">
  <!-- Your custom styles (optional) -->
</head>

<body class="login-page">

  <!-- Main Navigation -->
  <header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
      <div class="container">
	    <img src="{{asset('assets/img/Rx360Logo.png')}}">
          <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active mb-n3">
              <label>&nbsp;Data Entry </label>
            </li>
          </ul>          
        </div>
      </div>
    </nav>
    <!-- Navbar -->

    <!-- Intro Section -->
    <section class="view intro-2">
      <div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-5">

              <!-- Form with header -->
              <div class="card wow fadeIn" data-wow-delay="0.3s">
                <div class="card-body">

                  <!-- Header -->
                  <div class="form-header blue-gradient">
                    <h3 class="font-weight-500 my-2 py-1"><i class="fas fa-user"></i> Data Entry Login</h3>
                  </div>
                  <!-- Body -->
                  <form method="post" action="{{route('AdminLogin')}}">
                  @csrf
                  <div class="md-form">
                    <i class="fas fa-user prefix grey-text"></i>
                    <input type="text" id="orangeForm-email" name="email" class="form-control" required="required" placeholder="Username or Email">
                  </div>

                  <div class="md-form" style="margin-bottom:50px;">
                    <i class="fas fa-lock prefix grey-text"></i>
                    <input type="password" id="orangeForm-pass" name="password" class="form-control" required="required" placeholder="Password">
                  </div>
                  <div class="text-center">
                    @if(Session::has('login_data'))
                      <div class="alert alert-warning">{{Session::get('login_data')}}</div>
                    @endif
				  </div>
                  <div class="text-center">
                    <button type="submit" class="btn  blue-gradient btn-lg">Login</button>
                    
                    <div class="inline-ul text-center d-flex justify-content-center">

                    </div>
                  </div>
					  
			     </form>
                </div>
              </div>
              <!-- Form with header -->

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Intro Section -->

  </header>
  <!-- Main Navigation -->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ asset('assets/js/mdb.js') }}"></script>

  <!-- Custom scripts -->
  <script>

    new WOW().init();

  </script>

</body>

</html>
