@extends('layouts.app')
@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	User Management
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">User Management</li>
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
              <h3 class="box-title">List of Users</h3> &nbsp; <a style="font-size: 25px;" title="Add" href="{{ url('/usermgtadd') }}"><i class="fa fa-plus-square" aria-hidden="true"></i>
</a>
            </div>

			<div class="clear"></div>
			
            <!-- box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                <tr>
                	<th>Role</th>
                    <th>Name</th>
                    <th>Temperature</th>
                    <th>Phone No.</th>
                    <th>Email Address</th>
                    <th>Status</th>
                    <th>Actions</th>

                </tr>
                </thead>

                <tbody>
                <?php
                if(!empty($user_array))
                {
                        foreach($user_array as $customer_profile_arr)
                        {
                            $delete_url = url('/usermgtdel')."/".$customer_profile_arr['user_id'];
                            $edit_url   = url('/useredit')."/".$customer_profile_arr['user_id'];

                            if(!empty($customer_profile_arr['status'])) {

                                if($customer_profile_arr['status'] == 'Y'){
                                    $status_change_url = url('/userstatchange')."/".$customer_profile_arr['user_id']."/N";
                                    $font_class = 'fa fa-fw fa-unlock';
                                    $text_to_fill = 'Deactivate';
                                }
                                else    {
                                   $status_change_url = url('/userstatchange')."/".$customer_profile_arr['user_id']."/Y";
                                   $font_class = 'fa fa-fw fa-lock';
                                   $text_to_fill = 'Activate';
                                }

                            }
                            else{
                                $status_change_url = 'javascript:void(0)';
                                $font_class = 'fa fa-fw fa-lock';
                                $text_to_fill = '';
                            }

				?>
                            <tr>
                              <td><?php if(!empty($customer_profile_arr['role'])) echo $customer_profile_arr['role']; else echo 'N/A'; ?></td>                            
                              <td><?php if(!empty($customer_profile_arr['first_name'])) echo $customer_profile_arr['first_name']." ".$customer_profile_arr['last_name']; else echo 'N/A'; ?></td>
                              <td><?php if(!empty($customer_profile_arr['temperature']) && $customer_profile_arr['role_id'] == 3) echo "[". $customer_profile_arr['temperature']."]"; elseif(empty($customer_profile_arr['temperature']) && $customer_profile_arr['role_id'] == 3) echo "[Warm]"; else echo 'N/A'; ?></td>
                              <td><?php echo $customer_profile_arr['phone']; ?></td>
                              <td><?php echo $customer_profile_arr['email']; ?></td>

                              <td><?php if(empty($customer_profile_arr['status'])) echo 'N/A'; else echo $customer_profile_arr['status']; ?></td>
                              <td>
                              <a href="<?php echo $edit_url; ?>" title="Edit"><i class="fa fa-fw fa-pencil"></i></a>
                              <a href="<?php echo $delete_url; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-fw fa-close"></i></a>
                              <a href="<?php echo $status_change_url; ?>" title="Status Change"><!--<i class="<?php echo $font_class; ?>"></i>--><?php echo $text_to_fill; ?></a>
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
<!--                	<th>Role</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone No.</th>
                    <th>Email Address</th>
                    <th>Status</th>
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
