@extends('layouts.app')

@section('content')

<?php 
//dd($adminuser[0]['username']); 
?>

<!-- {{ print_r($adminuser) }} -->

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
    
    <div class="login-box-body">
        <form method="POST" action="{{ route('authenticate') }}">
            {{ csrf_field() }}
            
            <div class="form-group has-feedback">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form-group has-feedback">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="row">
                <div class="col-xs-8">
					<div class="checkbox icheckbox">
						<input type="checkbox"/>
						<label>Remember Me</label>
					</div>                
                </div>
                <div class="col-xs-4">
					@if($adminuser == 'student')
					<input  type="hidden" name="student_mode" id="student_mode" value="1"/>
					@else
					<input  type="hidden" name="student_mode" id="student_mode" value="0"/>
					@endif                
                    <button type="submit" class="btn btn-success btn-block">Log In</button>    
                </div>
            </div>                        
        </form>
		<p>
		<a href="#" data-toggle="modal" data-target="#exampleModal">Lost password?</a>&nbsp;
		@if($adminuser == 'student')
		<a href="{{ route('studentregister') }}">Register a new membership</a>
		@endif 
		</p>  	
    </div>
    
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Restore Password</h4>
      </div>
      
      <form method="POST" action="{{ route('resetpassword') }}">
      {{ csrf_field() }}
      
	      <div class="modal-body">
	          <div class="form-group">
	            <label for="recipient-name" class="control-label">Enter Register Email:</label>
	            <input type="email" name="email" class="form-control" id="recipient-name">
	          </div>
	      </div>
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        @if($adminuser == 'student')
	        <input type="hidden" name="is_student" id="is_student" value="1" />
	        @else
	        <input type="hidden" name="is_student" id="is_student" value="0" />
	        @endif
	        <button type="submit" class="btn btn-primary">Get Password</button>
	      </div>
      </form>
       
    </div>
  </div>
</div>


@endsection
