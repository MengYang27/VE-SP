@extends('layouts.app')

@section('content')

<style>
.form-horizontal .form-group {
    margin-right: -15px;
    margin-left: 0px;
}	
</style>

<?php
if($adminuser == 'student') {
?>
<style>
.btn-success {
    background-color: #ffd700;
}

.btn-success:hover {
    background-color: #ffd700;
}

.btn-success:after {
    background-color: #ffd700;
}

.btn-success:active {
    background-color: #ffd700;
}

.box.box-solid.box-success > .box-header {
    color: #fff;
    background: #FFD700;
    background-color: rgb(255, 215, 0);
    background-color: #FFD700;
}

</style>
<?php
}
?>

<div class="login-box">
    <div class="login-logo">
    	<!-- <img src="{{URL::asset('/images/logo.png')}}" alt="" height="200" /> -->
    	@if($adminuser == 'student')
    		<a href="javascript:void(0)"><b>Velocity</b> English</a>
    	@else
			<a href="javascript:void(0)"><b>Velocity</b> Administrator</a>
		@endif
    </div>
  <!-- /.login-logo -->
  
    @if ($error = $errors->first('password'))
      <div class="alert alert-danger">
        {{ $error }}
      </div>
    @endif 

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

    <div class="login-box-body" style="padding: 20px;">
    	<p class="login-box-msg">Register a new membership</p>
    	 
        <form class="form-horizontal" method="POST" action="{{ route('studentregister') }}">
            {{ csrf_field() }}

            <div class="form-group col-md-12 has-feedback {{ $errors->has('first_name') ? ' has-error' : '' }}">
            	
                <input id="name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" required autofocus>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
				
                @if ($errors->has('first_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
            </div>
			
            <div class="form-group col-md-12 has-feedback {{ $errors->has('last_name') ? ' has-error' : '' }}">
            	
                <input id="name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" required autofocus>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
				
                @if ($errors->has('last_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
            </div>


            <div class="form-group col-md-12 has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">

				<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" required>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				
				@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif

            </div>

            <div class="form-group col-md-12 has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">

				<input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				
				@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif

            </div>

            <div class="form-group col-md-12 has-feedback">
                <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
				<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>

			<div class="form-group col-md-12 has-feedback">
				<select name="country_id" id="country_id" class="form-control">
				<option value="">Choose Country</option>
				<?php
				foreach($country_list as $country_val)
				{
				?>
					<option value="<?php echo $country_val->country_id; ?>" <?php if(!empty($user_array['country_id']) && $user_array['country_id'] == $country_val->country_id) echo "selected"; ?> ><?php echo $country_val->country; ?></option>
				<?php
				}
				?>
				</select>
			  
			</div>                       
				
			<div class="form-group col-md-12 has-feedback">
				<select name="city_id" id="city_id" class="form-control">
				<option value="">Choose City</option>
				<?php
				foreach($cities as $city_val)
				{
				?>
					<option value="<?php echo $city_val->city_id; ?>" <?php if(!empty($user_array['city_id']) && $user_array['city_id'] == $city_val->city_id) echo "selected"; ?> ><?php echo $city_val->city; ?></option>
				<?php
				}
				?>
				</select>
			</div> 
			
            <div class="form-group col-md-12 has-feedback {{ $errors->has('phone') ? ' has-error' : '' }}">
            	
                <input id="name" type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone Number" required autofocus>
				<span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
				
                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>			
			
			
			<div class="row">
				<div class="col-xs-8">
				  <div class="checkbox icheck">
					<label>
					  <input type="checkbox"> I agree to the <a href="#">terms</a>
					</label>
				  </div>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
				  <button type="submit" class="btn btn-success btn-block btn-flat">Register</button>
				</div>
				<!-- /.col -->
			</div>			
			
        </form>
		
		<p>
			<a href="{{ route('studentlogin') }}" class="text-center">I already have a membership</a>
		</p>
    </div>
                
                
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@endsection
