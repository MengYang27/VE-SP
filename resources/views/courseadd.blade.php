@extends('layouts.app')

@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Add/Edit Course
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Add/Edit Course</li>
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
      <form role="form" name="courseProfile" id="courseProfile" action="{{ route('courseadd') }}" method="post">
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
	                      <label for="survey_name">Category</label>

							<select name="category_id" id="category_id" class="form-control">
							<option value="">Choose</option>
							<?php
							foreach($category_list as $category_val)
							{
							?>
								<option value="<?php echo $category_val->category_id; ?>" <?php if(!empty($user_array['category_id']) && $user_array['category_id'] == $category_val->category_id) echo "selected"; ?> ><?php echo $category_val->category; ?></option>
							<?php
							}
							?>
							</select>
						  
	                    </div>                     

                        
                        <div class="form-group">
                          <label for="username">Course Details</label>
                          <input type="text" id="course_details" name="course_details" value="<?php if(!empty($user_array['course_details'])) echo $user_array['course_details']; ?>" class="form-control" placeholder="Enter Course Details" required>
                        </div>                         

                        
                    </div>
                    <!-- First Box -->
                    
                    <!-- Second Box -->
                    <div class="col-md-6"> 
                    
                     
                        <div class="form-group">
                          <label for="username">Course Name</label>
                          <input type="text" id="course_name" name="course_name" value="<?php if(!empty($user_array['course_name'])) echo $user_array['course_name']; ?>" class="form-control" placeholder="Enter Course Name" required>
                        </div>                    
                        
                        <div class="form-group">
                          <label for="phone">Course Code</label>
                          <input type="text" id="course_code" name="course_code" value="<?php if(!empty($user_array['course_code'])) echo $user_array['course_code']; ?>" class="form-control" placeholder="Enter Course Code" required>
                        </div>                                                                                 
                    </div> 
                    <!-- Second Box -->
            	</div>
            </div>
            <!-- /.box-body --> 
            <div class="box-footer">
				<?php if(!empty($user_array['course_id'])) { ?>
                <input type="hidden" name="course_id" id="course_id" value="<?php echo $user_array['course_id']; ?>" />
                <?php } ?> 
                
                <input type="hidden" name="frmSubmit" id="frmSubmit" value="1" />
             
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
