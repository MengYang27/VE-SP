@extends('layouts.questionmgtLayout')

@section('additional_css')
  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="{{ asset('library/bootstrap-3.3.7/dist/css/bootstrap.min.css') }}">
  <!-- Toastr -->
  <link rel="sytlesheet" href="{{ asset('library/toastr/toastr.min.css"') }}" />
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="{{ asset('library/bootstrap-table-master/dist/bootstrap-table.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">  
@endsection

@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Role List
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Role List</li>
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
              <h3 class="box-title">List of Roles &nbsp; <a style="font-size: 25px;" title="Add" href="{{ url('/rolemgtadd') }}"><i class="fa fa-plus-square" aria-hidden="true"></i>
</a></h3>
            </div> 
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              
                <thead>
                <tr>
                  <th>SL No</th>
                  <th>Role</th>
                  <th>Slug</th>
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
                            $delete_url = url('/rolemgtdel')."/".$location_arr['role_id'];
                            $edit_url   = url('/roleedit')."/".$location_arr['role_id'];
							$perm_url   = url('/assignperm')."/".$location_arr['role_id'];
                ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php if(!empty($location_arr['role'])) echo $location_arr['role']; ?></td>
                                <td><?php if(!empty($location_arr['role_slug'])) echo $location_arr['role_slug'];; ?></td>
                              
                              <td>
                              <a href="<?php echo $edit_url; ?>" title="Edit"><i class="fa fa-fw fa-pencil"></i></a> 
                              <a href="<?php echo $delete_url; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-fw fa-close"></i>
							  <a href="<?php echo $perm_url; ?>" title="Add Permission"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
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
<!--                <tr>
                  <th>SL No</th>
                  <th>Role</th>
                  <th>Slug</th>
                  <th>Actions</th>
                </tr>-->
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



@section('additional_js')
<!-- jQuery -->
{{-- <script src="{{ asset('library/jquery-validation-1.14.0/lib/jquery.js') }}"></script> --}}
<!-- <script src="/library/jquery/dist/jquery.min.js"></script> -->
<!-- jQuery-UI -->
{{-- <script src="{{ asset('library/jquery-ui/jquery-ui.min.js') }}"></script> --}}
<!-- Boostrap 3.3.7 -->
{{-- <script src="{{ asset('library/bootstrap-3.3.7/dist/js/bootstrap.min.js') }}"></script> --}}
<!-- Latest compiled and minified JavaScript -->
{{-- <script src="{{ asset('library/bootstrap-table-master/dist/bootstrap-table.min.js') }}"></script> --}}
<!-- Toastr -->
{{-- <script src="{{ asset('library/toastr/toastr.min.js') }}"></script> --}}
<!-- Self Sourced -->
{{-- <script src="{{ asset('/js/index.js') }}"></script> --}}

@endsection
