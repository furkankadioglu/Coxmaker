<html ng-app="Coxmaker">
<head>
<title>Coxmaker @yield('title')</title>

<!-- Begin: Styles -->

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Coxmaker is a simple tool designed to help shareholders determine their percentage distribution and ratio in an even manner.">
<meta name="author" content="Rys">
<link rel="icon" href="favicon.ico">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
<script src="<?php echo url('/assets/modules/coxtable/app.js'); ?>"></script>
<script src="<?php echo url('/assets/modules/coxtable/angularbootstrap.js'); ?>"></script>


<link rel="stylesheet" href="https://bootswatch.com/cerulean/bootstrap.min.css" />
@yield('styles')
<!--  End: Styles -->
</head>
<body>
<div class="container">
<br>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Coxmaker</a>
            
              <ul class="nav navbar-nav">
              <li><a href="<?php echo url('/'); ?>">Create</a></li>
              <li><a href="https://github.com/furkankadioglu/Coxmaker" target="_blank">Github</a></li>
              <li><a href="<?php echo url('CoxTable/642dc1cf3cc6717f44afc13a86196a75704205') ?>">Example CoxTable</a></li>
              </ul>
          </div>
        </div><!--/.container-fluid -->
      </nav>
</div>


@section('breadcrumb', 'Blade')

<div class="container">
	<!-- Begin: Content -->
	@yield('content')
	<!--  End: Content -->
</div>


<footer>
	<div class="container text-center">
	<hr>
		<small><i><strong>Coxmaker</strong> - 2016</i></small>
	</div>
</footer>

<!-- Begin: Scripts -->
<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
@yield('scripts')
<!--  End: Scripts -->
</body>
</html>


