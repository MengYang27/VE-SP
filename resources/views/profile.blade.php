@extends('layouts.app')
@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Profile Details
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/studentboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Profile</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

@if(Session::has('message'))

 <!-- Message box to message for any event -->
    <div class="row">
        <!-- First Box -->
        <div class="col-md-12">
           <!-- Message box to message for any event -->
           <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Event Message !!</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {{Session::get('message')}}
            </div>
            <!-- /.box-body -->
          </div>
           <!-- Message box to message for any event -->    
        </div>
     </div> 
 <!-- Message box to message for any event -->

@endif

<!-- Executional HTML -->

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-warning">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{URL::asset('/bower_components/adminlte/dist/img/user2-160x160.jpg')}}" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo ucfirst($user_array['first_name'])." ".ucfirst($user_array['last_name']); ?></h3>

              <p class="text-muted text-center">Student</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Joined On</b> <a class="pull-right"><?php echo date("Y-m-d", strtotime($user_array['created_on'])); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $user_array['email']; ?></a>
                </li>
				
				<!--
                <li class="list-group-item">
                  <b>VIP 有效时间</b> <a class="pull-right">01/01/2019</a>
                </li>
				-->
              </ul>

              <!--<a href="#" class="btn btn-warning btn-block"><b>Update Profile</b></a>-->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
		  <?php /* ?>
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
		  <?php */  ?>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#profile_settings" data-toggle="tab">Profile Setting</a></li>
              <li><a href="#account_settings" data-toggle="tab">Account Setting</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="profile_settings">
			  
                <form class="form-horizontal" method="post" name="update_profile" action="{{ route('updateprofile') }}">
				{{ csrf_field() }}
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">First Name</label>

                    <div class="col-sm-10">
                      <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="<?php echo $user_array['first_name']; ?>">
                    </div>
					
                  </div>
				  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                      <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="<?php echo $user_array['last_name']; ?>">
                    </div>
					
                  </div>				  
				  
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input name="email" type="email" class="form-control" id="email" placeholder="Email Address" value="<?php echo $user_array['email']; ?>" readonly>
                    </div>
                  </div>
				  
                  <div class="form-group">
                    <label for="inputLocation" class="col-sm-2 control-label">Country</label>

                        <div class="col-sm-10">
                            <select class="form-control" id="country_id" name="country_id">
							<option value="">Choose Country</option>
							<?php
							foreach($country_list as $country_val)
							{
							?>
								<option value="<?php echo $country_val->country_id; ?>" <?php if(!empty($user_array['country_id']) && $user_array['country_id'] == $country_val->country_id) echo "selected"; ?> ><?php echo $country_val->country; ?></option>
							<?php
							}
							?>
                            </select>
                        </div>
                  </div>
				  
                  <div class="form-group">
                    <label for="inputLocation" class="col-sm-2 control-label">City</label>

                        <div class="col-sm-10">
                            <select class="form-control" id="city_id" name="city_id">
							<option value="">Choose City</option>
							<?php
							foreach($cities as $city_val)
							{
							?>
								<option value="<?php echo $city_val->city_id; ?>" <?php if(!empty($user_array['city_id']) && $user_array['city_id'] == $city_val->city_id) echo "selected"; ?> ><?php echo $city_val->city; ?></option>
							<?php
							}
							?>
                            </select>
                        </div>
                  </div>
				  
                  <div class="form-group">
                    <label for="inputOccupation" class="col-sm-2 control-label">Phone</label>

                    <div class="col-sm-10">
                      <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" value="<?php echo $user_array['phone']; ?>">
                    </div>
                  </div>
				  
				  <!--
                  <div class="form-group">
                    <label for="inputIntroduction" class="col-sm-2 control-label">Introduction</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputIntroduction" placeholder="I ..."></textarea>
                    </div>
                  </div>
				  
				  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
				  -->
				  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-warning">Update Profile</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              
              <div class="tab-pane" id="account_settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputCurrentPassword" class="col-sm-2 control-label">Current Password</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputCurrentPassword" placeholder="Current Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputNewPassword" class="col-sm-2 control-label">New Password</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputNewPassword" placeholder="New Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputRetypeNewPassword" class="col-sm-2 control-label">Re-type New Password</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputRetypeNewPassword" placeholder="Re-type New Password">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
<!-- Executional HTML -->
  
  
</section>
<!-- Main content -->	
</div>
@endsection
