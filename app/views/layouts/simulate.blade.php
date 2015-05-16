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

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
             
            <!--logo start-->
            <a href="/" class="logo"><b>The Iron Bank of the Philippines - ATM Simulation</b></a>
            <!--logo end-->
         
            <div class="top-menu">
           
                <ul class="nav pull-right top-menu">


                  

                 
                  <li><a class="logout"  data-toggle="modal" data-target="{{ '#info' }}"  data-toggle="tooltip" data-placement="top"  title="API Info">API Info</a></li>
               

                  
                  
                </ul>
            </div>
           
        </header>
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="/">{{HTML::image('assets/img/ui-sam.jpg', 'logo', array('class'=>'img-circle', 'width'=>'60'))}}</a></p>

                 

                  
                
                  <li class="sub-menu">
                      <a href="/simulation" @if(Session::get('home')==1) {{Session::forget('home')}} class= "active" @endif >     
                          Getting Started
                      </a>
                   
                  </li>
                  <li class="sub-menu">
                      <a href="/simulation/atmupdate" @if(Session::get('home')==1) {{Session::forget('home')}} class= "active" @endif >
                          API Update
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="/simulation/authentication" @if(Session::get('home')==1) {{Session::forget('home')}} class= "active" @endif >
                        
                          Authentication
                      </a>
                   
                  </li>
                   <li class="sub-menu">
                      <a href="/simulation/changepin" @if(Session::get('home')==1) {{Session::forget('home')}} class= "active" @endif >
                          
                          Change Pin
                      </a>
                   
                  </li>
                   <li class="sub-menu">
                      <a href="/simulation/balance" @if(Session::get('home')==1) {{Session::forget('home')}} class= "active" @endif >
                 
                          Balance Inquiry
                      </a>
                   
                  </li>
                  <li class="sub-menu">
                      <a href="/simulation/withdraw" @if(Session::get('home')==1) {{Session::forget('home')}} class= "active" @endif >
                          
                          Withdraw
                      </a>
                   
                  </li>
                 
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
         <section id="main-content">
            <section class="wrapper">

            <h3><i class="fa fa-angle-right"></i> @yield('title')</h3>
  
	 @yield('main')

   @yield('dialogs')


     <div id="login-page">

      <div class="container">
      
       
         {{ Form::open(array('class' => 'form-login', 'role' => 'form')) }}
            <h2 class="form-login-heading">Output of Recent API Request</h2>
            <div class="login-wrap">
              @if(Session::get('apiresult'))
              {{Session::get('apiresult')}}
              @endif
            </div>
            {{Form::close()}}
      </div>
    </div>
  </section>
  </section>
    <!-- js placed at the end of the document so the pages load faster -->
  
           {{ HTML::script('assets/js/jquery.js') }}
           {{ HTML::script('assets/js/bootstrap.min.js') }}

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->

           {{ HTML::script('assets/js/jquery.backstretch.min.js') }}

    <script>
        $.backstretch("/assets/img/credit.jpg", {speed: 500});
    </script>

    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  
  </section>
  </body>
</html>
