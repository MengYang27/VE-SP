@extends('layouts.app')
@section('content')
@include('adminmenu')

<style>
.file-table {
	width:100%;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Materials
	<small>List</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="{{ url('/studentboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Materials</li>
  </ol>
</section>

<!-- Main content -->
	<section class="content container-fluid">
		<div class="row">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-6" style="width:100% !important;">
						<!-- Custom Tabs -->
						<div class="nav-tabs-custom">
							<!--						
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1" data-toggle="tab">Word Bank</a></li>
								<li><a href="#tab_2" data-toggle="tab">Official Materials</a></li>
								<li><a href="#tab_3" data-toggle="tab">VE Technics</a></li>
								<li><a href="#tab_4" data-toggle="tab">Test Experience</a></li>
								<li><a href="#tab_5" data-toggle="tab">PTE Templates</a></li>
								<li><a href="#tab_6" data-toggle="tab">PTE Instructions</a></li>
								<li><a href="#tab_7" data-toggle="tab">Presentation Materials</a></li>
								<li><a href="#tab_8" data-toggle="tab">New Materials</a></li>
							</ul>
							-->
							
							<ul class="nav nav-tabs">
							<?php
							if(!empty($material_categories))
							{
								$flag = 1;
								foreach($material_categories as $values)
								{
							?>
								<li <?php if($flag == 1) { ?> class="active" <?php } ?>>
									<a href="#tab_<?php echo $values->material_cat_id; ?>" data-toggle="tab"><?php echo $values->material_cat_name; ?></a>
								</li>
							<?php
								$flag++;
								}
							}
							?>
							</ul>							
							
							
							<div class="tab-content">
								<?php
								if(!empty($all_table_data))
								{
									$innerflag = 1;
									foreach($all_table_data as $mastervalues)
									{
								?>
										<div class="tab-pane <?php if($innerflag == 1) { ?> active <?php } ?>" id="tab_<?php echo $mastervalues['value_id']; ?>">
											<div class="box-body">
												<div id="accordion">
													<table class="file-table">
														<tr>
															<th>Filename</th>
															<th>Upload Time</th>
															<th>Popularity</th>	
														</tr>	
														
														<?php
															foreach($mastervalues['all_data'] as $innervalues)
															{
														?>
																<tr>
																	<td><a target="_blank" href="{{ URL::to('/') }}/materials/<?php echo $innervalues->associated_file; ?>"><?php echo $innervalues->file_name; ?></a></td>
																	<td><a href="#"><?php echo $innervalues->created_on; ?></a></td>
																	<td>&nbsp;</td>
																</tr>
														<?php
															}
														?>
														
													</table>
												</div>
											</div>
										</div>
								<?php 
										$innerflag++;
									}
								}
								?>
								
								<!-- /.tab-pane -->
							</div>
							
							<!-- /.tab-content -->
						</div>
						
						<!-- nav-tabs-custom -->
					</div>


				</div>
			</div>
		</div>
	</section>
<!-- Main content -->
	
</div>
@endsection
