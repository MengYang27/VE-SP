@if (Session::has('username'))

@if(Request::is('cmsmgt'))
@php
$mainclass = 'cmsmanagement';
$subclass = 'cmsmgt';
@endphp

@elseif(Request::is('home'))
@php
$mainclass = 'dashboard';
$subclass = 'home';
@endphp

@elseif(Request::is('countrymgt'))
@php
$mainclass = 'locationmanagement';
$subclass = 'countrymgt';
@endphp
@elseif(Request::is('countryadd'))
@php
$mainclass = 'locationmanagement';
$subclass = 'countryadd';
@endphp

@elseif(Request::is('countryadd'))
@php
$mainclass = 'locationmanagement';
$subclass = 'countryadd';
@endphp


@elseif(Request::is('studentboard'))
@php
$mainclass = 'studentboard';
$subclass = 'studentboard';
@endphp

@elseif(Request::is('studentprofile'))
@php
$mainclass = 'studentprofile';
$subclass = 'studentprofile';
@endphp

@elseif(Request::is('studentcourse'))
@php
$mainclass = 'studentcourse';
$subclass = 'studentcourse';
@endphp

@elseif(Request::is('studentorders'))
@php
$mainclass = 'studentorders';
$subclass = 'studentorders';
@endphp

@elseif(Request::is('material'))
@php
$mainclass = 'material';
$subclass = 'material';
@endphp


@elseif(Request::is('classmgt'))
@php
$mainclass = 'classmanagement';
$subclass = 'classlist';
@endphp
@elseif(Request::is('classadd'))
@php
$mainclass = 'classmanagement';
$subclass = 'classadd';
@endphp

@elseif(Request::is('packagemgt'))
@php
$mainclass = 'packagemanagement';
$subclass = 'packagelist';
@endphp
@elseif(Request::is('packagemgtadd'))
@php
$mainclass = 'packagemanagement';
$subclass = 'packageadd';
@endphp

@elseif(Request::is('ordermgt'))
@php
$mainclass = 'ordermanagement';
$subclass = 'orderlist';
@endphp
@elseif(Request::is('ordermgtadd'))
@php
$mainclass = 'ordermanagement';
$subclass = 'orderadd';
@endphp

@elseif(Request::is('notificationmgt'))
@php
$mainclass = 'emailmanagement';
$subclass = 'templatelist';
@endphp
@elseif(Request::is('notificationadd'))
@php
$mainclass = 'packagemanagement';
$subclass = 'templateadd';
@endphp

@elseif(Request::is('citymgt'))
@php
$mainclass = 'locationmanagement';
$subclass = 'citymgt';
@endphp
@elseif(Request::is('cityadd'))
@php
$mainclass = 'locationmanagement';
$subclass = 'cityadd';
@endphp

@elseif(Request::is('categorymgt'))
@php
$mainclass = 'materialmanagement';
$subclass = 'categorymgt';
@endphp
@elseif(Request::is('categoryadd'))
@php
$mainclass = 'materialmanagement';
$subclass = 'categoryadd';
@endphp

@elseif(Request::is('coursemgt'))
@php
$mainclass = 'materialmanagement';
$subclass = 'citymgt';
@endphp
@elseif(Request::is('courseadd'))
@php
$mainclass = 'materialmanagement';
$subclass = 'cityadd';
@endphp

@elseif(Request::is('materialmgt'))
@php
$mainclass = 'materialmanagement';
$subclass = 'materialmgt';
@endphp
@elseif(Request::is('materialadd'))
@php
$mainclass = 'materialmanagement';
$subclass = 'materialadd';
@endphp


@elseif(Request::is('settings'))
@php
$mainclass = 'settings';
$subclass = 'settings';
@endphp

@elseif(Request::is('paymentmgt'))
@php
$mainclass = 'paymentmanagement';
$subclass = 'paymentmgt';
@endphp

@elseif(Request::is('usermgt'))
@php
$mainclass = 'usermanagement';
$subclass = 'usermgt';
@endphp
@elseif(Request::is('usermgtadd'))
@php
$mainclass = 'usermanagement';
$subclass = 'usermgtadd';
@endphp

