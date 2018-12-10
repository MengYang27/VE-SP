@extends('layouts.app')
@section('content')
@include('adminmenu')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	All Materials
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">All Materials</li>
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
              <h3 class="box-title">List of Materials</h3> &nbsp; <a style="font-size: 25px;" title="Add" href="{{ url('/materialadd') }}"><i class="fa fa-plus-square" aria-hidden="true"></i>
</a>
            </div>

			<div class="clear"></div>		
		
		
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              
                <thead>
                <tr>
                  <th>Materials Name</th>
                  <th>Category</th>
                  <th>View Level</th>
                  <th>Created On</th>
                  <th>Created By</th>
                  <th>Actions</th>
                </tr>
                </thead>
                
                <tbody>
                <?php
					if(!empty($badge_array))
					{
					    $count = 1;
						foreach($badge_array as $badge_profile_arr)
						{
                            $delete_url = url('/materialdel')."/".$badge_profile_arr['material_det_id'];
                            $edit_url   = url('/materialedit')."/".$badge_profile_arr['material_det_id'];
                           
				?>
                            <tr>
                              <td><?php echo $badge_profile_arr['material_name']; ?></td>
                              <td><?php echo $badge_profile_arr['material_cat_name']; ?></td>
							  <td><?php echo $badge_profile_arr['visibility_level']; ?></td>
                              <td><?php echo $badge_profile_arr['created_on']; ?></td>
                              <td><?php if($badge_profile_arr['created_by'] == 0) echo "Admin"; ?></td>
                                  
                              <td>
								<a href="<?php echo $edit_url; ?>" title="Edit"><i class="fa fa-fw fa-pencil"></i></a> 
								<a href="<?php echo $delete_url; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-fw fa-close"></i></a>
								<?php
								if(!empty($badge_profile_arr['associated_file']))
								{
								?>	
								<a target="_blank" href="{{ URL::to('/') }}/materials/<?php echo $badge_profile_arr['associated_file']; ?>" ><i class="fa fa-download" aria-hidden="true"></i>
</a>
								<?php
								}
								?>
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
<!--                  <th>Materials Name</th>
                  <th>Category</th>
                  <th>View Level</th>
                  <th>Created On</th>
                  <th>Created By</th>                  
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