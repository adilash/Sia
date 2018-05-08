<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sia</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!--
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>-->
         <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>

        <!-- Styles -->
    </head>
    <body>
        
         <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">SIA-NITC QUESTION BANK</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="{{route('queue')}}">Question Queue</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Database
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{route('MngDep')}}">Manage Department</a></li>
          <li><a href="{{route('MngCrs')}}">Manage Course</a></li>
          <li><a href="{{route('MngProg')}}">Manage Program</a></li>
        </ul>
      </li>
      <li><a href="{{route('MngQB')}}">Manage Question Bank</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown" href="#">{{Auth::guard('web_admins')->user()->Name}}
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="{{route('changepass')}}"><span class=""></span> Change Password</a></li>
        <li><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>     
        @yield('content')

        @yield('scripts')
    </body>
</html>