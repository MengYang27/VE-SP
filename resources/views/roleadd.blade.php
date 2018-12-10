@extends('layouts.app')

@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Add / Edit Role
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Add / Edit Role</li>
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
<div class="row pull-right">
	<div class="col-md-12">
		<h3>Back To list View &nbsp; <a title="Back To List" href="{{ url('/rolemgt') }}"><i class="fa fa-reply" aria-hidden="true"></i></a> </h3>
	</div>
</div>


<div class="row">
	<div class="col-md-12">	

       <!-- general form elements -->
      <form role="form" name="roleadd" id="roleadd" action="{{ route('rolemgtadd') }}" method="post">
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
                      <label for="survey_name">Role</label>
                      <input type="text" id="role" name="role" value="<?php if(!empty($location_det['role'])) echo $location_det['role']; ?>" class="form-control" placeholder="Enter Role Name" required>
                    </div> 
                </div>
                <!-- First Box -->
                <!-- Second Box -->
                <div class="col-md-6"> 
                    <div class="form-group">
                      <label for="survey_slug">Role Slug</label>
                      <input type="text" id="role_slug" name="role_slug" value="<?php if(!empty($location_det['role_slug'])) echo $location_det['role_slug']; ?>" class="form-control" placeholder="Enter Role Slug" required>
                    </div>                       
                </div> 
                <!-- Second Box -->
            </div>
        </div>
        <!-- /.box-body --> 
        
        <div class="box-footer">
            <?php if(!empty($location_det['role_id'])) { ?>
            <input type="hidden" name="roleid" id="roleid" value="<?php echo $location_det['role_id']; ?>" />
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