@elseif(Request::is('rolemgt'))
@php
$mainclass = 'usermanagement';
$subclass = 'rolemgt';
@endphp
@elseif(Request::is('rolemgtadd'))
@php
$mainclass = 'usermanagement';
$subclass = 'rolemgtadd';
@endphp

@elseif(Request::is('departmentmgt'))
@php
$mainclass = 'usermanagement';
$subclass = 'departmentmgt';
@endphp
@elseif(Request::is('departmentadd'))
@php
$mainclass = 'usermanagement';
$subclass = 'departmentadd';
@endphp

@elseif(Request::is('surveytypelist'))
@php
$mainclass = 'surveymanagement';
$subclass = 'surveytypelist';
@endphp
@elseif(Request::is('surveytypeadd'))
@php
$mainclass = 'surveymanagement';
$subclass = 'surveytypeadd';
@endphp
@elseif(Request::is('surveyqstypelist'))
@php
$mainclass = 'surveymanagement';
$subclass = 'surveyqstypelist';
@endphp
@elseif(Request::is('surveyqstypeadd'))
@php
$mainclass = 'surveymanagement';
$subclass = 'surveyqstypeadd';
@endphp
@elseif(Request::is('surveyqslist'))
@php
$mainclass = 'surveymanagement';
$subclass = 'surveyqslist';
@endphp
@elseif(Request::is('surveyqsadd'))
@php
$mainclass = 'surveymanagement';
$subclass = 'surveyqsadd';
@endphp
@elseif(Request::is('surveyanslist'))
@php
$mainclass = 'surveymanagement';
$subclass = 'surveyanslist';
@endphp
@elseif(Request::is('surveyansadd'))
@php
$mainclass = 'surveymanagement';
$subclass = 'surveyansadd';
@endphp

@elseif(Request::is('teammgt'))
@php
$mainclass = 'teammanagement';
$subclass = 'teammgt';
@endphp
@elseif(Request::is('teammgtadd'))
@php
$mainclass = 'teammanagement';
$subclass = 'teammgtadd';
@endphp


@elseif(Request::is('badgemgt'))
@php
$mainclass = 'badgemanagement';
$subclass = 'badgemgt';
@endphp
@elseif(Request::is('badgemgtadd'))
@php
$mainclass = 'badgemanagement';
$subclass = 'badgemgtadd';
@endphp

@elseif(Request::is('jobtypelist'))
@php
$mainclass = 'jobmanagement';
$subclass = 'jobtypelist';
@endphp
@elseif(Request::is('jobtypeadd'))
@php
$mainclass = 'jobmanagement';
$subclass = 'jobtypeadd';
@endphp
@elseif(Request::is('joblist'))
@php
$mainclass = 'jobmanagement';
$subclass = 'joblist';
@endphp
@elseif(Request::is('jobadd'))
@php
$mainclass = 'jobmanagement';
$subclass = 'jobadd';
@endphp

@elseif(Request::is('questionmgt/*'))
@php
$mainclass = 'questionmanagement';
$rid = isset($_GET['rid']) ? $_GET['rid'] : 0;
switch ($rid) {
case 1:
$subclass = 'speaking';
$thirdclass = 'ra';
break;
case 2:
$subclass = 'speaking';
$thirdclass = 'rs';
break;
default:
$subclass = 'speaking';
$thirdclass = 'ra';
}
@endphp

