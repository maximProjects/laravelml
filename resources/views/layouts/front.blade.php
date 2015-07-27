<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Demo Multilanguage</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

</head>

<body>

<div class="container">

    <!-- Static navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Multilang</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home Site</a></li>
                    @include('widgets.langSel')
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?= $curLang->prefix ?>/admin">Admin panel</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        @yield('content')
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>
