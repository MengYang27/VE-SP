@extends('layouts.app')
@section('content')
@include('adminmenu')

<style>
.btn-primary {
    background-color: #ffd700;
    border-color: eecc14;
}

.btn-primary:hover {
    background-color: #ffd700;
    border-color: eecc14;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Course
	<small>Registration</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/studentboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Course</li>
  </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

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
	<!-- class box -->
	<section class="col-lg-12">
	  <div class="box box-warning box-solid" >
		<div class="box-header">
		  <h3 class="box-title">Course Form</h3>
		</div>
		<div class="box-body">
		  <form name="courseFrm" action="{{ route('studentcourse') }}" method="post">
		  {{ csrf_field() }}
			<div class="form-group has-feedback">
			<p>Select Package</p>
			<?php
			foreach($package_list as $package_val)
			{
			?>
			  <input type="radio" class="form-control" name="package_id" value="<?php echo $package_val->package_id; ?>"><?php echo $package_val->package_name; ?> &nbsp; [<?php echo $package_val->package_price; ?>]<br>
			<?php
			}
			?>	
			</div>
			
			<div class="form-group has-feedback">
				<select name="class_id" id="class_id" class="form-control">
				<option value="">Choose</option>
				<?php
				foreach($class_list as $class_val)
				{
				?>
					<option value="<?php echo $class_val->class_id; ?>"><?php echo $class_val->class_title; ?></option>
				<?php
				}
				?>
				</select>
			</div>
			
			<div class="form-group has-feedback">
			  <textarea class="form-control" name="student_goal" placeholder="Study Goal"></textarea>
			</div>
			
			<div class="form-group has-feedback">
			  <p>Payment Method</p>
			  <input type="radio" class="form-control" name="payment_methods" value="cash"> Cash<br>
			  <input type="radio" class="form-control" name="payment_methods" value="australian_online_transfer"> Bank Transfer<br>
			  <input type="radio" class="form-control" name="payment_methods" value="alipay_wechat"> Alipay/WeChat<br>       
			</div>
			
			<!--
			<div class="form-group has-feedback">
			  <p>Related Topic</p>
			  <input type="checkbox" class="form-control" name="payment" value="naati"> CCL Naati<br>
			  <input type="checkbox" class="form-control" name="payment" value="py"> PY<br>
			  <input type="checkbox" class="form-control" name="payment" value="intern"> Internship Program<br>
			  <input type="checkbox" class="form-control" name="payment" value="tutor"> Tutoring Service<br>
			  <input type="checkbox" class="form-control" name="payment" value="oversea"> Education/Immigration<br>
			  <input type="checkbox" class="form-control" name="payment" value="search"> Looking for Girlfriend/Boyfriend<br> 
			  <input type="checkbox" class="form-control" name="payment" value="study"> Psychological Consultant<br>
			  <input type="checkbox" class="form-control" name="payment" value="medical"> Medical Support<br>     
			</div>
			-->
			
			<div class="form-group has-feedback">
			  <p>How did you know Velocity English</p>
			  
			  <input type="radio" class="form-control" name="know_about" value="jijing"> Velocity English Jijing<br>
			  <input type="radio" class="form-control" name="know_about" value="friend"> Friends<br>
			  <input type="radio" class="form-control" name="know_about" value="agency"> Agency<br>
			  <input type="radio" class="form-control" name="know_about" value="wechat"> Wechat<br>
			  <input type="radio" class="form-control" name="know_about" value="media"> Media<br>
			  
			  <!--
			  <input type="radio" class="form-control" name="know_about" value="other"> Other:
			  <input type="text" name="know_about" >
			  -->
			  
			</div>
			
			<div class="row">
			  <div class="col-xs-12">
				
				<button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
			  </div>
			  <!-- /.col -->
			</div>
		  </form>
		</div>
	  </div> 
	</section>   

  </div>

<!-- Executional HTML -->
  
  
</section>
<!-- Main content -->	
</div>
@endsection
