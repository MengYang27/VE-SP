@extends('layouts.app')
@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Add/Edit Settings
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Add/Edit Settings</li>
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
      <form role="form" name="meterialadd" id="meterialadd" action="{{ route('settings') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="box box-danger">
        	<!-- /.box-header -->
        
            <!-- /.box-body -->	
            <div class="box-body">
            	<div class="row">
                    <!-- First Box -->
                    <div class="col-md-6">  
					
                        <div class="form-group">
                          <label for="badge_name">Company Name <span style="color: red; font-weight: bold;">*</span></label>
                          <input type="text" id="company_name" name="company_name" value="<?php if(!empty($settings_array['company_name'])) echo $settings_array['company_name']; ?>" class="form-control" placeholder="Enter Company Name" required>
                        </div> 
						
                        <div class="form-group">
                          <label for="badge_name">Website <span style="color: red; font-weight: bold;">*</span></label>
                          <input type="text" id="company_website" name="company_website" value="<?php if(!empty($settings_array['company_website'])) echo $settings_array['company_website']; ?>" class="form-control" placeholder="Enter Company Website" required>
                        </div> 

                        <div class="form-group">
                          <label for="badge_name">Phone Number <span style="color: red; font-weight: bold;">*</span></label>
                          <input type="text" id="phone_number" name="phone_number" value="<?php if(!empty($settings_array['phone_number'])) echo $settings_array['phone_number']; ?>" class="form-control" placeholder="Enter Phone Number" required>
                        </div> 						


                    </div>
                    <!-- First Box -->
                
                    <!-- Second Box -->
                    <div class="col-md-6"> 

                        <div class="form-group">
                          <label for="badge_name">Company Address <span style="color: red; font-weight: bold;">*</span></label>
                          <input type="text" id="company_address" name="company_address" value="<?php if(!empty($settings_array['company_address'])) echo $settings_array['company_address']; ?>" class="form-control" placeholder="Enter Company Address" required>
                        </div> 
                        
                        <div class="form-group">
                          <label for="badge_name">Email Address <span style="color: red; font-weight: bold;">*</span></label>
                          <input type="text" id="email_address" name="email_address" value="<?php if(!empty($settings_array['email_address'])) echo $settings_array['email_address']; ?>" class="form-control" placeholder="Enter Company Email" required>
                        </div>  

                        <div class="form-group">
                          	<label for="shape">Upload Company Logo</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-danger btn-file">
                                        Browse… <input type="file" id="company_logo" name="company_logo">
                                    </span>
                                </span>
                                <input type="text" id="FileNameShow" value="" class="form-control" readonly>
                            </div>
                        </div> 						
                                           
                        
                        <?php
                        if(!empty($settings_array['company_logo']))
                        {
                        ?>
                        <div class="form-group">
                          <label for="shape">Company Logo</label>
                          <div class="input-group">
                          	<img  src="{{ URL::to('/') }}/companyinfo/<?php echo $settings_array['company_logo']; ?>" >
                          </div>					
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
