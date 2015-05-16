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
    {{ HTML::style('assets/css/zabuto_calendar.css') }}
    {{ HTML::style('assets/js/gritter/css/jquery.gritter.css') }}
    {{ HTML::style('assets/lineicons/style.css') }}
    
    <!-- Custom styles for this template -->
    {{ HTML::style('assets/css/style.css') }}
    {{ HTML::style('assets/css/style-responsive.css') }}
    
    
     {{ HTML::script('assets/js/chart-master/Chart.js') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      {{ HTML::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
      {{ HTML::script('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="/" class="logo"><b>The Iron Bank of the Philippines</b></a>
            <!--logo end-->
         
            <div class="top-menu">
           
                <ul class="nav pull-right top-menu">


                  

                  @if(Auth::check())
                  <li><a class="logout" href="/logout">Logout</a></li>
                  @else
                  <li><a class="logout" href="/login">Login</a></li>
                  @endif

                  
                  
                </ul>
            </div>
           
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="/">{{HTML::image('assets/img/ui-sam.jpg', 'logo', array('class'=>'img-circle', 'width'=>'60'))}}</a></p>

                  @if(Auth::check())
                  <h5 class="centered">{{Auth::user()->lastname.", ".Auth::user()->firstname}}</h5>
                  <br>
                  <br>
                  @endif
                  

                  <li class="sub-menu">
                      <a href="/" @if(Session::get('home')==1) {{Session::forget('home')}} class= "active" @endif >
                          <i class="fa fa-desktop"></i>
                          <span>Home</span>
                      </a>
                   
                  </li>
                  @if(Auth::check())
                  <li class="sub-menu">
                      <a href="/edit/account" @if(Session::get('account')==1) {{Session::forget('account')}} class= "active" @endif >
                          <i class="fa fa-cogs"></i>
                          <span>Account Settings</span>
                      </a>
                     
                  </li>
                 
                 @if(Auth::user()->user_type==2)
                  <li class="sub-menu">
                      <a href="javascript:;"  @if(Session::get('management')==1) {{Session::forget('management')}} class= "active" @endif >
                          <i class="fa fa-tasks"></i>
                          <span>Bank Management</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="/admin/staffs">Staffs</a></li>
                          <li><a  href="/admin/positions">Positions</a></li>
                          <li><a  href="/admin/branches">Branches</a></li>
                          <li><a  href="/admin/accounts">Accounts</a></li>
                          <li><a  href="/admin/transactions">Transactions</a></li>
                          <li><a  href="/admin/atms">ATMs</a></li>
              
                      </ul>
                  </li>
                 
                  @endif
                @if(Auth::user()->user_type==0)
                  <li class="sub-menu">
                      <a href="/track"  @if(Session::get('management')==1) {{Session::forget('management')}} class= "active" @endif >
                          <i class="fa fa-tasks"></i>
                          <span>Track Activities</span>
                      </a>
                     
                  </li>
                 
                  @endif
                  @if(Auth::user()->user_type==1)

                  <?php
                  $position = Position::find(Auth::user()->position_id);
                  ?>


                  @if($position->reg==1)
                   <li class="sub-menu">
                      <a href="/staff/registrations" @if(Session::get('transactions')==1) {{Session::forget('transactions')}} class= "active" @endif >
                          <i class="fa fa-th"></i>
                          <span>Registrations</span>
                      </a>
                  </li>
                  @endif
                  @if($position->manage_staff==1||$position->manage_acc_sav==1||$position->manage_acc_tim==1)
                  <li class="sub-menu">
                      <a href="javascript:;"  @if(Session::get('management')==1) {{Session::forget('management')}} class= "active" @endif >
                          <i class="fa fa-tasks"></i>
                          <span>Management</span>
                      </a>
                      <ul class="sub">
                          @if($position->manage_staff==1)
                          <li><a  href="/staff/staffs">Staffs</a></li>
                          @endif
                          @if($position->manage_acc_sav==1)
                          <li><a  href="/staff/savings">Savings Accounts</a></li>
                          @endif
                          @if($position->manage_acc_tim==1)
                          <li><a  href="/staff/timdep">Time Deposit Accounts</a></li>
                          @endif
                      </ul>
                  </li>
                  @endif
                   @if($position->audit_trail==1)
                  <li class="sub-menu">
                      <a href="/staff/audit" @if(Session::get('transactions')==1) {{Session::forget('transactions')}} class= "active" @endif >
                          <i class="fa fa-th"></i>
                          <span>Audit Trail</span>
                      </a>
                  </li>
                  @endif
                  @if($position->transact_deposit==1||$position->transact_withdraw==1||$position->transact_transfer==1)
                  <li class="sub-menu">
                      <a href="javascript:;"  @if(Session::get('management')==1) {{Session::forget('management')}} class= "active" @endif >
                          <i class="fa fa-tasks"></i>
                          <span>Transactions</span>
                      </a>
                      <ul class="sub">
                        @if($position->transact_deposit==1)
                          <li><a  href="/staff/deposit">Deposit</a></li>
                          @endif

                        @if($position->transact_withdraw==1)
                          <li><a  href="/staff/withdraw">Withdraw</a></li>
                          @endif
                        @if($position->transact_transfer==1)
                          <li><a  href="/staff/transfer">Transfer</a></li>  
                          @endif        
              
                      </ul>
                  </li>
                  @endif
                 
                  @endif
                  @endif
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
    
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

            <h3><i class="fa fa-angle-right"></i> @yield('title')</h3>
  
              
                @yield('main')

                @yield('dialogs')
            </section>
        </section>
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2015 - Project Deviance 
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
              @yield('footer')
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    {{ HTML::script('assets/js/jquery.js') }}
    {{ HTML::script('assets/js/jquery-1.8.3.min.js') }}
    {{ HTML::script('assets/js/bootstrap.min.js') }}
    {{ HTML::script('assets/js/jquery.dcjqaccordion.2.7.js') }}
    {{ HTML::script('assets/js/jquery.scrollTo.min.js') }}
    {{ HTML::script('assets/js/jquery.nicescroll.js') }}
    {{ HTML::script('assets/js/jquery.sparkline.js') }}

    <!--common script for all pages-->
    {{ HTML::script('assets/js/common-scripts.js') }}
    {{ HTML::script('assets/js/gritter/js/jquery.gritter.js') }}
    {{ HTML::script('assets/js/gritter-conf.js') }}
    
    <!--script for this page-->
    {{ HTML::script('assets/js/sparkline-chart.js') }}
    {{ HTML::script('assets/js/zabuto_calendar.js') }}
    
    
    
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
  

  </body>
</html>
