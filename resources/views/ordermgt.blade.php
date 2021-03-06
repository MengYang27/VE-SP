@extends('layouts.app')
@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Order Management
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Order Management</li>
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
              <h3 class="box-title">List of Orders</h3> &nbsp; <a style="font-size: 25px;" title="Add" href="{{ url('/ordermgtadd') }}"><i class="fa fa-plus-square" aria-hidden="true"></i>
</a>
            </div>

			<div class="clear"></div>
			
            <!-- box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                <tr>
                	<th>Student</th>
                    <th>Package</th>
                    <th>Amount</th>
                    <th>Class</th>
                    <th>Paid </th>
                    <th>Pay Status</th>
                    <th>Ordered</th>
                    <th>Valid</th>
                    <th>Status</th>
                    <th>Apprv/Block</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php
                if(!empty($user_array))
                {
                        foreach($user_array as $customer_profile_arr)
                        {
                            $delete_url = url('/ordermgtdel')."/".$customer_profile_arr['order_id'];
                            $edit_url   = url('/orderedit')."/".$customer_profile_arr['order_id'];

                            if(!empty($customer_profile_arr['status'])) {

                                if($customer_profile_arr['status'] == 'Y'){
									$status_change_url 	= url('/orderstatchange')."/".$customer_profile_arr['order_id']."/N";
									$font_class 		= 'fa fa-minus-circle';
									$color				= '#ff0000';                                    

                                }
                                elseif($customer_profile_arr['status'] == 'NA'){
									$status_change_url 	= url('/orderstatchange')."/".$customer_profile_arr['order_id']."/Y";
									$font_class 		= 'fa fa-key';
									$color				= '#29eb14';                                    

                                }                                
                                else    
                                {
									$status_change_url 	= url('/orderstatchange')."/".$customer_profile_arr['order_id']."/Y";
									$font_class 		= 'fa fa-check-circle';
									$color				= '#29eb14';
                                }

                            }
                            else	
                            {
                                $status_change_url 		= 'javascript:void(0)';
                                $font_class 			= '';
                                $color					= '';
                            }

				?>
                            <tr <?php if(!empty($customer_profile_arr['status']) && $customer_profile_arr['status'] == 'NA') { ?> style="background-color:#EAF7A5;" <?php } ?>>
                              <td><?php echo $customer_profile_arr['first_name']." ".$customer_profile_arr['last_name'];  ?></td> 
                              <td><?php echo $customer_profile_arr['package_name'];  ?></td>
                              <td><?php echo $customer_profile_arr['package_price'];  ?></td>
                              <td><?php echo $customer_profile_arr['class_title']; ?></td>
                              <td><?php echo $customer_profile_arr['payment_amount']; ?></td>
                              
                              <td><?php if(!empty($customer_profile_arr['payment_status'])) echo ucfirst(str_replace('_',' ',$customer_profile_arr['payment_status'])); else echo "N/A"; ?></td>
                              <td><?php echo $customer_profile_arr['ordered_on']; ?></td>
                              <td><?php echo $customer_profile_arr['valid_upto']; ?></td>

                              <td><span style="background: #f9f906"><?php if(!empty($customer_profile_arr['status']) && $customer_profile_arr['status'] == 'Y') echo 'Active'; elseif(!empty($customer_profile_arr['status']) && $customer_profile_arr['status'] == 'N') echo "Inactive"; else echo "Not Approved"; ?></span>
                              </td>
                              <td align="center"><a href="<?php echo $status_change_url; ?>" title="Status Change"><span style="font-size: 20px; color: <?php echo $color; ?>;"><i class="<?php echo $font_class; ?>"></i></span></a></td>
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
<!--                	<th>Student</th>
                    <th>Package</th>
                    <th>Class</th>
                    <th>Goals</th>
                    <th>Ordered On</th>
                    <th>Status</th>
                    <th>Apprv/Block</th>
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
