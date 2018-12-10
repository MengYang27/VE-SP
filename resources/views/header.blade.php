@if($adminuser == 'student')
<style>
.nav-tabs-custom > .nav-tabs > li.active {
    border-top-color: #f39c12;
}

.skin-green .sidebar-menu > li.active > a {
    border-left-color: #FFD700;
}

.skin-green .sidebar-menu > li > a:hover {
    border-left-color: #FFD700;
}

.skin-green .main-header .navbar {
    background-color: #FFD700;
}

.skin-green .main-header .logo {
    background-color: #FFD700;
}

.skin-green .main-header .logo:hover {
    background-color: #FFD700;
}

.skin-green .main-header .navbar .sidebar-toggle:hover {
    background-color: #FFD700;
}

.skin-green .main-header li.user-header {
    background-color: #FFD700;
}

.box.box-solid.box-success > .box-header {
    color: #fff;
    background: #FFD700;
    background-color: rgb(255, 215, 0);
    background-color: #FFD700;
}

</style>
@endif 
  
  <header class="main-header">

    <!-- Logo -->

    <a href="javascript:void(0);" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->

      <span class="logo-mini"><strong>Velocity</strong></span>

      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg"><strong>Velocity</strong>Admin</span>

    </a>

    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top">

      <!-- Sidebar toggle button-->

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

        <span class="sr-only">Toggle navigation</span>

      </a>



      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">

          <!-- Messages: style can be found in dropdown.less-->
          <?php /* ?>
		 	
          <li class="dropdown messages-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <i class="fa fa-flag"></i>

              <span class="label label-success">4</span>

            </a>

            <ul class="dropdown-menu">

              <li class="header">You have 4 messages</li>

              <li>

                <!-- inner menu: contains the actual data -->

                <ul class="menu">

                  <li><!-- start message -->

                    <a href="#">

                      <h4>

                        Support Team

                        <small><i class="fa fa-clock-o"></i> 5 mins</small>

                      </h4>

                      <p>Why not buy a new awesome theme?</p>

                    </a>

                  </li>

                  <!-- end message -->

                  <li>

                    <a href="#">

                      <h4>

                        Admin Guava Team

                        <small><i class="fa fa-clock-o"></i> 2 hours</small>

                      </h4>

                      <p>Why not buy a new awesome theme?</p>

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <h4>

                        Developers

                        <small><i class="fa fa-clock-o"></i> Today</small>

                      </h4>

                      <p>Why not buy a new awesome theme?</p>

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <h4>

                        Sales Department

                        <small><i class="fa fa-clock-o"></i> Yesterday</small>

                      </h4>

                      <p>Why not buy a new awesome theme?</p>

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <h4>

                        Reviewers

                        <small><i class="fa fa-clock-o"></i> 2 days</small>

                      </h4>

                      <p>Why not buy a new awesome theme?</p>

                    </a>

                  </li>

                </ul>

              </li>

              <li class="footer"><a href="#">See All Reports</a></li>

            </ul>

          </li>

		 <?php */ ?> 
		  	
          <!-- Notifications: style can be found in dropdown.less -->
           <?php /* ?>

          <li class="dropdown notifications-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <i class="fa fa-bell-o"></i>

              <span class="label label-warning">10</span>

            </a>

            <ul class="dropdown-menu">

              <li class="header">You have 10 notifications</li>

              <li>

                <!-- inner menu: contains the actual data -->

                <ul class="menu">

                  <li>

                    <a href="#">

                      <i class="fa fa-briefcase text-aqua"></i> 5 new jobs posted

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the

                      page and may cause design problems

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <i class="fa fa-users text-red"></i> 5 new members joined

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <i class="fa fa-shopping-cart text-green"></i> 25 transaction

                    </a>

                  </li>

                  <li>

                    <a href="#">

                      <i class="fa fa-user text-red"></i> You changed your username

                    </a>

                  </li>

                </ul>

              </li>

              <li class="footer"><a href="#">View all</a></li>

            </ul>

          </li>

          
          
          <li class="user user-menu"><a href="{{ url('/usermgtadd') }}">Add User</a></li>
          
          <li class="user user-menu"><a href="{{ url('/rolemgt') }}">Role List</a></li>
          <?php */ ?> 
          
          <!-- User Account: style can be found in dropdown.less -->

          <li class="dropdown user user-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <span class="hidden-xs">{{ Session::get('username')}}</span>

            </a>

            <ul class="dropdown-menu">

              <!-- User image -->

              <li class="user-header">

                <img src="{{URL::asset('/bower_components/adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="Administrator">

                <p>{{ Session::get('username')}}</p>

              </li>

              <!-- Menu Body -->

              <li class="user-body">

				<!--
                <div class="row">

                  <div class="col-xs-5 text-center">

                    <a href="#">Posted Jobs</a>

                  </div>

                  <div class="col-xs-3 text-center">

                    <a href="#">Users</a>

                  </div>

                  <div class="col-xs-4 text-center">

                    <a href="#">Settings</a>

                  </div>

                </div>
				-->

                <!-- /.row -->

              </li>

              <!-- Menu Footer-->

              <li class="user-footer">

                <div class="pull-left">

                  <a href="#" class="btn btn-default">Profile</a>

                </div>

                <div class="pull-right">
					
					<a href="{{ route('logout') }}"

                    class="btn btn-default"

					onclick="event.preventDefault();

					document.getElementById('logout-form').submit();">

					Logout

					</a>



					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
						
						@if($adminuser == 'student')
							<input type="hidden" name="student_logout_mode" value="1">
						@else
							<input type="hidden" name="student_logout_mode" value="0">
						@endif
					</form>
					
						
					
					

                </div>

              </li>

            </ul>

          </li>

        </ul>

      </div>

    </nav>

  </header>