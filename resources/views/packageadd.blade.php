@extends('layouts.app')

@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Add/Edit Package
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Add/Edit Package</li>
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
		<h3>Back To list View &nbsp; <a title="Back To List" href="{{ url('/packagemgt') }}"><i class="fa fa-reply" aria-hidden="true"></i></a> </h3>
	</div>
</div>


<div class="row">
	<div class="col-md-12">	

       <!-- general form elements -->
      <form role="form" name="crmProfile" id="crmProfile" action="{{ route('packagemgtadd') }}" method="post">
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
                          <label for="username">Package Name</label>
                          <input type="text" id="package_name" name="package_name" value="<?php if(!empty($user_array['package_name'])) echo $user_array['package_name']; ?>" class="form-control" placeholder="Enter Package Name" required>
                        </div>
                        
                        <div class="form-group">
                          <label for="username">Package Details</label>
                          <input type="text" id="package_details" name="package_details" value="<?php if(!empty($user_array['package_details'])) echo $user_array['package_details']; ?>" class="form-control" placeholder="Enter Package Details" required>
                        </div>                         
                        
                    </div>
                    <!-- First Box -->
                    
                    <!-- Second Box -->
                    <div class="col-md-6"> 

                        <div class="form-group">
                          <label for="phone">Package Price</label>
                          <input type="text" id="package_price" name="package_price" value="<?php if(!empty($user_array['package_price'])) echo $user_array['package_price']; ?>" class="form-control" placeholder="Enter Package Price" required>
                        </div>                                                                                 
                    </div> 
                    <!-- Second Box -->
            	</div>
            </div>
            <!-- /.box-body --> 
            <div class="box-footer">
				<?php if(!empty($user_array['package_id'])) { ?>
                <input type="hidden" name="package_id" id="package_id" value="<?php echo $user_array['package_id']; ?>" />
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
