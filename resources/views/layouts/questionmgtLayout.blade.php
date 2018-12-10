<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Velocity App</title>

      <!-- Bootstrap 3.3.6 -->
      <link rel="stylesheet" href="{{ asset('bower_components/adminlte/bootstrap/css/bootstrap.min.css') }}">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      
      <!-- DataTables -->
      <link rel="stylesheet" href="{{ asset('bower_components/adminlte/plugins/datatables/dataTables.bootstrap.css') }}">  
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" />     
      
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('bower_components/adminlte/dist/css/AdminLTE.min.css') }}">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="{{ asset('bower_components/adminlte/dist/css/skins/_all-skins.min.css') }}">
      <!-- iCheck -->
      <link rel="stylesheet" href="{{ asset('bower_components/adminlte/plugins/iCheck/flat/blue.css') }}">
      <!-- Morris chart -->
      <link rel="stylesheet" href="{{ asset('bower_components/adminlte/plugins/morris/morris.css') }}">
      <!-- jvectormap -->
      <link rel="stylesheet" href="{{ asset('bower_components/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
      <!-- Date Picker -->
      <link rel="stylesheet" href="{{ asset('bower_components/adminlte/plugins/datepicker/datepicker3.css') }}">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{ asset('bower_components/adminlte/plugins/daterangepicker/daterangepicker.css') }}">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="{{ asset('bower_components/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
	  <!-- iCheck -->
	  <link rel="stylesheet" href="{{ asset('bower_components/adminlte/plugins/iCheck/square/blue.css') }}">  
	  
	  <!-- iCheck -->
	  <link rel="stylesheet" href="{{ asset('bower_components/adminlte/plugins/iCheck/square/yellow.css') }}"> 	  
	      
      <!-- Custom style -->
      {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
      <!-- Bootstrap -->
      {{-- <link rel="stylesheet" type="text/css" href="{{ asset('library/bootstrap-3.3.7/dist/css/bootstrap.min.css') }}"> --}}
      <!-- Toastr -->
      <link rel="sytlesheet" href="{{ asset('library/toastr/toastr.min.css"') }}" />
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="{{ asset('library/bootstrap-table-master/dist/bootstrap-table.min.css') }}">

      @yield('additional_css')
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->    
    
</head>


@if (Session::has('username'))
<body class="hold-transition skin-green sidebar-mini" >
@else
<body class="hold-transition login-page" >
@endif

<div class="wrapper">

@if (Session::has('username'))

@include('header')
  
@else
		
@endif	

@yield('content')
    

<!-- /.content-wrapper -->
@if(Session::has('username'))
<footer class="main-footer">
<strong>Copyright &copy; 2018 Velocity Admin .</strong> All rights reserved.
</footer>
@else

@endif
  
 
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->	
    
<!-- jQuery 2.2.3 -->
<script src="{{ asset('bower_components/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('bower_components/adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('bower_components/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
@if($adminuser)

@if($adminuser == 'student')
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-yellow',
      radioClass: 'iradio_square-yellow',
      increaseArea: '20%' // optional
    });
  });
</script>  
@else
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script> 
@endif 

@endif 

<script src="{{ asset('bower_components/adminlte/plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('bower_components/adminlte/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('bower_components/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('bower_components/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('bower_components/adminlte/plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('bower_components/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('bower_components/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('bower_components/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('bower_components/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('js/custom.js') }}"></script>  --}}
<script>
  $(document).ready(function() {
    //Date picker
    $('#validity').datepicker({
      format: 'yyyy-mm-dd',  
      autoclose: true
    });  
    
    $('input[type="file"]').on('change', function () {
        //get the file name
        var fileName = $(this).val();
        //alert(fileName);
        //replace the "Choose a file" label
        $('#FileNameShow').val(fileName);    	
    });
    
    // On select country for city ...
    $('#country_id').on('change', function () {
    	var country_id = $('#country_id').val();
    	//alert(country_id);
        if(country_id) {
            $.ajax({
                url: '{{ URL::to('/') }}'+'/cityselect/'+country_id,
                type: "GET",
                dataType: "json",
                success:function(data) {
                	console.log(data);
                    $('select[name="city_id"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="city_id"]').append('<option value="'+ value.city_id +'">'+ value.city +'</option>');
                    });
                }
            });
        }
        else{
            $('select[name="city_id"]').empty();
        } 
    });
      
  });  

  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

