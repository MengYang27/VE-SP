@extends('layouts.app')
@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Email Template List
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Email Template List</li>
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
        
 		<!-- Full Featured data table -->
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Email Templates</h3> &nbsp; <a style="font-size: 25px;" title="Add" href="{{ url('/notificationadd') }}"><i class="fa fa-plus-square" aria-hidden="true"></i>
</a>
            </div>

			<div class="clear"></div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              
                <thead>
                <tr>
                  <th>SL No</th>
                  <th>Template Name</th>
                  <th>Actions</th>
                </tr>
                </thead>
                
                <tbody>
                <?php
                    if(!empty($location_array))
                    {
                        $count = 1;
                        foreach($location_array as $location_arr)
                        {
                            $delete_url = url('/notificationdel')."/".$location_arr['template_id'];
                            $edit_url   = url('/notificationedit')."/".$location_arr['template_id'];
                ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php if(!empty($location_arr['email_subject'])) echo $location_arr['email_subject']; ?></td>
                              
                              <td>
                              <a href="<?php echo $edit_url; ?>" title="Edit"><i class="fa fa-fw fa-pencil"></i></a> 
                              <a href="<?php echo $delete_url; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-fw fa-close"></i>
                              </a>
                              </td>
                            </tr>
                <?php
                           $count++; 
                         }
                    }
                    else
                    {
                ?>

                <?php
                    }
                ?>
                </tbody>
                
                
                <tfoot>
                <tr>
<!--                  <th>SL No</th>
                  <th>Template Name</th>
                  <th>Actions</th>-->
                </tr>
                </tfoot>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- Full Featured data table -->       

		</div>
    </div>
  
</section>
<!-- Main content -->

	
</div>

@endsection