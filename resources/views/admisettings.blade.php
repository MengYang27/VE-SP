@extends('layouts.app')

@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Admin Profile
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Admin Profile</li>
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

<div class="row">
	<div class="col-md-12">	

       <!-- general form elements -->
      <form role="form" name="crmProfile" id="crmProfile" action="" method="post">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add / Edit Admin</h3>
        </div>

        <!-- /.box-header -->

        <!-- form start -->

            <!-- First Box -->
            <div class="col-md-6">  

              <!-- /.box-body -->

              <div class="box-body">

                <div class="form-group">
                  <label for="exampleInputEmail1">Category</label>
                  <select id="emp_type" name="emp_type" class="form-control" <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') { ?>disabled="disabled"<?php } ?>>
                    <option value="">Choose Category</option>
                    <?php
                    if(!empty($parent_category_que)) 
                    {
						while($parent_category_arr = mysql_fetch_assoc($parent_category_que))
						{
					?>
                    		<option value="<?php echo $parent_category_arr['id']; ?>" <?php if(!empty($employee_profile_arr['emp_type']) && $parent_category_arr['id'] == $employee_profile_arr['emp_type']) { ?> selected <?php } ?>><?php echo $parent_category_arr['type_name']; ?></option>
					<?php 
						}
                     }   
					?>
                  </select> 
                  <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') { ?><input type="hidden" name="emp_type" id="emp_type" value="<?php if(!empty($employee_profile_arr['emp_type'])) echo $employee_profile_arr['emp_type']; ?>" /><?php } ?>
                </div> 
                
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Designation</label>
                  <select id="designation" name="designation" class="form-control" <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') { ?>disabled="disabled"<?php } ?>>
                    <option value="">Choose Designation</option>
                    <?php 
                    if(!empty($designation_profile_que)) 
                    {                    
						while($designation_profile_arr = mysql_fetch_assoc($designation_profile_que))
						{
					?>
                    		<option value="<?php echo $designation_profile_arr['id']; ?>" <?php if(!empty($employee_profile_arr['designation']) && $designation_profile_arr['id'] == $employee_profile_arr['designation']) { ?> selected <?php } ?>><?php echo $designation_profile_arr['designation']; ?></option>
					<?php 
						}
                    }
					?>
                  </select> 
                  <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') { ?><input type="hidden" name="designation" id="designation" value="<?php if(!empty($employee_profile_arr['designation'])) echo $employee_profile_arr['designation']; ?>" /><?php } ?>
                </div>                    

                <div class="form-group">
                  <label for="exampleInputEmail1">First Name</label>
                  <input type="text" id="first_name" name="first_name" value="<?php if(!empty($employee_profile_arr['first_name'])) echo $employee_profile_arr['first_name']; ?>" class="form-control" placeholder="Enter First Name" required>
                </div> 

                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name</label>
                  <input type="text" id="last_name" name="last_name" value="<?php if(!empty($employee_profile_arr['last_name'])) echo $employee_profile_arr['last_name']; ?>" class="form-control" placeholder="Enter Last Name" required>
                </div> 


                <div class="form-group"> 
                	<?php if(!empty($employee_id)) { ?>
                    <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>" />
					<?php } ?> 
					<input type="hidden" name="branch_id" id="branch_id" value="<?php if(!empty($_SESSION['branch_id'])) echo $_SESSION['branch_id']; ?>" />                 
            		<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
               </div>                        
              </div>

              <!-- /.box-body -->
            </div>
            <!-- First Box -->


            <!-- Second Box -->
            <div class="col-md-6"> 

                <!-- /.box-body -->	

                <div class="box-body">
                
                 <div class="form-group">
                  <label for="exampleInputEmail1">Email Address</label>
                  <input type="text" id="email" name="email" value="<?php if(!empty($employee_profile_arr['email'])) echo $employee_profile_arr['email']; ?>" class="form-control" placeholder="Enter Email Address" required>
                </div>                    
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone Number</label>
                  <input type="text" id="phone" name="phone" value="<?php if(!empty($employee_profile_arr['phone'])) echo $employee_profile_arr['phone']; ?>" class="form-control" placeholder="Enter Phone Number" required>
                </div>                       
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Alternate Phone Number</label>
                  <input type="text" id="alternatephone" name="alternatephone" value="<?php if(!empty($employee_profile_arr['alternatephone'])) echo $employee_profile_arr['alternatephone']; ?>" class="form-control" placeholder="Enter Alternate Phone Number">
                </div>                    

                <div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <input type="text" id="address" name="address" value="<?php if(!empty($employee_profile_arr['address'])) echo $employee_profile_arr['address']; ?>" class="form-control" placeholder="Enter Address" required>
                </div>                                                               

                </div>
                <!-- /.box-body --> 
            </div> 
          	<!-- Second Box -->

          <div class="box-footer">

          </div>

          <!-- Second Box -->
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