// till here document.ready working
</script>

@if(Request::is('surveytypeadd'))
<script>
$(document).ready(function () {
    $('#survey_name').on('focusout', function() { 
        var survey_name = $('#survey_name').val();
        if(survey_name != ' '){ 
           var get_name_srray  = survey_name.split(' ');
            //alert(get_name_srray[0]);
           var slug_value = ''; 
           $.each(get_name_srray,function(i){
                //alert(this);
                if(slug_value == '')
                    slug_value = this;
                else
                    slug_value = slug_value + "-" + this;    
           }); 
           //alert(slug_value);
           $('#survey_slug').val(slug_value);
           $('#survey_slug').prop('readonly',true); 
        }        
    });
});
</script>
@elseif(Request::is('jobtypeadd'))
<script>
$(document).ready(function () {
    $('#jobtype_name').on('focusout', function() { 
        var jobtype_name = $('#jobtype_name').val();
        
        if(jobtype_name != ' '){ 
           var get_name_srray  = jobtype_name.split(' ');
            //alert(get_name_srray[0]);
           var slug_value = ''; 
           $.each(get_name_srray,function(i){
                //alert(this);
                if(slug_value == '')
                    slug_value = this;
                else
                    slug_value = slug_value + "-" + this;    
           }); 
           //alert(slug_value);
           $('#jobtype_slug').val(slug_value);
           $('#jobtype_slug').prop('readonly',true); 
        }        
    });
});
</script>

@elseif(Route::is('jobtypeedit'))
<script>
$(document).ready(function () {
    $('#jobtype_slug').prop('readonly',true);
    
    $('#jobtype_name').on('focusout', function() { 
        var jobtype_name = $('#jobtype_name').val();
        
        //alert("hi");
        
        if(jobtype_name != ' '){ 
           var get_name_srray  = jobtype_name.split(' ');
            //alert(get_name_srray[0]);
           var slug_value = ''; 
           $.each(get_name_srray,function(i){
                //alert(this);
                if(slug_value == '')
                    slug_value = this;
                else
                    slug_value = slug_value + "-" + this;    
           }); 
           //alert(slug_value);
           $('#jobtype_slug').val(slug_value);
        }        
    });
});
</script>


@else

@endif



<!-- Slimscroll -->
<script src="{{ asset('bower_components/adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/adminlte/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('bower_components/adminlte/dist/js/app.min.js') }}"></script>

{{-- till here document.ready runs good --}}

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('bower_components/adminlte/dist/js/pages/dashboard.js') }}"></script> --}}


{{-- <script>
$(document).ready(function () {
    alert('ssss');
});
</script> --}}


<!-- AdminLTE for demo purposes -->
<script src="{{ asset('bower_components/adminlte/dist/js/demo.js') }}"></script> 
<!-- Custom JS -->

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('bower_components/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- CK Editor -->
<script src="{{ asset('bower_components/adminlte/plugins/ckeditor/ckeditor.js') }}"></script>

{{-- document ready not good from above --}}

{{-- <script>
CKEDITOR.replace('survey_question');	
</script> --}}
<script>
//   $(function () {
//     // Replace the <textarea id="editor1"> with a CKEditor
//     // instance, using default configuration.
//     //CKEDITOR.replace('description');
//     //CKEDITOR.replace('dimension_details');
//     //bootstrap WYSIHTML5 - text editor
//    $(".textarea1").wysihtml5();
// 	//CKEDITOR.replace('survey_question');
//   });
  
//     $(function () {
//     // Replace the <textarea id="editor1"> with a CKEditor
//     // instance, using default configuration.
//     CKEDITOR.replace('dimension_details');
//   });
</script>

<!-- Latest compiled and minified JavaScript -->
<script src="{{ asset('library/bootstrap-table-master/dist/bootstrap-table.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('library/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('library/jquery-validation-1.14.0/dist/jquery.validate.min.js') }}"></script>

@yield('additional_js')

   
    
</body>
</html>
