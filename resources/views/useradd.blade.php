@extends('layouts.app')

@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Add/Edit User
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Add/Edit User</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<?php
if(!empty($message)) 
{
?>	
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
              <?php echo $message; ?>
            </div>
            <!-- /.box-body -->
          </div>
           <!-- Message box to message for any event -->    
        </div>
     </div> 
 <!-- Message box to message for any event -->

 <?php
	if(!empty($message))
		unset($_SESSION['msg']); // Message unsent command to clear message after page refresh	 
}
 ?>

<!-- Executional HTML -->
<div class="row pull-right">
	<div class="col-md-12">
		<h3>Back To list View &nbsp; <a title="Back To List" href="{{ url('/usermgt') }}"><i class="fa fa-reply" aria-hidden="true"></i></a> </h3>
	</div>
</div>


<div class="row">
	<div class="col-md-12">	

       <!-- general form elements -->
      <form role="form" name="crmProfile" id="crmProfile" action="{{ route('usermgtadd') }}" method="post">
      {{ csrf_field() }}
      <div class="box box-danger">
        <!-- <div class="box-header with-border">
          <h3 class="box-title">Add / Edit Admin</h3>
        </div> -->

        <!-- /.box-header -->

		<!-- /.box-body -->	
            <div class="box-body">
            	<div class="row">
                    <!-- First Box -->
                    <div class="col-md-6">  
                    
	                    <div class="form-group">
	                      <label for="survey_name">Role</label>

							<select name="role_id" id="role_id" class="form-control">
							<option value="">Choose</option>
							<?php
							foreach($roles as $role_val)
							{
							?>
								<option value="<?php echo $role_val->role_id; ?>" <?php if(!empty($user_array['role_id']) && $user_array['role_id'] == $role_val->role_id) echo "selected"; ?> ><?php echo $role_val->role; ?></option>
							<?php
							}
							?>
							</select>
						  
	                    </div>                     
                       
                        <div class="form-group">
                          <label for="username">Full Name</label>
                          <input type="text" id="first_name" name="first_name" value="<?php if(!empty($user_array['first_name'])) echo $user_array['first_name']." ".$user_array['last_name']; ?>" class="form-control" placeholder="Enter Full Name" required>
                        </div>

                         <div class="form-group">
                          <label for="email">Email Address</label>
                          <input type="email" id="email" name="email" value="<?php if(!empty($user_array['email'])) echo $user_array['email']; ?>" class="form-control" placeholder="Enter Email Address" required>
                        </div>
                        
                        <div class="form-group">
                          <label for="username">Password</label>
                          <input type="password" id="password" name="password" value="<?php if(!empty($user_array['password'])) echo $user_array['password']; ?>" class="form-control" placeholder="Enter Password" required>
                        </div>                         
                        
                    </div>
                    <!-- First Box -->
                    
                    <!-- Second Box -->
                    <div class="col-md-6"> 
                    
                    <div class="form-group">
                      <label for="survey_name">Country</label>

						<select name="country_id" id="country_id" class="form-control">
						<option value="">Choose</option>
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
                        
                    <div class="form-group">
                      <label for="survey_name">City</label>

						<select name="city_id" id="city_id" class="form-control">
						<option value="">Choose</option>
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
                    
					<!--
                    <div class="form-group">
                      <label for="survey_name">Department</label>

						<select name="department_id" id="department_id" class="form-control">
						<option value="">Choose</option>
						<?php
						foreach($departments as $departments_val)
						{
						?>
							<option value="<?php echo $departments_val->department_id; ?>" <?php if(!empty($user_array['department_id']) && $user_array['department_id'] == $departments_val->department_id) echo "selected"; ?> ><?php echo $departments_val->department; ?></option>
						<?php
						}
						?>
						</select>
                    </div> 
					-->		
                        
                        <div class="form-group">
                          <label for="phone">Phone Number</label>
                          <input type="text" id="phone" name="phone" value="<?php if(!empty($user_array['phone'])) echo $user_array['phone']; ?>" class="form-control" placeholder="Enter Phone Number" required>
                        </div> 
                        
                        <?php
                        if(!empty($user_array['role_id']) && $user_array['role_id'] == 3)
                        {
                        ?>
		                    <div class="form-group">
		                      <label for="survey_name">Temperature</label>

								<select name="temperature" id="temperature" class="form-control">
									<option value="warm" <?php if(!empty($user_array['temperature']) && $user_array['temperature'] == 'warm') echo "selected"; ?>>Warm</option>
									<option value="cold" <?php if(!empty($user_array['temperature']) && $user_array['temperature'] == 'cold') echo "selected"; ?>>Cold</option>
									<option value="hot" <?php if(!empty($user_array['temperature']) && $user_array['temperature'] == 'hot') echo "selected"; ?>>Hot</option>
								</select>
		                    </div>                        
                        <?php
                        }
                        ?>                                                                                
                    </div> 
                    <!-- Second Box -->
            	</div>
            </div>
            <!-- /.box-body --> 
            <div class="box-footer">
				<?php if(!empty($user_array['user_id'])) { ?>
                <input type="hidden" name="userid" id="userid" value="<?php echo $user_array['user_id']; ?>" />
                <?php } ?> 
                
                <input type="hidden" name="frmSubmit" id="frmSubmit" value="1" />
                <input type="hidden" name="role" id="role" value="2" />                
                <button type="submit" name="submit" id="submit" class="btn bg-maroon">Submit</button>
            </div>
      </div>

      <!-- /.box -->

      </form>

     </div> 
</div>
<!-- Executional HTML -->
  
  
</section>
<!-- Main content -->	
</div>
@endsection
