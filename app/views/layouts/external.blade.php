<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>The Iron Bank of the Philippines</title>

    <!-- Bootstrap core CSS -->

     {{ HTML::style('assets/css/bootstrap.css') }}
    <!--external css-->

     {{ HTML::style('assets/font-awesome/css/font-awesome.css') }}
        
    <!-- Custom styles for this template -->
  
     {{ HTML::style('assets/css/style.css') }}
   
     {{ HTML::style('assets/css/style-responsive.css') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    
       {{ HTML::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
       {{ HTML::script('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
     
    <![endif]-->
  </head>

  <body >
    

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	 @yield('main')

    <!-- js placed at the end of the document so the pages load faster -->
  
           {{ HTML::script('assets/js/jquery.js') }}
           {{ HTML::script('assets/js/bootstrap.min.js') }}

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->

           {{ HTML::script('assets/js/jquery.backstretch.min.js') }}

    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
