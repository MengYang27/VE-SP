@extends('layouts.app')
@section('content')
@include('adminmenu')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Add/Edit Material
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Add/Edit Material</li>
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
		<h3>Back To list View &nbsp; <a title="Back To List" href="{{ url('/materialmgt') }}"><i class="fa fa-reply" aria-hidden="true"></i></a> </h3>
	</div>
</div>

<div class="row">
	<div class="col-md-12">	

       <!-- general form elements -->
      <form role="form" name="meterialadd" id="meterialadd" action="{{ route('materialadd') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="box box-danger">
        	<!-- /.box-header -->
        
            <!-- /.box-body -->	
            <div class="box-body">
            	<div class="row">
                    <!-- First Box -->
                    <div class="col-md-6">  
                    
						<div class="form-group">
						  <label for="survey_name">Category</label>

							<select name="material_cat_id" id="material_cat_id" class="form-control">
							<option value="">Choose</option>
							<?php
							foreach($all_categories as $each_category)
							{
							?>
							<option value="<?php echo $each_category->material_cat_id; ?>" <?php if(!empty($badge_array['material_cat_id']) && $badge_array['material_cat_id'] == $each_category->material_cat_id) echo "selected"; ?> ><?php echo $each_category->material_cat_name; ?></option>
							<?php
							}

							?>
							</select>
						  
						</div>                    
					
                        <div class="form-group">
                          <label for="badge_name">Material Name <span style="color: red; font-weight: bold;">*</span></label>
                          <input type="text" id="material_name" name="material_name" value="<?php if(!empty($badge_array['material_name'])) echo $badge_array['material_name']; ?>" class="form-control" placeholder="Enter Material Name" required>
                        </div> 
                        
 
						<div class="form-group">
						  <label for="survey_name">Visibility</label>

							<select name="visibility_level" id="visibility_level" class="form-control">
							<option value="">Choose</option>
							<option value="when_the_user_registered" <?php if(!empty($badge_array['visibility_level']) && $badge_array['visibility_level'] == 'when_the_user_registered') echo "selected"; ?> >when the user registered</option>
							<option value="when_course_approved" <?php if(!empty($badge_array['visibility_level']) && $badge_array['visibility_level'] == 'when_course_approved') echo "selected"; ?> >when course approved</option>
							<option value="everyone_can_see" <?php if(!empty($badge_array['visibility_level']) && $badge_array['visibility_level'] == 'everyone_can_see') echo "selected"; ?> >everyone can see</option>							
							</select>
						  
						</div> 
						
                        <div class="form-group">
                          	<label for="shape">Upload material</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-danger btn-file">
                                        Browse… <input type="file" id="associated_file" name="associated_file">
                                    </span>
                                </span>
                                <input type="text" id="FileNameShow" value=""  class="form-control" readonly>
                            </div>
                        </div> 						

                    </div>
                    <!-- First Box -->
                
                    <!-- Second Box -->
                    <div class="col-md-6"> 

                        <div class="form-group">
                          <label for="badge_name">File Name <span style="color: red; font-weight: bold;">*</span></label>
                          <input type="text" id="file_name" name="file_name" value="<?php if(!empty($badge_array['file_name'])) echo $badge_array['file_name']; ?>" class="form-control" placeholder="Enter File Name" required>
                        </div> 
                        
                                            
						<div class="form-group">
						  <label for="survey_name">File type</label>
						  
							<select name="file_type" id="file_type" class="form-control">
								<option value="">Choose</option>
								<option value="image" <?php if(!empty($badge_array['file_type']) && $badge_array['file_type'] == 'image') echo "selected"; ?> >Image</option>
								<option value="pdf" <?php if(!empty($badge_array['file_type']) && $badge_array['file_type'] == 'pdf') echo "selected"; ?> >PDF</option>
								<option value="doc" <?php if(!empty($badge_array['file_type']) && $badge_array['file_type'] == 'doc') echo "selected"; ?> >DOC</option>	
								<option value="zip" <?php if(!empty($badge_array['file_type']) && $badge_array['file_type'] == 'zip') echo "selected"; ?> >ZIP</option>
								<option value="others" <?php if(!empty($badge_array['file_type']) && $badge_array['file_type'] == 'others') echo "selected"; ?> >Others</option>							
							</select>
						</div>                      
                                           
                        
                        <?php
                        if(!empty($badge_array['associated_file']))
                        {
                        ?>
                        <div class="form-group">
                          <label for="shape">Material</label>
                          <div class="input-group">
                          	<a target="_blank" href="{{ URL::to('/') }}/materials/<?php echo $badge_array['associated_file']; ?>" >Download</a>
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
				<?php if(!empty($badge_array['material_det_id'])) { ?>
                <input type="hidden" name="material_det_id" id="material_det_id" value="<?php echo $badge_array['material_det_id']; ?>" />
                <?php } ?> 
                
                <input type="hidden" name="frmSubmit" id="frmSubmit" value="1" />               
                <button type="submit" name="submit" id="submit" class="btn bg-maroon">Submit</button>
            </div>
      </div>

      <!-- /.box -->

      </form>

     </div> 
</div>

<div class="row">
	<div class="">	

<table class="table table-bordered">
	<tbody>
	
		<tr>
		  <th style="width: 10px">#</th>
		  <th>Visibility Level</th>
		  <th>Details</th>
		</tr>
		
		<tr>
			<td>1</td>
			<td>When The User Registered</td>
			<td>This level denotes that all the materials of this level will be visible to users after their registration</td>
		</tr>
		
		<tr>
			<td>2</td>
			<td>When Course Approved</td>
			<td>This level denotes that all the materials of this level will be visible to users after their requested courses get approved.</td>
		</tr>

		<tr>
			<td>3</td>
			<td>Every Can see</td>
			<td>This level denotes that all the materials of this level will be visible to users without any such restrictions.</td>
		</tr>		
		
	</table>	
	
	</div>
</div>

<!-- Executional HTML -->
  
  
</section>
<!-- Main content -->	
</div>
@endsection
