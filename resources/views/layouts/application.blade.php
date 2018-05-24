<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@section('bartitle') @endsection</title>

    {{-- Bootstrap --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link href="{{asset('css/bagus-style.css')}}" rel="stylesheet" crossorigin="anonymous">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js" integrity="sha384-u/bQvRA/1bobcXlcEYpsEdFVK/vJs3+T+nXLsBYJthmdBuavHvAW6UsmqO2Gd/F9" crossorigin="anonymous"></script>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  </head>
  <body>
    {{-- Header --}}
    <header class="header blst-header">
      <div class="container blst">
        <div class="row">
          <div class="col-xs-4 col-sm-4 col-md-4 col-sm-4">
            <div class="web-label">
              <span>
                <b>career</b>
              </span>
            </div>
          </div>
          <div class="col-xs-4 col-sm-4 col-sm-4 text-center">
            <a href="/">
              <img src="{{asset('images/logo-company-white.png')}}" class="header___logo" alt="">
            </a>
          </div>
          {{-- <div class="col-xs-4 col-sm-4 col-md-4 col-sm-4 text-right"> --}}
            <div class="right-header">
              <div class="mobile-trigger">
                <a href="#" class="header_trigger">
                  <span id="mobile-nav" class="fa fa-bars"></span>
                </a>
              </div>

              <script type="text/javascript">
                $(document).ready(function() {
                  $('#mobile-nav').on('click', function() {
                    $('#mobile-navigation').toggle();                    
                  });


                  function openNav() {
                    $('#mobile-navigation').css('height','95%');
                  }

                  function closeNav() {
                    $('#mobile-navigation').css('height','0%');
                  }
                });
              </script>

              <div class="regular-header">
                <a href="#" class="btn btn-warning">
                  <span class="fa fa-briefcase"></span>
                  Available Jobs
                </a>
                <a href="#" class="btn btn-warning">
                  Login or Register
                </a>
              </div>
            </div>
          {{-- </div> --}}
        </div>
      </div>

      {{-- Menu Full Screen  --}}
      <div class="fullscreen-menu" id="mobile-navigation">
        {{-- <div class="close-menu">
          <span class="fa fa-times"></span>
        </div> --}}
        <div class="row">
            <div class="menumobile-content">
              <div class="col-xs-6">
              <a href="#" class="btn btn-warning btn-lg btn-block">
                <span class="fa fa-briefcase"></span>
                Available Jobs
              </a>
              <a href="#" class="btn btn-warning btn-lg  btn-block">
                Login or Register
              </a><br><br>
              <p>PT BLST © 2018</p>
              </div>
            </div>
        </div>
      </div>

    </header>


  </body>
</html>
