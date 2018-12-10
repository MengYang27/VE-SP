@extends('layouts.app')
@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Course Management
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Course Management</li>
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
              <h3 class="box-title">List of Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                <tr>
                	<th>Category</th>
                    <th>Course</th>
                    <th>Code</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php
                if(!empty($location_array))
                {
                        foreach($location_array as $course_arr)
                        {
                            $delete_url = url('/coursedel')."/".$course_arr['course_id'];
                            $edit_url   = url('/courseedit')."/".$course_arr['course_id'];

				?>
                            <tr>
                              <td><?php if(!empty($course_arr['category'])) echo $course_arr['category']; else echo 'N/A'; ?></td>                            
                              <td><?php if(!empty($course_arr['course_name'])) echo $course_arr['course_name']; else echo 'N/A'; ?></td>
                              <td><?php if(!empty($course_arr['course_code'])) echo $course_arr['course_code']; else echo 'N/A'; ?></td>
></td>
                              <td>
                              <a href="<?php echo $edit_url; ?>" title="Edit"><i class="fa fa-fw fa-pencil"></i></a>
                              <a href="<?php echo $delete_url; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-fw fa-close"></i></a>
                              </td>

                            </tr>
                <?php
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
                	<th>Category</th>
                    <th>Course</th>
                    <th>Code</th>
                    <th>Actions</th>
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