@else
@php
$mainclass = 'dashboard';
$subclass = 'home';
@endphp
@endif

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{URL::asset('/bower_components/adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle"
                    alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Session::get('username')}}</p>
                <a href="javascript:void(0)">Edit</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            @if($adminuser == 'student')
            <li <?php if($subclass=='studentboard' ) { ?> class="active"
                <?php } ?>>
                <a href="{{ url('/studentboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li <?php if($subclass=='studentorders' ) { ?> class="active"
                <?php } ?>>
                <a href="{{ url('/studentorders') }}">
                    <i class="fa fa-calendar"></i> <span>Orders</span>
                </a>
            </li>
            <li <?php if($subclass=='studentcourse' ) { ?> class="active"
                <?php } ?>>
                <a href="{{ url('/studentcourse') }}">
                    <i class="fa fa-mortar-board"></i> <span>Course</span>
                </a>
            </li>
            <li <?php if($subclass=='material' ) { ?> class="active"
                <?php } ?>>
                <a href="{{ url('/material') }}">
                    <i class="fa fa-mortar-board"></i> <span>Material</span>
                </a>
            </li>
            <li <?php if($subclass=='studentprofile' ) { ?> class="active"
                <?php } ?>>
                <a href="{{ url('/studentprofile') }}">
                    <i class="fa fa-child"></i> <span>Personal Profile</span>
                </a>
            </li>


            @else
            <li <?php if($subclass=='home' ) { ?> class="active"
                <?php } ?>>
                <a href="{{ url('/home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li <?php if($subclass=='settings' ) { ?> class="active"
                <?php } ?>>
                <a href="{{ url('/settings') }}">
                    <i class="fa fa-venus-mars"></i> <span>Settings</span>
                </a>
            </li>

            <!--
        <li <?php if($mainclass == 'locationmanagement') { ?> class="active treeview" <?php } else { ?> class="treeview" <?php } ?>>
          <a href="#">
            <i class="fa fa-venus-mars"></i>
            <span>Locations</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li <?php if($subclass == 'locationlist') { ?> class="active" <?php } ?>><a href="{{ url('/countrymgt') }}"><i class="fa fa-th-large"></i>All Countries</a></li>
            <li <?php if($subclass == 'locationadd') { ?> class="active" <?php } ?>><a href="{{ url('/countryadd') }}"><i class="fa fa-plus"></i></i>Add Country</a></li>
			
            <li <?php if($subclass == 'locationlist') { ?> class="active" <?php } ?>><a href="{{ url('/citymgt') }}"><i class="fa fa-th-large"></i>All Cities</a></li>
            <li <?php if($subclass == 'locationadd') { ?> class="active" <?php } ?>><a href="{{ url('/cityadd') }}"><i class="fa fa-plus"></i></i>Add City</a></li>			
			
          </ul>
        </li>
        -->


            <li <?php if($mainclass=='usermanagement' ) { ?> class="active treeview"
                <?php } else { ?> class="treeview"
                <?php } ?>>
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>User Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($subclass=='rolemgt' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/rolemgt') }}"><i class="fa fa-user"></i>List Role</a></li>
                    <li <?php if($subclass=='rolemgtadd' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/rolemgtadd') }}"><i class="fa fa-user-plus"></i>Add Role</a></li>

                    <!--	
            <li <?php if($subclass == 'departmentmgt') { ?> class="active" <?php } ?>><a href="{{ url('/departmentmgt') }}"><i class="fa fa-user"></i>List Department</a></li>
            <li <?php if($subclass == 'departmentadd') { ?> class="active" <?php } ?>><a href="{{ url('/departmentmgtadd') }}"><i class="fa fa-user-plus"></i>Add Department</a></li>				
		  	-->

                    <li <?php if($subclass=='usermgt' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/usermgt') }}"><i class="fa fa-user"></i>List Users</a></li>
                    <li <?php if($subclass=='usermgtadd' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/usermgtadd') }}"><i class="fa fa-user-plus"></i>Add User</a></li>
                </ul>
            </li>

            <li <?php if($mainclass=='packagemanagement' ) { ?> class="active treeview"
                <?php } else { ?> class="treeview"
                <?php } ?>>
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Package Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($subclass=='packagelist' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/packagemgt') }}"><i class="fa fa-user"></i>List Packages</a></li>
                    <li <?php if($subclass=='packageadd' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/packagemgtadd') }}"><i class="fa fa-user-plus"></i>Add Packages</a></li>
                </ul>
            </li>

            <li <?php if($mainclass=='materialmanagement' ) { ?> class="active treeview"
                <?php } else { ?> class="treeview"
                <?php } ?>>
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Materials</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <!--
            <li <?php if($subclass == 'categorymgt') { ?> class="active" <?php } ?>><a href="{{ url('/categorymgt') }}"><i class="fa fa-th-large"></i>All Categories</a></li>
            <li <?php if($subclass == 'categoryadd') { ?> class="active" <?php } ?>><a href="{{ url('/categoryadd') }}"><i class="fa fa-plus"></i></i>Add Category</a></li>            
          
            <li <?php if($subclass == 'coursemgt') { ?> class="active" <?php } ?>><a href="{{ url('/coursemgt') }}"><i class="fa fa-th-large"></i>All Courses</a></li>
            <li <?php if($subclass == 'courseadd') { ?> class="active" <?php } ?>><a href="{{ url('/courseadd') }}"><i class="fa fa-plus"></i></i>Add Course</a></li>
			-->

                    <li <?php if($subclass=='materiallist' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/materialmgt') }}"><i class="fa fa-th-large"></i>All Materials</a></li>
                    <li <?php if($subclass=='materialadd' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/materialadd') }}"><i class="fa fa-plus"></i>Add Material</a></li>

                </ul>
            </li>

            <li <?php if($mainclass=='classmanagement' ) { ?> class="active treeview"
                <?php } else { ?> class="treeview"
                <?php } ?>>
                <a href="#">
                    <i class="fa fa-fw fa-industry"></i>
                    <span>Class Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($subclass=='classlist' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/classmgt') }}"><i class="fa fa-th-large"></i>All Classes</a></li>
                    <li <?php if($subclass=='classadd' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/classadd') }}"><i class="fa fa-plus"></i>Add Class</a></li>
                </ul>
            </li>

            <li <?php if($mainclass=='ordermanagement' ) { ?> class="active treeview"
                <?php } else { ?> class="treeview"
                <?php } ?>>
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Order Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($subclass=='orderlist' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/ordermgt') }}"><i class="fa fa-th-large"></i>All Orders</a></li>
                    <li <?php if($subclass=='orderadd' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/ordermgtadd') }}"><i class="fa fa-plus"></i>Add Order</a></li>
                </ul>
            </li>


            <li <?php if($mainclass=='questionmanagement' ) { ?> class="active treeview"
                <?php } else { ?> class="treeview"
                <?php } ?>>
                <a href="#">
                    <i class="fa fa-adn"></i>
                    <span>Questinon Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    {{-- Speaking --}}
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Speaking
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu menu-open questions" style="display: block;">
                            <li><a href="{{ url('/questionmgt/speaking?rid=1') }}"><i class="fa fa-circle-o"></i> Read
                                    Aloud</a></li>
                            <li><a href="{{ url('/questionmgt/speaking?rid=2') }}"><i class="fa fa-circle-o"></i>
                                    Repeat Sentence</a></li>
                        </ul>
                    </li>
                </ul>

                {{-- Listening --}}
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Speaking
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu questions">
                            <li><a href="{{ url('/questionmgt/speaking') }}"><i class="fa fa-circle-o"></i> Read Aloud</a></li>
                            <li><a href="{{ url('/questionmgt/speaking') }}"><i class="fa fa-circle-o"></i> Repeat
                                    Sentence</a></li>
                        </ul>
                    </li>
                </ul>

                {{-- Reading --}}
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="{{ url('/questionmgt/speaking') }}"><i class="fa fa-circle-o"></i> Speaking
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu questions">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Read Aloud</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Repeat Sentence</a></li>
                        </ul>
                    </li>
                </ul>

                {{-- Writing --}}
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="{{ url('/questionmgt/speaking') }}"><i class="fa fa-circle-o"></i> Speaking
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu questions">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Read Aloud</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Repeat Sentence</a></li>
                        </ul>
                    </li>
                </ul>
            </li>


            <li <?php if($mainclass=='emailmanagement' ) { ?> class="active treeview"
                <?php } else { ?> class="treeview"
                <?php } ?>>
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Email Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($subclass=='templatelist' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/notificationmgt') }}"><i class="fa fa-th-large"></i>All Templates</a></li>
                    <li <?php if($subclass=='templateadd' ) { ?> class="active"
                        <?php } ?>><a href="{{ url('/notificationadd') }}"><i class="fa fa-plus"></i>Add Template</a></li>
                </ul>
            </li>
            @endif

            <!--	
        <li <?php if($mainclass == 'locationmanagement') { ?> class="active treeview" <?php } else { ?> class="treeview" <?php } ?>>
          <a href="#">
            <i class="fa fa-venus-mars"></i>
            <span>Locations</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li <?php if($subclass == 'locationlist') { ?> class="active" <?php } ?>><a href="{{ url('/locationlist') }}"><i class="fa fa-th-large"></i>All Locations</a></li>
            <li <?php if($subclass == 'locationadd') { ?> class="active" <?php } ?>><a href="{{ url('/locationadd') }}"><i class="fa fa-plus"></i></i>Add Location</a></li>
          </ul>
        </li> 		  
          
        <li <?php if($mainclass == 'locationmanagement') { ?> class="active treeview" <?php } else { ?> class="treeview" <?php } ?>>
          <a href="#">
            <i class="fa fa-venus-mars"></i>
            <span>Locations</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li <?php if($subclass == 'locationlist') { ?> class="active" <?php } ?>><a href="{{ url('/locationlist') }}"><i class="fa fa-th-large"></i>All Locations</a></li>
            <li <?php if($subclass == 'locationadd') { ?> class="active" <?php } ?>><a href="{{ url('/locationadd') }}"><i class="fa fa-plus"></i></i>Add Location</a></li>
          </ul>
        </li>           

          <li <?php if($mainclass == 'surveymanagement') { ?> class="active treeview" <?php } else { ?> class="treeview" <?php } ?>>
              <a href="#" class="header">
                  <i class="fa fa-files-o"></i>
                  <span>Survey</span>
                  <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li <?php if($subclass == 'surveytypelist') { ?> class="active" <?php } ?>><a href="{{ url('/surveytypelist') }}"><i class="fa fa-circle-o"></i>Survey Types</a></li>
                  <li <?php if($subclass == 'surveytypeadd') { ?> class="active" <?php } ?>><a href="{{ url('/surveytypeadd') }}"><i class="fa fa-plus"></i>Add/Edit Survey Type</a></li>
                  
                  <li <?php if($subclass == 'surveyqstypelist') { ?> class="active" <?php } ?>><a href="{{ url('/surveyqstypelist') }}"><i class="fa fa-circle-o"></i>Question Types</a></li>
                  <li <?php if($subclass == 'surveyqstypeadd') { ?> class="active" <?php } ?>><a href="{{ url('/surveyqstypeadd') }}"><i class="fa fa-plus"></i>Add/Edit Question Type</a></li>
                  
                  <li <?php if($subclass == 'surveyqslist') { ?> class="active" <?php } ?>><a href="{{ url('/surveyqslist') }}"><i class="fa fa-circle-o"></i>All Questions &amp; Answers</a></li>
                  <li <?php if($subclass == 'surveyqsadd') { ?> class="active" <?php } ?>><a href="{{ url('/surveyqsadd') }}"><i class="fa fa-plus"></i>Add/Edit Question</a></li>
                  
                  <?php /*?> <li <?php if($subclass == 'surveyanslist') { ?> class="active" <?php } ?>><a href="{{ url('/surveyanslist') }}"><i class="fa fa-circle-o"></i>Predefine Answers</a></li>
                  <li <?php if($subclass == 'surveyansadd') { ?> class="active" <?php } ?>><a href="{{ url('/surveyansadd') }}"><i class="fa fa-plus"></i>Add/Edit Predefine Answer</a></li> <?php */?>
              </ul>
          </li>
          
        <li <?php if($mainclass == 'teammanagement') { ?> class="active treeview" <?php } else { ?> class="treeview" <?php } ?>>
          <a href="#">
            <i class="fa fa-venus-mars"></i>
            <span>Teams</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li <?php if($subclass == 'teammgt') { ?> class="active" <?php } ?>><a href="{{ url('/teammgt') }}"><i class="fa fa-th-large"></i>All Teams</a></li>
            <li <?php if($subclass == 'teammgtadd') { ?> class="active" <?php } ?>><a href="{{ url('/teammgtadd') }}"><i class="fa fa-plus"></i></i>Add New</a></li>
          </ul>
        </li>           


        <li <?php if($mainclass == 'usermanagement') { ?> class="active treeview" <?php } else { ?> class="treeview" <?php } ?>>
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Users</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li <?php if($subclass == 'usermgt') { ?> class="active" <?php } ?>><a href="{{ url('/usermgt') }}"><i class="fa fa-user"></i>All Users</a></li>
            <li <?php if($subclass == 'usermgtadd') { ?> class="active" <?php } ?>><a href="{{ url('/usermgtadd') }}"><i class="fa fa-user-plus"></i>Add User</a></li>
          </ul>
        </li>        
        
        <li <?php if($mainclass == 'jobmanagement') { ?> class="active treeview" <?php } else { ?> class="treeview" <?php } ?>>
          <a href="#">
            <i class="fa fa-fw fa-industry"></i>
            <span>Jobs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li <?php if($subclass == 'jobtypeadd') { ?> class="active" <?php } ?>><a href="{{ url('/jobtypeadd') }}"><i class="fa fa-plus"></i> Add Category</a></li>
            <li <?php if($subclass == 'jobtypelist') { ?> class="active" <?php } ?>><a href="{{ url('/jobtypelist') }}"><i class="fa fa-plus"></i> List Category</a></li>
            <li <?php if($subclass == 'jobadd') { ?> class="active" <?php } ?>><a href="{{ url('/joblist') }}"><i class="fa fa-briefcase"></i> All Jobs</a></li>
            <li <?php if($subclass == 'joblist') { ?> class="active" <?php } ?>><a href="{{ url('/jobadd') }}"><i class="fa fa-plus"></i> Add Job</a></li>
            
          </ul>
        </li>
        
        <li <?php if($mainclass == 'badgemanagement') { ?> class="active treeview" <?php } else { ?> class="treeview" <?php } ?>>
          <a href="#">
            <i class="fa fa-certificate"></i>
            <span>Badges</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($subclass == 'badgemgt') { ?> class="active" <?php } ?>><a href="{{ url('/badgemgt') }}"><i class="fa fa-bookmark-o"></i> All Badges</a></li>
            <li <?php if($subclass == 'badgemgtadd') { ?> class="active" <?php } ?>><a href="{{ url('/badgemgtadd') }}"><i class="fa fa-plus"></i> Add New</a></li>
          </ul>
        </li>    
        
        <li <?php if($mainclass == 'paymentmanagement' || $mainclass == 'cmsmanagement') { ?> class="active treeview" <?php } else { ?> class="treeview" <?php } ?>>
            <a href="#">
                <i class="fa fa-sliders"></i>
                <span>Basic Configuration</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="javascript:void(0);"><i class="fa fa-cog"></i> Admin Settings</a></li>
                <li <?php if($subclass == 'paymentmgt') { ?> class="active" <?php } ?>><a href="{{ url('/paymentmgt') }}"><i class="fa fa-paypal"></i> Payment Gateway</a></li>
                <li <?php if($subclass == 'cmsmgt') { ?> class="active" <?php } ?>><a href="{{ url('/cmsmgt') }}"><i class="fa fa-file"></i> CMS</a></li>
            </ul>
        </li>
		
		
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
		-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
@else

@if($adminuser == 'student')
<script type="text/javascript">
    window.location = "{{ url('/studentlogin') }}"; //here double curly bracket
</script>
@else
<script type="text/javascript">
    window.location = "{{ url('/admin') }}"; //here double curly bracket
</script>
@endif

@endif