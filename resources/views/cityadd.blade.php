@extends('layouts.app')

@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Add / Edit City
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Add / Edit City</li>
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
	<div class="col-md-12">	

       <!-- general form elements -->
      <form role="form" name="cityadd" id="cityadd" action="{{ route('cityadd') }}" method="post">
      {{ csrf_field() }}
      <div class="box box-danger">
        <!-- <div class="box-header with-border">
          <h3 class="box-title">Add / Edit Survey Type</h3>
        </div> -->
        <!-- /.box-header -->

        <!-- /.box-body -->
		<div class="box-body">
			<div class="row">
                <!-- First Box -->
                <div class="col-md-6">  
                    <div class="form-group">
                      <label for="survey_name">Country</label>

						<select name="country_id" id="country_id" class="form-control">
						<option value="">Choose</option>
						<?php
						foreach($country_list as $country_val)
						{
						?>
							<option value="<?php echo $country_val->country_id; ?>" <?php if(!empty($location_det['country_id']) && $location_det['country_id'] == $country_val->country_id) echo "selected"; ?> ><?php echo $country_val->country; ?></option>
						<?php
						}
						?>
						</select>
					  
                    </div> 
                </div>
                <!-- First Box -->
				
                <!-- Second Box -->
                <div class="col-md-6"> 
                    <div class="form-group">
                      <label for="survey_slug">City</label>
                      <input type="text" id="city" name="city" value="<?php if(!empty($location_det['city'])) echo $location_det['city']; ?>" class="form-control" placeholder="Enter City Name" required>
                    </div>                       
                </div> 
                <!-- Second Box -->
            </div>
        </div>
        <!-- /.box-body --> 
        
        <div class="box-footer">
            <?php if(!empty($location_det['city_id'])) { ?>
            <input type="hidden" name="city_id" id="city_id" value="<?php echo $location_det['city_id']; ?>" />
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
