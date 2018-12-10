@extends('layouts.app')

@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Add/Edit Order
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Add/Edit Order</li>
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
		<h3>Back To list View &nbsp; <a title="Back To List" href="{{ url('/ordermgt') }}"><i class="fa fa-reply" aria-hidden="true"></i></a> </h3>
	</div>
</div>


<div class="row">
	<div class="col-md-12">	

       <!-- general form elements -->
      <form role="form" name="orderProfile" id="orderProfile" action="{{ route('ordermgtadd') }}" method="post">
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
	                      <label for="survey_name">Students</label>

							<select name="student_id" id="student_id" class="form-control">
							<option value="">Choose</option>
							<?php
							foreach($student_list as $student_val)
							{
							?>
								<option value="<?php echo $student_val->user_id; ?>" <?php if(!empty($user_array['student_id']) && $user_array['student_id'] == $student_val->user_id) echo "selected"; ?> ><?php echo $student_val->first_name." ".$student_val->last_name; ?></option>
							<?php
							}
							?>
							</select>
						  
	                    </div>  					
                    
	                    <div class="form-group">
	                      <label for="survey_name">Packages</label>

							<select name="package_id" id="package_id" class="form-control">
							<option value="">Choose</option>
							<?php
							foreach($package_list as $package_val)
							{
							?>
								<option value="<?php echo $package_val->package_id; ?>" <?php if(!empty($user_array['package_id']) && $user_array['package_id'] == $package_val->package_id) echo "selected"; ?> ><?php echo $package_val->package_name; ?></option>
							<?php
							}
							?>
							</select>
						  
	                    </div> 

						<div class="form-group">
						  <label for="survey_name">Payment Methods</label>

							<select name="payment_methods" id="payment_methods" class="form-control">
							<option value="">Choose</option>
							<option value="cash" <?php if(!empty($user_array['payment_methods']) && $user_array['payment_methods'] == 'cash') echo "selected"; ?> >Cash</option>
							<option value="australian_online_transfer" <?php if(!empty($user_array['payment_methods']) && $user_array['payment_methods'] == 'australian_online_transfer') echo "selected"; ?> >Australian online transfer</option>
							<option value="alipay_wechat" <?php if(!empty($user_array['payment_methods']) && $user_array['payment_methods'] == 'alipay_wechat') echo "selected"; ?> >Alipay/wechat pay</option>							
							</select>
						</div> 

						<div class="form-group">
						  <label for="survey_name">How You Know About ?</label>

							<select name="know_about" id="know_about" class="form-control">
								<option value="">Choose</option>
								
								<option value="from_newspaper" <?php if(!empty($user_array['know_about']) && $user_array['know_about'] == 'from_newspaper') echo "selected"; ?> >News Paper</option>
								<option value="from_social_media" <?php if(!empty($user_array['know_about']) && $user_array['know_about'] == 'from_social_media') echo "selected"; ?> >Social Media</option>
								<option value="from_email" <?php if(!empty($user_array['know_about']) && $user_array['know_about'] == 'from_email') echo "selected"; ?> >Email Promotions</option>
								<option value="from_tv_advertisement" <?php if(!empty($user_array['know_about']) && $user_array['know_about'] == 'from_tv_advertisement') echo "selected"; ?> >TV Advertisement</option>
								<option value="from_road_advertisement" <?php if(!empty($user_array['know_about']) && $user_array['know_about'] == 'from_road_advertisement') echo "selected"; ?> >Banners Beside Roads</option>								
							</select>
						</div> 						

                    </div>
                    <!-- First Box -->
                    
                    <!-- Second Box -->
                    <div class="col-md-6"> 
                    
						<div class="form-group">
						  <label for="survey_name">Class</label>

							<select name="class_id" id="class_id" class="form-control">
							<option value="">Choose</option>
							<?php
							foreach($class_list as $class_val)
							{
							?>
								<option value="<?php echo $class_val->class_id; ?>" <?php if(!empty($user_array['class_id']) && $user_array['class_id'] == $class_val->class_id) echo "selected"; ?> ><?php echo $class_val->class_title; ?></option>
							<?php
							}
							?>
							</select>
						  
						</div> 

                        <div class="form-group">
                          <label for="phone">Student Goals</label>
                          <textarea id="student_goal" name="student_goal" class="form-control"><?php if(!empty($user_array['student_goal'])) echo $user_array['student_goal']; ?></textarea>
                        </div>
                        
						<div class="form-group">
						  <label for="survey_name">Order Status</label>
							<select name="status" id="status" class="form-control">
								<option value="">Choose</option>
								<option value="Y" <?php if(!empty($user_array['status']) && $user_array['status'] == 'Y') echo "selected"; ?> >Active</option>
								<option value="N" <?php if(!empty($user_array['status']) && $user_array['status'] == 'N') echo "selected"; ?> >Inactive</option>
								<option value="NA" <?php if(!empty($user_array['status']) && $user_array['status'] == 'NA') echo "selected"; ?> >Not Approved</option>
							</select>
						</div>
						
						<div class="form-group">
							<label for="payment_amount">Paid Amount</label>
							<input type="text" class="form-control" name="payment_amount" id="payment_amount" value="<?php if(!empty($user_array['payment_amount'])) echo $user_array['payment_amount']; ?>" placeholder="Enter Paid Amount"  />
						</div>
						
						<div class="form-group">
						  <label for="survey_name">Payment Status</label>
							<select name="payment_status" id="payment_status" class="form-control">
								<option value="">Choose</option>
								<option value="pending" <?php if(!empty($user_array['payment_status']) && $user_array['payment_status'] == 'pending') echo "selected"; ?> >Pending</option>
								<option value="paid" <?php if(!empty($user_array['payment_status']) && $user_array['payment_status'] == 'paid') echo "selected"; ?> >Paid</option>
								<option value="half_paid" <?php if(!empty($user_array['payment_status']) && $user_array['payment_status'] == 'half_paid') echo "selected"; ?> >Half Paid</option>
								<option value="refund" <?php if(!empty($user_array['payment_status']) && $user_array['payment_status'] == 'refund') echo "selected"; ?> >Refund</option>
							</select>
						</div>						                        						
                    </div> 
                    <!-- Second Box -->
                    
            	</div>
            </div>
            <!-- /.box-body --> 
            <div class="box-footer">
				<?php if(!empty($user_array['order_id'])) { ?>
                <input type="hidden" name="order_id" id="order_id" value="<?php echo $user_array['order_id']; ?>" />
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
