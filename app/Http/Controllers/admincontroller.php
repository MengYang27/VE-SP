<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

use Illuminate\Routing\UrlGenerator;

//use App\adminuser;
use DB;
use Session;
use Input;

//use Illuminate\Database\Eloquent\Collection;
use Mail;
use App\Mail\MyTestEmail;
use App\Mail\ResetPassword;

class admincontroller extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;
		
        return view('auth/login', $data);        
    }
    
    public function studentLogin(Request $request)
    {
		$data['adminuser'] 			= 'student';
		$data['has_student_css'] 	= 1;
		
        return view('auth/login', $data);        
    } 
    
    public function studentReg(Request $request)
    {
		$data['adminuser'] 			= 'student';
		$data['has_student_css'] 	= 1; 
		 
        $data['country_list'] 		= DB::table('velocity_country')->get();
        $data['cities'] 			= DB::table('velocity_city')->get();
        $data['departments'] 		= DB::table('velocity_department')->get();
        
        if($request->first_name) 
        { 
            $insert_data['password']    	= $request->password;
            $insert_data['email']       	= $request->email;
            $insert_data['phone']       	= $request->phone;
            $insert_data['role_id']     	= 3;
            $insert_data['country_id']     	= $request->country_id;
            $insert_data['city_id']     	= $request->city_id;
            $insert_data['first_name']  	= $request->first_name;
            $insert_data['last_name']   	= $request->last_name; 		
			
			$insertData = DB::table('velocity_user_master')->insert($insert_data);
			
			if(!empty($insertData)){
				$this->myTestMail($request->email, $request->first_name);
				return redirect('/studentregister')->with('message', 'Registration done successfully ...');
			}
			else
				return redirect('/studentregister')->with('message', 'Error occured during registration process !!!');	
		}	        	

		return view('auth/register', $data); 
	}
	
	public function resetPassword(Request $request)
	{
		$data['adminuser'] 			= 'student';
		$data['has_student_css'] 	= 1; 
				
		$email 				= $request->email;
		$is_student			= $request->is_student;
		
		if($is_student == 1)
			$get_user_details 	= DB::table('velocity_user_master')->where('email', $email)->first();
		else
			$get_user_details 	= DB::table('adminmaster')->where('email', $email)->first();	
		
		if(!empty($get_user_details))
		{
			if($is_student == 1)
				$this->resetPassEmail($get_user_details->email, $get_user_details->first_name, $get_user_details->password);
			else
				$this->resetPassEmail($get_user_details->email, $get_user_details->name, $get_user_details->password);	
				
        	// if Auth::attempt fails (wrong credentials) create a new message bag instance ...
            $errors = new MessageBag(['password' => ['Password has been sent in the registered email.']]); 
            
            if($is_student == 1)
            	return redirect('studentlogin')->withErrors($errors)->withInput(Input::except('password'));	
            else
            	return redirect('admin')->withErrors($errors)->withInput(Input::except('password'));				
		}
		else
		{
            $errors = new MessageBag(['password' => ['Given email address is not registered with us.']]); 
            if($is_student == 1)
            	return redirect('studentlogin')->withErrors($errors)->withInput(Input::except('password'));	
            else
            	return redirect('admin')->withErrors($errors)->withInput(Input::except('password'));			
		}
		
	}   

    
    // Function to test email 
    public function myTestMail($myEmail, $myName)
    {
    	$myEmail = $myEmail;
    	
    	$emailData['subject'] = 'Registration Confirmation';
    	$emailData['customername'] = $myName;
    	
    	Mail::to($myEmail)->send(new MyTestEmail($emailData));
    	
    	//dd("Mail Send Successfully");
    }
    
    
    // Function to test email 
    public function resetPassEmail($myEmail, $myName, $password)
    {
    	$myEmail = $myEmail;
    	
    	$emailData['subject'] 		= 'Get Lost Password';
    	$emailData['customername'] 	= $myName;
    	$emailData['cust_password'] = $password;
    	
    	Mail::to($myEmail)->send(new ResetPassword($emailData));
    }      


    
    
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $email_id       = $request->email;
        $password       = $request->password;
        $student_mode	= $request->student_mode;
        
        if(empty($student_mode))
        {
        	$authadminusers = DB::table('adminmaster')->get();
        	$user           = DB::table('adminmaster')->where('email', $email_id)->where('password', $password)->get()->first();		}
		else
		{
        	$authadminusers = DB::table('velocity_user_master')->get();
        	$user           = DB::table('velocity_user_master')
        						->where('email', $email_id)
        						->where('status', 'Y')
        						->where('password', $password)
        						->where('role_id', 3)->get()->first();		
        }

        if(!empty($user))
        {
            Session::put('username', $email_id);
            Session::put('email', $email_id);
            
            if(empty($student_mode))
            	Session::put('userId', $user->id);
            else
            	Session::put('userId', $user->user_id);
            
            if(empty($student_mode))
            	return redirect('home');
            else
            	return redirect('studentboard');	
        }
        else
        {
        	// if Auth::attempt fails (wrong credentials) create a new message bag instance ...
            $errors = new MessageBag(['password' => ['Email and/or password invalid.']]); 
            
            if(empty($student_mode))
            	return redirect('admin')->withErrors($errors)->withInput(Input::except('password'));
            else
            	return redirect('studentlogin')->withErrors($errors)->withInput(Input::except('password'));	
        }
        
        $request->session()->get('username');
    }
    
    /**
	* Controller for dashboard 
	* section and its data ...
	*/ 
	public function showDashboard()
	{
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;
				
		$data['show_total_orders'] 		= DB::table('velocity_order_master')
											->where('velocity_order_master.status', 'Y')
											->get()->count();
												
		$data['show_total_materials'] 	= DB::table('velocity_material_master')
											->get()->count();
											
		$data['show_total_classes'] 	= DB::table('velocity_class_master')
											->where('velocity_class_master.status', 'Y')
											->get()->count();
											
		$data['show_total_students'] 	= DB::table('velocity_user_master')
											->where('velocity_user_master.status', 'Y')
											->where('velocity_user_master.role_id', 3)
											->get()->count();
		
		return view('home', $data);
	}
	
	public function showStudentDashboard(Request $request)
	{
		$data['adminuser'] 			= 'student';
		$data['has_student_css'] 	= 1;
		
        $user_array = 	DB::table('velocity_order_master')
        				->leftJoin('velocity_user_master', 'velocity_order_master.student_id', '=', 'velocity_user_master.user_id')
        				->leftJoin('velocity_packages', 'velocity_order_master.package_id', '=', 'velocity_packages.package_id')
        				->leftJoin('velocity_class_master', 'velocity_order_master.class_id', '=', 'velocity_class_master.class_id')
        				->where('velocity_order_master.student_id', $request->session()->get('userId'))
        				->select('velocity_order_master.*', 'velocity_user_master.first_name', 'velocity_user_master.last_name', 'velocity_packages.package_name', 'velocity_class_master.class_title')
        				->get();
        				
        				//echo $request->session()->get('userId');
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['user_array']     = $user_finaldet_array;		

		return view('studentboard', $data);
	}
	
	public function showStudentProfile(Request $request)
	{
		$data['adminuser'] 			= 'student';
		$data['has_student_css'] 	= 1;
		
        $data['country_list'] 	= DB::table('velocity_country')->get();
        $data['cities'] 		= DB::table('velocity_city')->get();		
		
		$userid					= $request->session()->get('userId');
		
        if(!empty($userid)) {
			$data_details		= DB::table('velocity_user_master')->where('velocity_user_master.user_id', $userid)->first();
			$data['user_array'] = (array)$data_details;
		}	
        else
           $data['user_array']  = '';		

		return view('profile', $data);
	}		
	
	public function updateProfile(Request $request)
	{
        $insert_data['phone']       	= $request->phone;
        $insert_data['role_id']     	= 3;
        $insert_data['country_id']     	= $request->country_id;
        $insert_data['city_id']     	= $request->city_id;
        $insert_data['first_name']  	= $request->first_name;
        $insert_data['last_name']   	= $request->last_name; 
        $userid                     	= $request->session()->get('userId');

        $insertData = DB::table('velocity_user_master')->where('user_id', $userid)->update($insert_data);
        
        if(!empty($insertData))
            return redirect('/studentboard')->with('message', 'Data Update Successfully ...');
        else
            return redirect('/studentboard')->with('message', 'Error occured during data process !!!');  
    }
    
    public function studentCourse(Request $request)
	{
		$data['adminuser'] 			= 'student';
		$data['has_student_css'] 	= 1;
        $data['package_list'] 		= DB::table('velocity_packages')->where('status','Y')->get();
        $data['class_list'] 		= DB::table('velocity_class_master')->where('status','Y')->get();
           
        if($request->package_id) 
        { 
        	$current_date_time				= date("Y-m-d H:i:s");
            $insert_data['package_id']      = $request->package_id;
            $insert_data['class_id']      	= $request->class_id;
            $insert_data['valid_upto']  	= date("Y-m-d H:i:s", strtotime($current_date_time. " +90 days"));
            $insert_data['student_id']      = $request->session()->get('userId');
            $insert_data['payment_methods'] = $request->payment_methods;
            $insert_data['know_about']     	= $request->know_about;
            $insert_data['student_goal']    = $request->student_goal;
            $insert_data['status']    		= 'NA';
            $insert_data['payment_status']  = 'pending';
            
            $insertData = DB::table('velocity_order_master')->insert($insert_data);
            
            if(!empty($insertData))
                return redirect('/studentcourse')->with('message', 'Order has been placed Successfully ...');
            else
                return redirect('/studentcourse')->with('message', 'Error occured during data process !!!');             
        }
        else {
            
        }           
        return view('course', $data); 				
		
	}
	
	public function showStudentOrders(Request $request)
	{
		$data['adminuser'] 			= 'student';
		$data['has_student_css'] 	= 1;
		    	
        $user_array = 	DB::table('velocity_order_master')
        				->leftJoin('velocity_user_master', 'velocity_order_master.student_id', '=', 'velocity_user_master.user_id')
        				->leftJoin('velocity_packages', 'velocity_order_master.package_id', '=', 'velocity_packages.package_id')
        				->leftJoin('velocity_class_master', 'velocity_order_master.class_id', '=', 'velocity_class_master.class_id')
        				->where('velocity_order_master.student_id', $request->session()->get('userId'))
        				->select('velocity_order_master.*', 'velocity_user_master.first_name', 'velocity_user_master.last_name', 'velocity_packages.package_name', 'velocity_class_master.class_title')
        				->get();
        				
        				//echo $request->session()->get('userId');
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['user_array']     = $user_finaldet_array;
        
        return view('orders', $data);		
	}
	
    
    /**
	* Controller for settings options
	* for the system
	*/
	public function doSettings(Request $request)
	{
		$data						= array();
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;
				
		$settings_data 	= DB::table('velocity_settings')->get();
		$settings_array = array();
		
			
		foreach($settings_data as $settings_value)
		{
			$settings_array[$settings_value->settings_name] = $settings_value->settings_value;
		}
		$data['settings_array'] = $settings_array; 
		
        if($request->frmSubmit) 
        {

            if(Input::hasFile('company_logo'))
            {
                $file = Input::file('company_logo');
                $file_original = $file->getClientOriginalName();
                $fret = $file->move('companyinfo', $file_original);
                
                $image_data['settings_name'] 	= 'company_logo';
                $image_data['settings_value'] 	= $file_original;
                
                $get_image_data = DB::table('velocity_settings')->where('settings_name', 'company_logo')->first();
                
                if(!empty($get_image_data->settings_id))
                	$insertImgData 	= DB::table('velocity_settings')->where('settings_id', $get_image_data->settings_id)->update($image_data);
                else
                   $insertImgData 	= DB::table('velocity_settings')->insert($image_data);   	
           
            } 
       	
        	unset($_POST['company_logo']);  
        	unset($_POST['_token']);
        	unset($_POST['submit']);

        	//echo '<pre>'; print_r($_POST); echo '</pre>';
        	
        	foreach($_POST as $key=>$innser_value)
        	{
				$update_data['settings_name'] 	= $key;
				$update_data['settings_value'] 	= $innser_value;
				
				//echo $key."=>".$innser_value;
				
				//exit();
				        		
				$get_image_data_inner = DB::table('velocity_settings')->where('settings_name', $key)->first();

                if(!empty($get_image_data_inner->settings_id))
                	$insertData 	= DB::table('velocity_settings')->where('settings_id', $get_image_data_inner->settings_id)->update($update_data);
                else
                   $insertData 	= DB::table('velocity_settings')->insert($update_data); 				
			}
        	
            if(!empty($insertData) || !empty($insertImgData))
                return redirect('/settings')->with('message', 'Data Update Successfully ...');
            else
                return redirect('/settings')->with('message', 'Error occured during data process !!!');  
		}		
		return view('settings', $data);
	}    
    
    
    
    
    // Function to Call same function as API ....
    public function authenticateService(Request $request)
    {
        $email_id       = $request->email;
        $password       = $request->password;
        $datetimestamp  = $request->datetimestamp;
        
        $authadminusers = DB::connection('mongodb')->collection('userMaster')->get();
        $user           = DB::connection('mongodb')->collection('userMaster')->where('email', $email_id)->where('password', $password)->get()->first();
        $user_id        = (string)$user['_id'];
        
        $get_current_score_array = DB::connection('mongodb')->collection('surveyResults')->where('user_id', $user_id)->get()->first();
        
        if($get_current_score_array['total_score'])
            $redirect_to_survey = 0;
        else
            $redirect_to_survey = 1;
        
        if(!empty($user))
        {
            $get_logout_time    = DB::connection('mongodb')->collection('login_logout_log')->where('user_id', $user_id)->orderBy('datetimestamp','desc')->get()->first();
            
            
            
            if(!empty($get_logout_time))
            {
                $last_logout_time   = $get_logout_time['datetimestamp'];

                $get_notifications  = DB::connection('mongodb')->collection('awarded_job_messages')->where('to_id', $user_id)->orWhere('from_id', $user_id)->where('datetimestamp', '<', $datetimestamp)->where('datetimestamp', '>', $last_logout_time)->get();
                
                //echo '<pre>'; print_r($get_notifications); echo '</pre>'; exit();

                $total_number_of_notification = count($get_notifications);                
            }
            else
            {
                $total_number_of_notification = 0;
            }

            //echo $user['_id'];
            Session::put('username', $user['username']);
            Session::put('email', $email_id);
            Session::put('userId', $user['_id']);
            //return redirect('home');
            $userDetails_array = array( 'error_code'    => 0, 
                                        'msg'           => 'Successfully Logged In', 
                                        'username'      => $user['username'], 
                                        'email'         => $email_id, 
                                        'userId'        => $user_id,
                                        'notifications' => $total_number_of_notification, 
                                        'redirect_to_survey' => $redirect_to_survey
                                      );
            return response()->json($userDetails_array, 200);                          
        }
        else
        {
            //$errors = new MessageBag(['password' => ['Email and/or password invalid.']]); // if Auth::attempt fails (wrong credentials) create a new message bag instance.
            $errors = 'Email and/or password invalid';
            $userDetails_array = array('error_code'=>1, 'msg'=>$errors);
            return response()->json($userDetails_array, 200);            
            //return redirect('login')->withErrors($errors)->withInput(Input::except('password'));
        }
        //$request->session()->get('username');
    }
    
    public function logoutApi(Request $request)
    {
        $insert_data['datetimestamp'] = $request->datetimestamp;
        $insert_data['user_id']       = $request->user_id;

        $insertLogData = DB::connection('mongodb')->collection('login_logout_log')->insert($insert_data);
        
        //$request->session()->flush();
        //$request->session()->regenerate();

        $message = 'Logged out from system successfully !!!';
        $userDetails_array = array('error_code'=>0, 'msg'=>$message);
        return response()->json($userDetails_array, 200);        
    }
    

     /**
     * Handle an logout attempt.
     *
     * @return Response
     */
       
     public function logout(Request $request)
     {
        //$this->guard()->logout();
        $student_logout_mode = $request->student_logout_mode;

        $request->session()->flush();
        $request->session()->regenerate();
        
        if(empty($student_logout_mode))
        	return redirect('/admin'); 
        else
        	return redirect('/studentlogin'); 	       
     }
     

    /*
     * Update password 
     * for registered user
     * API ...
     */
    public function updatePasswordApi(Request $request)
    {
        $user_id = $request->user_id;
        $newpass = $request->password;

        $user_array  = DB::connection('mongodb')->collection('userMaster')->where('_id', $user_id)->get()->first();
        
        $insert_data['username']    = $user_array['username'];
        $insert_data['password']    = $newpass;
        $insert_data['email']       = $user_array['email'];
        $insert_data['phone']       = $user_array['phone'];
        $insert_data['address']     = $user_array['address'];
        $insert_data['zipcode']     = $user_array['zipcode'];
        $insert_data['first_name']  = $user_array['first_name'];
        $insert_data['last_name']   = $user_array['last_name'];             
        $insert_data['role']        = $user_array['role'];
        $insert_data['userstatus']  = $user_array['role'];
        
        $userid                     = $user_id;      
        $insertData = DB::connection('mongodb')->collection('userMaster')->where('_id', $userid)->update($insert_data, ['upsert' => true]); 
        
        if(!empty($insertData)) {
            $response_data = array('error_code'=>0, 'success_msg'=>'Password updated Successfully', 'userid'=>$userid);
            return response()->json($response_data, 200);
        }
        else{
            $errors = 'Error occurs during registration process';
            $response_data = array('error_code'=>1, 'msg'=>$errors);
            return response()->json($response_data, 200);
        }        
    }
    
    
    // --------- End of the code -------- //
    
    /*
     * Api call for user registration
     * */

    public function userRegistrationApi($id = NULL, Request $request)
    {
                $data['user_array']  = DB::connection('mongodb')->collection('userMaster')->where('email', $request->email)->get()->first();
                if(empty($data['user_array']))
                {
	            $insert_data['username']        = $request->email;
	            $insert_data['password']        = $request->password;
	            $insert_data['email']           = $request->email;
                $insert_data['phone']           = $request->phone;
	            $insert_data['address']         = $request->address;
	            $insert_data['zipcode']         = $request->zipcode;
	            $insert_data['role']            = 2;
	            $insert_data['userstatus']      = 'Y';
	            $insert_data['user_type']       = '';
                $insert_data['first_name']      = $request->first_name;
                $insert_data['last_name']       = $request->last_name;
                $insert_data['payment_status']  = 0;
                    
	            //$insert_data['full_name']   = $request->full_name;
	            //$insertData = DB::connection('mongodb')->collection('userMaster')->insert($insert_data);

	            $insertData = DB::connection('mongodb')->collection('userMaster')->insertGetId($insert_data);
	            $userid    = $insertData;

	            if(!empty($insertData)) {
	            	$this->myTestMail($request->email, $request->full_name);
	                $response_data = array('error_code'=>0, 'success_msg'=>'User created Successfully', 'userid'=>$userid);
	                return response()->json($response_data, 200);
	            }
	            else{
	                $errors = 'Error occurs during registration process';
	                $response_data = array('error_code'=>1, 'msg'=>$errors);
	                return response()->json($response_data, 200);
	            }

                }
                else {
                $errors = 'Same email id already exists in the system';
                $response_data = array('error_code'=>1, 'msg'=>$errors);
                return response()->json($response_data, 200);				
                }
       // return view('useradd', $data);
    }
    //------ End of the code --------//


    /**
     * 
     * @param type $search_string
     * @return type
     */
     public function viewInvitation(Request $request)
     {
         $viewFlag  = 'jobseeker';
         $userid    = $request->userid;
         //$jobid     = $request->jobid;
         
         if($viewFlag == 'jobposter')
         {
             $user_array  = DB::connection('mongodb')->collection('jobInvitations')->where('jobposter', $userid)->where('jobid', $jobid)->get();
             $final_array = array();
             
             $counter = 0;
             foreach($user_array as $values)
             {
                $get_user_deails = DB::connection('mongodb')->collection('userMaster')->where('_id', $values['invite'])->get()->first();
                $final_array[$counter]['invitee_details']   = $get_user_deails;
                $final_array[$counter]['job_details']       = '';
                $counter++;
             }
         }
         else 
         {
             $user_array  = DB::connection('mongodb')->collection('jobInvitations')->where('invite', $userid)->get();             
         }
         
        if(!empty($user_array[0]))
        {
             $final_array = array();
             $counter = 0;
             
             foreach($user_array as $values)
             {
                $get_user_deails = DB::connection('mongodb')->collection('userMaster')->where('_id', $values['jobposter'])->get()->first();
                unset($get_user_deails['password']);
                unset($get_user_deails['username']);
                unset($get_user_deails['email']);
                unset($get_user_deails['phone']);
                unset($get_user_deails['address']);
                unset($get_user_deails['zipcode']);
                unset($get_user_deails['role']);
                
                $get_job_details = DB::connection('mongodb')->collection('jobs')->where('_id', $values['jobid'])->get()->first();;
                
                $final_array[$counter]['invitee_details']   = $get_user_deails;
                $final_array[$counter]['job_details']       = $get_job_details;
                $counter++;
             }            
            
            $response_data = array('error_code'=>0, 'details_array'=>$final_array);
            return response()->json($response_data, 200);                    
        }
        else 
        {
            $final_array = array();
            $errors = 'No data found for invitation';
            $response_data = array('error_code'=>0, 'msg'=>$errors, 'details_array'=>$final_array);
            return response()->json($response_data, 200);                    
        }         
         
     }
    
    ## ----------- All User related methods ------------- ##
    /**
	Controller to 
	show the list of 
	add users ....
	**/
    public function userList($search_string = '')
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;
		    	
        $user_array = DB::table('velocity_user_master')->leftJoin('velocity_role_master', 'velocity_user_master.role_id', '=', 'velocity_role_master.role_id')->select('velocity_user_master.*', 'velocity_role_master.role')->get();
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['user_array']     = $user_finaldet_array;
        
        return view('usermgt', $data);
    }
	
    /**
     * Methods to add or edit survery types and show list view
     * Methods name : surveyTypeDataUpdate, surveyTypeList
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function userUpdate($id = NULL, Request $request)
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;    	
    	
        $userid = $request->route('userid');
        
        $data['roles'] 			= DB::table('velocity_role_master')->get();
        $data['country_list'] 	= DB::table('velocity_country')->get();
        $data['cities'] 		= DB::table('velocity_city')->get();
        $data['departments'] 	= DB::table('velocity_department')->get();
        
        if(!empty($userid)) {
			$data_details	= DB::table('velocity_user_master')->where('velocity_user_master.user_id', $userid)->first();
			$data['user_array'] = (array)$data_details;
		}	
        else
           $data['user_array']  = ''; 
           
        if($request->frmSubmit) 
        { 
            $insert_data['password']    	= $request->password;
            $insert_data['email']       	= $request->email;
            $insert_data['phone']       	= $request->phone;
            $insert_data['role_id']     	= $request->role_id;
            
           // $insert_data['department_id']  	= $request->department_id;
           
            $insert_data['country_id']     	= $request->country_id;
            $insert_data['city_id']     	= $request->city_id;
            $insert_data['temperature']     = $request->temperature;
            
            $get_full_name_input_arr		= explode(" ", $request->first_name);
            $insert_data['first_name']  	= $get_full_name_input_arr[0];
            $insert_data['last_name']   	= $get_full_name_input_arr[1];     
                    
            $userid                     	= !empty($request->userid) ? $request->userid : 0;

            if(!empty($userid))
            {
                $insertData = DB::table('velocity_user_master')->where('user_id', $userid)->update($insert_data);
                
                if(!empty($insertData))
                    return redirect('/usermgt')->with('message', 'Data Update Successfully ...');
                else
                    return redirect('/useredit/'.$userid)->with('message', 'Error occured during data process !!!');                            }
            else 
            {
                $insertData = DB::table('velocity_user_master')->insert($insert_data);
                if(!empty($insertData))
                    return redirect('/usermgt')->with('message', 'Data Inserted Successfully ...');
                else
                    return redirect('/useredit')->with('message', 'Error occured during data process !!!');                                 	}
        }
        else {
            
        }           
        return view('useradd', $data); 
    }
    
    public function userDelete(Request $request)
    {
        $userid   = $request->userid;
        
        $deleteTypeList_array = DB::table('velocity_user_master')->where('user_id', $userid)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/usermgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/usermgt')->with('message', 'Error occured during data process !!!'); 
    }  
    
    public function userStatusChange(Request $request)
    {
        $data_update['status'] = $request->status;
        $userid         = $request->userid;
        $updateData = DB::table('velocity_user_master')->where('user_id', $userid)->update($data_update);

        if(!empty($updateData))
            return redirect('/usermgt')->with('message', 'User status Update Successfully ...');
        else
            return redirect('/usermgt/'.$userid)->with('message', 'Error occured during data process !!!');
       
    }    
    ## ----------- All User related methods ------------- ##
    
    
    ## ----------- All order related methods ------------- ##
    /**
	Controller to 
	show the list of 
	add users ....
	**/
    public function orderList($search_string = '')
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;
		    	
        $user_array = 	DB::table('velocity_order_master')
        				->leftJoin('velocity_user_master', 'velocity_order_master.student_id', '=', 'velocity_user_master.user_id')
        				->leftJoin('velocity_packages', 'velocity_order_master.package_id', '=', 'velocity_packages.package_id')
        				->leftJoin('velocity_class_master', 'velocity_order_master.class_id', '=', 'velocity_class_master.class_id')
        				->select('velocity_order_master.*', 'velocity_user_master.first_name', 'velocity_user_master.last_name', 'velocity_packages.package_name', 'velocity_packages.package_price', 'velocity_class_master.class_title')->get();
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['user_array']     = $user_finaldet_array;
        
        return view('ordermgt', $data);
    }
	
    /**
     * Methods to add or edit survery types and show list view
     * Methods name : surveyTypeDataUpdate, surveyTypeList
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function orderUpdate($id = NULL, Request $request)
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;
		    	
        $order_id = $request->route('order_id');
        
        $data['student_list'] 		= DB::table('velocity_user_master')->where('role_id', 3)->where('status','Y')->get();
        $data['package_list'] 		= DB::table('velocity_packages')->where('status','Y')->get();
        $data['class_list'] 		= DB::table('velocity_class_master')->where('status','Y')->get();
         
        if(!empty($order_id)) {
			$data_details		= DB::table('velocity_order_master')->where('order_id', $order_id)->first();
			$data['user_array'] = (array)$data_details;
		}	
        else
           $data['user_array']  = ''; 
           
        if($request->frmSubmit) 
        { 
        	$current_date_time				= date("Y-m-d H:i:s");
            $insert_data['student_id']    	= $request->student_id;
            $insert_data['package_id']      = $request->package_id;
            $insert_data['payment_methods'] = $request->payment_methods;
            $insert_data['know_about']     	= $request->know_about;
            $insert_data['class_id']     	= $request->class_id;
            $insert_data['student_goal']    = $request->student_goal;
            $insert_data['status']    		= $request->status;
            $insert_data['payment_amount']  = $request->payment_amount;
            
            if(empty($order_id))
            	$insert_data['valid_upto']  = date("Y-m-d H:i:s", strtotime($current_date_time. " +90 days"));
            else
            	$insert_data['valid_upto']  = date("Y-m-d H:i:s", strtotime($data['user_array']['valid_upto']. " +90 days"));	
            	
            $insert_data['payment_status']  = $request->payment_status;
            $order_id                     	= !empty($request->order_id) ? $request->order_id : 0;

            if(!empty($order_id))
            {
                $insertData = DB::table('velocity_order_master')->where('order_id', $order_id)->update($insert_data);
                
                if(!empty($insertData))
                    return redirect('/ordermgt')->with('message', 'Data Update Successfully ...');
                else
                    return redirect('/orderedit/'.$order_id)->with('message', 'Error occured during data process !!!');                            }
            else 
            {
                $insertData = DB::table('velocity_order_master')->insert($insert_data);
                
                if(!empty($insertData))
                    return redirect('/ordermgt')->with('message', 'Data Inserted Successfully ...');
                else
                    return redirect('/orderedit')->with('message', 'Error occured during data process !!!');                                 	}
        }
        else {
            
        }           
        return view('orderadd', $data); 
    }
    
    public function orderDelete(Request $request)
    {
        $order_id   = $request->order_id;
        
        $deleteTypeList_array = DB::table('velocity_order_master')->where('order_id', $order_id)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/ordermgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/ordermgt')->with('message', 'Error occured during data process !!!'); 
    }  
    
    public function orderStatusChange(Request $request)
    {
        $data_update['status'] 	= $request->status;
        $order_id         		= $request->order_id;
        
        $updateData = DB::table('velocity_order_master')->where('order_id', $order_id)->update($data_update);

        if(!empty($updateData))
            return redirect('/ordermgt')->with('message', 'User status Update Successfully ...');
        else
            return redirect('/ordermgt/'.$userid)->with('message', 'Error occured during data process !!!');
       
    }    
    ## ----------- All order related methods ------------- ##    
    
    
    
    ## ----------- All User related methods ------------- ##
    /**
	Controller to 
	show the list of 
	add users ....
	**/
    public function packageList($search_string = '')
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;
		    	
        $user_array = DB::table('velocity_packages')->get();
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['user_array']     = $user_finaldet_array;
        
        return view('packagemgt', $data);
    }
	
    /**
     * Methods to add or edit survery types and show list view
     * Methods name : surveyTypeDataUpdate, surveyTypeList
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function packageUpdate($id = NULL, Request $request)
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;
		    	
        $package_id = $request->route('package_id');
        
        if(!empty($package_id)) {
			$data_details	= DB::table('velocity_packages')->where('package_id', $package_id)->first();
			$data['user_array'] = (array)$data_details;
		}	
        else
           $data['user_array']  = ''; 
           
        if($request->frmSubmit) 
        { 
            $insert_data['package_name']    = $request->package_name;
            $insert_data['package_details'] = $request->package_details;
            $insert_data['package_price']   = $request->package_price;
            $insert_data['status']  		= 'Y';
            $package_id                     = !empty($request->package_id) ? $request->package_id : 0;

            if(!empty($package_id))
            {
                $insertData = DB::table('velocity_packages')->where('package_id', $package_id)->update($insert_data);
                
                if(!empty($insertData))
                    return redirect('/packagemgt')->with('message', 'Data Update Successfully ...');
                else
                    return redirect('/packageedit/'.$package_id)->with('message', 'Error occured during data process !!!');                            }
            else 
            {
                $insertData = DB::table('velocity_packages')->insert($insert_data);
                if(!empty($insertData))
                    return redirect('/packagemgt')->with('message', 'Data Inserted Successfully ...');
                else
                    return redirect('/packageedit')->with('message', 'Error occured during data process !!!');                                 	}
        }
        else {
            
        }           
        return view('packageadd', $data); 
    }
    
    public function packageDelete(Request $request)
    {
        $package_id   = $request->package_id;
        
        $deleteTypeList_array = DB::table('velocity_packages')->where('package_id', $package_id)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/packagemgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/packagemgt')->with('message', 'Error occured during data process !!!'); 
    } 
    
    public function packageStatusChange(Request $request)
    {
        $data_update['status'] 	= $request->status;
        $package_id         	= $request->package_id;
        
        $updateData = DB::table('velocity_packages')->where('package_id', $package_id)->update($data_update);

        if(!empty($updateData))
            return redirect('/packagemgt')->with('message', 'Package status Update Successfully ...');
        else
            return redirect('/packagemgt')->with('message', 'Error occured during data process !!!');
       
    } 
           
    ## ----------- All Package related methods ------------- ##    
    
    
    ## ----------- All Role related methods ------------- ##
    /**
	Controller to 
	show the list of 
	add users ....
	**/
    public function roleList($search_string = '')
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;    	
    	
        $user_array             = DB::table('velocity_role_master')->get();
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['location_array']     = $user_finaldet_array;
        
        return view('rolelist', $data);
    }
	
    /**
     * Methods to add or edit survery types and show list view
     * Methods name : surveyTypeDataUpdate, surveyTypeList
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function roleUpdate($id = NULL, Request $request)
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;    	
    	
        $roleid = $request->route('roleid');
        
        if(!empty($roleid)) {
			$data_details			= DB::table('velocity_role_master')->where('role_id', $roleid)->first();
			$data['location_det']  	= (array)$data_details;
		}	
        else
           $data['location_det']  = ''; 
           
        if($request->frmSubmit) 
        { 
            $insert_data['role']    		= $request->role;
            $insert_data['role_slug'] 		= $request->role_slug;
            $insert_data['status']  		= 'Y';
			
            $roleid                     	= !empty($request->roleid) ? $request->roleid : 0;

            if(!empty($roleid))
            {
                $insertData = DB::table('velocity_role_master')->where('role_id', $roleid)->update($insert_data);
                
                if(!empty($insertData))
                    return redirect('/rolemgt')->with('message', 'Data Update Successfully ...');
                else
                    return redirect('/roleedit/'.$userid)->with('message', 'Error occured during data process !!!');                            }
            else 
            {
                $insertData = DB::table('velocity_role_master')->insert($insert_data);
                if(!empty($insertData))
                    return redirect('/rolemgt')->with('message', 'Data Inserted Successfully ...');
                else
                    return redirect('/roleedit')->with('message', 'Error occured during data process !!!');                                 	}
        }
        else {
            
        }           
        return view('roleadd', $data); 
    }
    
    public function roleDelete(Request $request)
    {
        $roleid   = $request->roleid;
        $deleteTypeList_array = DB::table('velocity_role_master')->where('role_id', $roleid)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/rolemgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/rolemgt')->with('message', 'Error occured during data process !!!'); 
    }
    
    public function assignPermission(Request $request)
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;    	
    	
    	$roleid   			= $request->route('roleid');
    	
    	$role_details		= DB::table('velocity_role_master')->where('role_id', $roleid)->first();
    	$all_permissions 	= DB::table('velocity_permission_master')->get();
        $final_perm_array 	= array();
        $loop_counter       = 0;
        
        foreach($all_permissions as $permission_array)
        {
            foreach($permission_array as $key=>$inner_value)
            {
                $final_perm_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['permissions'] = $final_perm_array;
        $data['role_detail'] = $role_details;        
        
        $previous_perm		 = DB::table('velocity_role_permission')->where('role_id', $roleid)->get();
        $prev_perm_array	 = array();

        foreach($previous_perm as $key=>$perminner)
        {
			$prev_perm_array[$key] = $perminner->permission_id;
		}	
       
        $data['role_id']	 = $roleid;
        $data['data_detail'] = $prev_perm_array;	


        if($request->frmSubmit) 
        {
            $all_permissions  = $request->permissions;
            $roleid           = !empty($request->roleid) ? $request->roleid : 0; 
            $delete_prev_data = DB::table('velocity_role_permission')->where('role_id', $roleid)->delete();       	
        	
        	foreach($all_permissions as $permission_inner)
        	{
				$insert_data['role_id'] 		= $roleid;
				$insert_data['permission_id'] 	= $permission_inner;
				$permission_insert[] 			= DB::table('velocity_role_permission')->insert($insert_data);
			}
			
            if(!empty($permission_insert))
                return redirect('/assignperm/'.$roleid)->with('message', 'Data Inserted Successfully ...');
            else
                return redirect('/assignperm/'.$roleid)->with('message', 'Error occured during data process !!!'); 
		}	        

       return view('permissionlist', $data); 
            	
	}    
    ## ----------- All Role related methods ------------- ##
    
    
    ## ----------- All Department related methods ------------- ##
    /**
	Controller to 
	show the list of 
	add users ....
	**/
    public function departmentList($search_string = '')
    {
        $user_array             = DB::table('velocity_department')->get();
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['location_array']     = $user_finaldet_array;
        
        return view('departmentlist', $data);
    }
	
    /**
     * Methods to add or edit survery types and show list view
     * Methods name : surveyTypeDataUpdate, surveyTypeList
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function departmentUpdate($id = NULL, Request $request)
    {
        $departmentid = $request->route('departmentid');
        
        if(!empty($departmentid)) {
			$data_details			= DB::table('velocity_department')->where('department_id', $departmentid)->first();
			$data['location_det']  	= (array)$data_details;
		}	
        else
           $data['location_det']  	= ''; 
           
        if($request->frmSubmit) 
        { 
            $insert_data['department']    		= $request->department;
            $insert_data['department_details'] 	= $request->department_details;
            $insert_data['status']  			= 'Y';
			
            $departmentid                     	= !empty($request->departmentid) ? $request->departmentid : 0;

            if(!empty($departmentid))
            {
                $insertData = DB::table('velocity_department')->where('department_id', $departmentid)->update($insert_data);
                
                if(!empty($insertData))
                    return redirect('/departmentmgt')->with('message', 'Data Update Successfully ...');
                else
                    return redirect('/departmentedit/'.$departmentid)->with('message', 'Error occured during data process !!!');                            }
            else 
            {
                $insertData = DB::table('velocity_department')->insert($insert_data);
                if(!empty($insertData))
                    return redirect('/departmentmgt')->with('message', 'Data Inserted Successfully ...');
                else
                    return redirect('/departmentedit')->with('message', 'Error occured during data process !!!');                                 	}
        }
        else {
            
        }           
        return view('departmentadd', $data); 
    }
    
    public function departmentDelete(Request $request)
    {
        $departmentid   = $request->departmentid;
        
        $deleteTypeList_array = DB::table('velocity_department')->where('department_id', $departmentid)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/departmentmgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/departmentmgt')->with('message', 'Error occured during data process !!!'); 
    }    
    ## ----------- All Department related methods ------------- ##  
    
    
    ## ----------- All notification related methods ------------- ##
    /**
	Controller to 
	show the list of 
	add users ....
	**/
    public function notificationList($search_string = '')
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;    	
    	
        $user_array             = DB::table('velocity_email_master')->get();
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['location_array']     = $user_finaldet_array;
        return view('notificationlist', $data);
    }
	
    /**
     * Methods to add or edit survery types and show list view
     * Methods name : surveyTypeDataUpdate, surveyTypeList
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function notificationUpdate($id = NULL, Request $request)
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;    	
    	
        $notificationid = $request->route('notificationid');
        
        if(!empty($notificationid)) {
			$data_details			= DB::table('velocity_email_master')->where('template_id', $notificationid)->first();
			$data['location_det']  	= (array)$data_details;
		}	
        else
           $data['location_det']  	= ''; 
           
        if($request->frmSubmit) 
        { 
            $insert_data['email_subject']    	= $request->email_subject;
            $insert_data['email_body'] 			= $request->email_body;
            $notificationid                     = !empty($request->notificationid) ? $request->notificationid : 0;

            if(!empty($notificationid))
            {
                $insertData = DB::table('velocity_email_master')->where('template_id', $notificationid)->update($insert_data);
                
                if(!empty($insertData))
                    return redirect('/notificationmgt')->with('message', 'Data Update Successfully ...');
                else
                    return redirect('/notificationedit/'.$notificationid)->with('message', 'Error occured during data process !!!');            }
            else 
            {
                $insertData = DB::table('velocity_email_master')->insert($insert_data);
                if(!empty($insertData))
                    return redirect('/notificationmgt')->with('message', 'Data Inserted Successfully ...');
                else
                    return redirect('/notificationedit')->with('message', 'Error occured during data process !!!');                                 	}
        }
        else {
            
        }           
        return view('notificationadd', $data); 
    }
    
    public function notificationDelete(Request $request)
    {
        $notificationid   = $request->notificationid;
        
        $deleteTypeList_array = DB::table('velocity_email_master')->where('template_id', $notificationid)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/notificationmgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/notificationmgt')->with('message', 'Error occured during data process !!!'); 
    }    
    ## ----------- All notification related methods ------------- ##     
    
    
    
    ## ------------ All country related methods -------------- ##
    public function countryList($search_string = '')
    {
        $user_array             = DB::table('velocity_country')->get();
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['location_array']     = $user_finaldet_array;
        
        return view('countrylist', $data);
    }
	
    public function countryUpdate($id = NULL, Request $request)
    {
        $country_id = $request->route('country_id');
        
        if(!empty($country_id)) {
			$data_details			= DB::table('velocity_country')->where('country_id', $country_id)->first();
			$data['location_det']  	= (array)$data_details;
		}	
        else
           $data['location_det']  	= ''; 
           
        if($request->frmSubmit) 
        { 
            $insert_data['country']    	 = $request->country;
            $insert_data['country_code'] = $request->country_code;
            
            $country_id                  = !empty($request->country_id) ? $request->country_id : 0;

            if(!empty($departmentid))
            {
                $insertData = DB::table('velocity_country')->where('country_id', $country_id)->update($insert_data);
                
                if(!empty($insertData))
                    return redirect('/countrymgt')->with('message', 'Data Update Successfully ...');
                else
                    return redirect('/countryedit/'.$country_id)->with('message', 'Error occured during data process !!!');                            }
            else 
            {
                $insertData = DB::table('velocity_country')->insert($insert_data);
                if(!empty($insertData))
                    return redirect('/countrymgt')->with('message', 'Data Inserted Successfully ...');
                else
                    return redirect('/countryedit')->with('message', 'Error occured during data process !!!');                                 	}
        }
        else {
            
        }           
        return view('countryadd', $data); 
    }
    
    public function countryDelete(Request $request)
    {
        $country_id   			= $request->country_id;
        $deleteTypeList_array 	= DB::table('velocity_country')->where('country_id', $country_id)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/countrymgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/countrymgt')->with('message', 'Error occured during data process !!!'); 
    }
    ## ------------ All country related methods -------------- ##
    
    ## ------------ All city related methods -------------- ##
    public function cityList($search_string = '')
    {
        $user_array             = DB::table('velocity_city')->leftJoin('velocity_country', 'velocity_city.country_id', '=', 'velocity_country.country_id')->get();
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['location_array']     = $user_finaldet_array;
        
        return view('citylist', $data);
    }
    
    public function citySelectList($country_id)
    {
		$city_list 		= DB::table('velocity_city')->where('country_id', $country_id)->get();
		$loop_counter 	= 0;
		$return_array	= array();
		
		foreach($city_list as $value)
		{
			$return_array[$loop_counter]['city_id'] = $value->city_id;
			$return_array[$loop_counter]['city'] 	= $value->city;
			
			$loop_counter++;
		}
		
		echo json_encode($return_array);
		
	}
	
    public function cityUpdate($id = NULL, Request $request)
    {
        $city_id = $request->route('city_id');
        
        $data['country_list'] = DB::table('velocity_country')->get();
        
        if(!empty($city_id)) {
			$data_details			= DB::table('velocity_city')->where('city_id', $city_id)->first();
			$data['location_det']  	= (array)$data_details;
		}	
        else
           $data['location_det']  	= ''; 
           
        if($request->frmSubmit) 
        { 
            $insert_data['city']    	= $request->city;
            $insert_data['country_id']  = $request->country_id;
            $city_id                   	= !empty($request->city_id) ? $request->city_id : 0;

			if(!empty($city_id))
			{
			    $insertData = DB::table('velocity_city')->where('city_id', $city_id)->update($insert_data);
			    
			    if(!empty($insertData))
			        return redirect('/citymgt')->with('message', 'Data Update Successfully ...');
			    else
			        return redirect('/countryedit/'.$city_id)->with('message', 'Error occured during data process !!!');               
			}
			else 
			{
			    $insertData = DB::table('velocity_city')->insert($insert_data);
			    
			    if(!empty($insertData))
			        return redirect('/citymgt')->with('message', 'Data Inserted Successfully ...');
			    else
			        return redirect('/countryedit')->with('message', 'Error occured during data process !!!');                               }
        }
        else {
            
        }           
        return view('cityadd', $data); 
    }
    
    public function cityDelete(Request $request)
    {
        $city_id   				= $request->city_id;
        $deleteTypeList_array 	= DB::table('velocity_city')->where('city_id', $city_id)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/departmentmgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/departmentmgt')->with('message', 'Error occured during data process !!!'); 
    }
    ## ------------ All city related methods -------------- ##   
    
    
    ## ------------ All course category related methods -------------- ##
    public function categoryList($search_string = '')
    {
        $user_array             = DB::table('velocity_course_category')->get();
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['location_array']     = $user_finaldet_array;
        
        return view('categorylist', $data);
    }
	
    public function categoryUpdate($id = NULL, Request $request)
    {
        $category_id = $request->route('category_id');
        
        if(!empty($category_id)) {
			$data_details			= DB::table('velocity_course_category')->where('category_id', $category_id)->first();
			$data['location_det']  	= (array)$data_details;
		}	
        else
           $data['location_det']  	= ''; 
           
        if($request->frmSubmit) 
        { 
            $insert_data['category']      = $request->category;
            $insert_data['category_code'] = $request->category_code;
            $category_id                  = !empty($request->category_id) ? $request->category_id : 0;

            if(!empty($category_id))
            {
                $insertData = DB::table('velocity_course_category')->where('category_id', $category_id)->update($insert_data);
                
                if(!empty($insertData))
                    return redirect('/categorymgt')->with('message', 'Data Update Successfully ...');
                else
                    return redirect('/categoryedit/'.$category_id)->with('message', 'Error occured during data process !!!');                            }
            else 
            {
                $insertData = DB::table('velocity_course_category')->insert($insert_data);
                if(!empty($insertData))
                    return redirect('/categorymgt')->with('message', 'Data Inserted Successfully ...');
                else
                    return redirect('/categoryedit')->with('message', 'Error occured during data process !!!');                                 	}
        }
        else {
            
        }           
        return view('categoryadd', $data); 
    }
    
    public function categoryDelete(Request $request)
    {
        $category_id   			= $request->category_id;
        $deleteTypeList_array 	= DB::table('velocity_course_category')->where('category_id', $category_id)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/categorymgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/categorymgt')->with('message', 'Error occured during data process !!!'); 
    }
    ## ------------ All course category related methods -------------- ##
    
    ## ------------ All course related methods -------------- ##
    public function courseList($search_string = '')
    {
    	
    	
        $user_array             = DB::table('velocity_course_master')->leftJoin('velocity_course_category', 'velocity_course_master.category_id', '=', 'velocity_course_category.category_id')->get();
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['location_array']     = $user_finaldet_array;
        
        return view('coursemgt', $data);
    }
	
    public function courseUpdate($id = NULL, Request $request)
    {
        $course_id = $request->route('course_id');
        
        $data['category_list'] = DB::table('velocity_course_category')->get();
        
        if(!empty($course_id)) {
			$data_details			= DB::table('velocity_course_master')->where('course_id', $course_id)->first();
			$data['user_array']  	= (array)$data_details;
		}	
        else
           $data['user_array']  	= ''; 
           
        if($request->frmSubmit) 
        { 
            $insert_data['course_name'] 	= $request->course_name;
            $insert_data['course_details'] 	= $request->course_details;
            $insert_data['course_code'] 	= $request->course_code;
            $insert_data['category_id']  	= $request->category_id;
            $course_id                   	= !empty($request->course_id) ? $request->course_id : 0;

			if(!empty($course_id))
			{
			    $insertData = DB::table('velocity_course_master')->where('course_id', $course_id)->update($insert_data);
			    
			    if(!empty($insertData))
			        return redirect('/coursemgt')->with('message', 'Data Update Successfully ...');
			    else
			        return redirect('/courseedit/'.$course_id)->with('message', 'Error occured during data process !!!');               
			}
			else 
			{
			    $insertData = DB::table('velocity_course_master')->insert($insert_data);
			    
			    if(!empty($insertData))
			        return redirect('/coursemgt')->with('message', 'Data Inserted Successfully ...');
			    else
			        return redirect('/courseedit')->with('message', 'Error occured during data process !!!');                               }
        }
        else {
            
        }           
        return view('courseadd', $data); 
    }
    
    public function courseDelete(Request $request)
    {
        $course_id   			= $request->course_id;
        $deleteTypeList_array 	= DB::table('velocity_course_master')->where('course_id', $course_id)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/coursemgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/coursemgt')->with('message', 'Error occured during data process !!!'); 
    }
    ## ------------ All course related methods -------------- ##  
    
    
    ## ------------ All class related methods -------------- ##
    public function classList($search_string = '')
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;    	
    	
        $user_array             = DB::table('velocity_class_master')->get();
        
        $user_finaldet_array = array();
        $loop_counter        = 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }
        
        $data['location_array']     = $user_finaldet_array;
        
        return view('classlist', $data);
    }
	
    public function classUpdate($id = NULL, Request $request)
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;    	
    	
        $class_id = $request->route('class_id');
        
        if(!empty($class_id)) {
			$data_details			= DB::table('velocity_class_master')->where('class_id', $class_id)->first();
			$data['location_det']  	= (array)$data_details;
		}	
        else
           $data['location_det']  	= ''; 
           
        if($request->frmSubmit) 
        { 
            $insert_data['class_title'] 	= $request->class_title;
            $insert_data['week_day'] 		= $request->week_day;
            $insert_data['class_time'] 		= $request->class_time;
            $insert_data['end_time'] 		= $request->end_time;
            $insert_data['class_details'] 	= $request->class_details;
            $class_id                  		= !empty($request->class_id) ? $request->class_id : 0;

            if(!empty($class_id))
            {
                $insertData = DB::table('velocity_class_master')->where('class_id', $class_id)->update($insert_data);
                
                if(!empty($insertData))
                    return redirect('/classmgt')->with('message', 'Data Update Successfully ...');
                else
                    return redirect('/classedit/'.$class_id)->with('message', 'Error occured during data process !!!');                            }
            else 
            {
                $insertData = DB::table('velocity_class_master')->insert($insert_data);
                
                if(!empty($insertData))
                    return redirect('/classmgt')->with('message', 'Data Inserted Successfully ...');
                else
                    return redirect('/classedit')->with('message', 'Error occured during data process !!!');                                 	}
        }
        else {
            
        }           
        return view('classadd', $data); 
    }
    
    public function classDelete(Request $request)
    {
        $class_id   			= $request->class_id;
        $deleteTypeList_array 	= DB::table('velocity_class_master')->where('class_id', $class_id)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/classmgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/classmgt')->with('message', 'Error occured during data process !!!'); 
    }

    public function classStatusChange(Request $request)
    {
        $data_update['status'] 	= $request->status;
        $class_id         		= $request->class_id;
        
        $updateData = DB::table('velocity_class_master')->where('class_id', $class_id)->update($data_update);

        if(!empty($updateData))
            return redirect('/classmgt')->with('message', 'Class status Update Successfully ...');
        else
            return redirect('/classmgt')->with('message', 'Error occured during data process !!!');
       
    }      
    
    ## ------------ All class related methods -------------- ##    
    
    
/**
 * Methods to add or edit materials and show list view
 * Methods name : materialadd, materialmgt
 */

    public function materialadd($id = NULL, Request $request)
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;    	
    	
        $materialid = $request->route('material_det_id');

        
        if(!empty($materialid))
            $get_materials_array  = DB::table('velocity_material_master')->where('material_det_id', $materialid)->first();
        else
           $get_materials_array  = '';
           
           $data['badge_array']  	= (array)$get_materials_array;
           $data['all_categories'] 	= DB::table('velocity_material_category')->get();
           
        if($request->frmSubmit) 
        { 
            $insert_data['material_name']         = $request->material_name;
            $insert_data['material_cat_id']       = $request->material_cat_id;
            $insert_data['visibility_level']      = $request->visibility_level;
            $insert_data['file_type']             = $request->file_type;
            $insert_data['file_name']      		  = $request->file_name;
                        
            $material_det_id                      = !empty($request->material_det_id) ? $request->material_det_id : 0;
            
            if(!empty($material_det_id))
            {
            	$insertData = DB::table('velocity_material_master')->where('material_det_id', $material_det_id)->update($insert_data);
                if(Input::hasFile('associated_file'))
                {
                    $file = Input::file('associated_file');
                    $file_original = $file->getClientOriginalName();
                    $fret = $file->move('materials', $file_original);
                    
                    $image_data['associated_file'] = $file_original;
                    $insertImgData = DB::table('velocity_material_master')->where('material_det_id', $material_det_id)->update($image_data);                
                }                
                
                if(!empty($insertData) || !empty($insertImgData))
                    return redirect('/materialmgt')->with('message', 'Data Update Successfully ...');
                else
                    return redirect('/materialedit/'.$badgeid)->with('message', 'Error occured during data process !!!');                    
            }
            else {
                $insertData 		= DB::table('velocity_material_master')->insertGetId($insert_data);
                $material_det_id 	= $insertData;
                
                if(Input::hasFile('associated_file'))
                {
                    $file = Input::file('associated_file');
                    $file_original = $file->getClientOriginalName();
                    $fret = $file->move('materials', $file_original);
                    
                    $image_data['associated_file'] = $file_original;
                	$insertImgData = DB::table('velocity_material_master')->where('material_det_id', $material_det_id)->update($image_data);
                    
                }                  
                
                if(!empty($insertData) || !empty($insertImgData))
                    return redirect('/materialmgt')->with('message', 'Data Inserted Successfully ...');
                else
                    return redirect('/materialedit')->with('message', 'Error occured during data process !!!');                                 }
        }
        else {
            
        }           

        return view('materialadd', $data); 
    }
    
    public function materialmgt($search_string = '')
    {
		$data['adminuser'] 			= 'admin';
		$data['has_student_css'] 	= 0;    	
    	
        $user_array             	= DB::table('velocity_material_master')->leftJoin('velocity_material_category', 'velocity_material_category.material_cat_id', '=', 'velocity_material_master.material_cat_id')->get();
        
        $user_finaldet_array 		= array();
        $loop_counter       		= 0;
        
        foreach($user_array as $user_profile_array)
        {
            foreach($user_profile_array as $key=>$inner_value)
            {
                $user_finaldet_array[$loop_counter][$key] = $inner_value;
            }
    
            $loop_counter++;
        }       
        
        
        
        $data['badge_array']     = $user_finaldet_array;
        
        return view('materiallist', $data);
    }
    
    public function materialdel(Request $request)
    {
       // $data['userstatus'] = $request->status;
        $material_det_id  = $request->material_det_id;
        
        $deleteTypeList_array = DB::table('velocity_material_master')->where('material_det_id', $material_det_id)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/materialmgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/materialmgt')->with('message', 'Error occured during data process !!!');         
     }
     
     
     public function materialStudents(Request $request)
     {
		$data['adminuser'] 				= 'student';
		$data['has_student_css'] 		= 1;
		$data['material_categories'] 	= DB::table('velocity_material_category')->get();
		
		$final_array = array();
		
		foreach($data['material_categories'] as $outerkey=>$outervals)
		{
			$final_array[$outerkey]['keyvalue'] = $outervals->material_cat_name;
			$final_array[$outerkey]['value_id'] = $outervals->material_cat_id;
			$final_array[$outerkey]['all_data'] = DB::table('velocity_material_master')
													->where('material_cat_id',$outervals->material_cat_id)->get();
		}
		
		//echo '<pre>'; print_r($final_array); echo '</pre>';
		
		$data['all_table_data'] = $final_array;
		
		return view('materials', $data);
	 	
	 } 
              
// -------------- End of the code -------------- //    
    
        
    	
    
    public function userScoreList(Request $request)
    {
        $userid   = $request->userid;
        
        $user_details_array = DB::connection('mongodb')->collection('userMaster')->where('user_id', $userid)->get()->first();
        $data['user_details_list'] = $user_details_array;
        
        $user_score_array = DB::connection('mongodb')->collection('surveyCatScore')->where('user_id', $userid)->get();
        
        $user_score_details_array = array();
        $array_loop_counter       = 0;
        
        foreach($user_score_array as $key=>$scorevalues)
        {
            foreach($scorevalues as $innerKey=>$innervalue)
            {
                $user_score_details_array[$key][$innerKey] = $innervalue;
            }
            
            $survey_team_type_arr = DB::connection('mongodb')->collection('surveyTeam')->where('personality', $user_score_details_array[$key]['cat_id'])->get()->first();
            $survey_team_image    = $survey_team_type_arr['team_logo'];
            $team_image_with_path = url('/')."/teamimages/".$survey_team_image; 
            
            $surveyqsType_det = DB::connection('mongodb')->collection('dimensionMaster')->where('_id', $user_score_details_array[$key]['cat_id'])->get()->first();  
            $category_name = $surveyqsType_det['dimension_name'];
            
            $user_score_details_array[$key]['team_logo'] = $team_image_with_path;
            $user_score_details_array[$key]['team_name'] = $category_name;
        }
        
        $data['userscore_with_otherdetails'] = $user_score_details_array;
        
        return view('userscore', $data);
    }
    
    /**
     * Function to 
     * reset survey result .. 
     */
    public function userResetSurveyRes(Request $request)
    {
        $userid   = $request->userid;
        
         $deleteSurveyQes_array = DB::connection('mongodb')->collection('surveyQsAns')->where('user_id', $userid)->delete();
         $deleteSurveyRes_array = DB::connection('mongodb')->collection('surveyResults')->where('user_id', $userid)->delete();
         $deleteSurveyRes_array = DB::connection('mongodb')->collection('surveyCatScore')->where('user_id', $userid)->delete();
         
        if(!empty($deleteSurveyQes_array) && !empty($deleteSurveyRes_array))
            return redirect('/usermgt')->with('message', 'Result reset Successfully ...');
        else
            return redirect('/usermgt')->with('message', 'No Survey found which can be deleted !!!');        
    }
    
    /*
    public function userDelete(Request $request)
    {
        //$mode           = $request->mode;
        $userid   = $request->userid;
        
        $deleteTypeList_array = DB::table('velocity_user_master')->where('user_id', $userid)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/usermgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/usermgt')->with('message', 'Error occured during data process !!!'); 
    }
    
    
    public function userStatusChange(Request $request)
    {
        $data['userstatus'] = $request->status;
        $userid             = $request->userid;

        $updateData = DB::connection('mongodb')->collection('userMaster')->where('_id', $userid)->update($data, ['upsert' => true]);
        
        if(!empty($updateData))
            return redirect('/usermgt')->with('message', 'User status Update Successfully ...');
        else
            return redirect('/usermgt/'.$userid)->with('message', 'Error occured during data process !!!');         
    }*/
// -------------- End of the code -------------- //


/**
 * Methods to add or edit badges and show list view
 * Methods name : badgemgtadd, badgemgt
 */

    public function badgemgtadd($id = NULL, Request $request)
    {
        $badgeid = $request->route('badgeid');
        
        if(!empty($badgeid))
            $data['badge_array']  = DB::connection('mongodb')->collection('badgemaster')->where('_id', $badgeid)->get()->first();
        else
           $data['badge_array']  = '';
           
        if($request->frmSubmit) 
        { 
            $insert_data['badge_name']              = $request->badge_name;
            $insert_data['minimum_task']            = $request->minimum_task;
            $insert_data['min_performance_avg']     = $request->min_performance_avg;
            $insert_data['min_transaction']         = $request->min_transaction;
            $insert_data['revenue_stream']          = $request->revenue_stream;
            $insert_data['perform_eval_criteria']   = $request->perform_eval_criteria;
            $insert_data['requirement']             = $request->requirement;
        
            $badgeid                                = !empty($request->badgeid) ? $request->badgeid : 0;
            
            if(!empty($badgeid))
            {
                $insertData = DB::connection('mongodb')->collection('badgemaster')->where('_id', $badgeid)->update($insert_data, ['upsert' => true]);
                
                if(Input::hasFile('badge_logo'))
                {
                    $file = Input::file('badge_logo');
                    $file_original = $file->getClientOriginalName();
                    $fret = $file->move('badgeimages', $file_original);
                    
                    $image_data['badge_logo'] = $file_original;
                    $insertImgData = DB::connection('mongodb')->collection('badgemaster')->where('_id', $badgeid)->update($image_data, ['upsert' => true]);                
                    
                }                
                
                if(!empty($insertData) || !empty($insertImgData))
                    return redirect('/badgemgt')->with('message', 'Data Update Successfully ...');
                else
                    return redirect('/badgemgtedit/'.$badgeid)->with('message', 'Error occured during data process !!!');                    
            }
            else {
                $insertData = DB::connection('mongodb')->collection('badgemaster')->insertGetId($insert_data);
                $badgeid    = $insertData;
                
                if(Input::hasFile('badge_logo'))
                {
                    $file = Input::file('badge_logo');
                    $file_original = $file->getClientOriginalName();
                    $fret = $file->move('badgeimages', $file_original);
                    
                    $image_data['badge_logo'] = $file_original;
                    $insertImgData = DB::connection('mongodb')->collection('badgemaster')->where('_id', $badgeid)->update($image_data, ['upsert' => true]);                
                    
                }                  
                
                if(!empty($insertData) || !empty($insertImgData))
                    return redirect('/badgemgt')->with('message', 'Data Inserted Successfully ...');
                else
                    return redirect('/badgemgtedit')->with('message', 'Error occured during data process !!!');                                 }
        }
        else {
            
        }           

        return view('badgeadd', $data); 
    }
    
    public function badgemgt($search_string = '')
    {
        $user_array             = DB::connection('mongodb')->collection('badgemaster')->get();
        $data['badge_array']     = $user_array;
        
        return view('badgelist', $data);
    }
    
    public function badgemgtdel(Request $request)
    {
       // $data['userstatus'] = $request->status;
        $badgeid             = $request->badgeid;
        
        $deleteTypeList_array = DB::connection('mongodb')->collection('badgemaster')->where('_id', $badgeid)->delete();
        
        if(!empty($deleteTypeList_array))
            return redirect('/badgemgt')->with('message', 'Data deleted Successfully ...');
        else
            return redirect('/badgemgt')->with('message', 'Error occured during data process !!!');         
     } 
              
// -------------- End of the code -------------- //

    
/**
 * Methods to add or edit survery types and show list view
 * Methods name : surveyTypeDataUpdate, surveyTypeList
 */
     
## Add / Update procedure ......         
public function surveyTypeDataUpdate($id = NULL, Request $request)
{
    $surveytypeid = $request->route('surveytypeid');
    
    if(!empty($surveytypeid)) {
        
        $data['surveyType_det'] = DB::connection('mongodb')->collection('surveyType')->where('_id', $surveytypeid)->get()->first();
    }
    else {
        $data['surveyType_det'] = '';
    }        

    if($request->frmSubmit) 
    { 
        $insert_data['survey_name']  = $request->survey_name;
        $insert_data['survey_slug']  = $request->survey_slug;
        $surveytypeid                = !empty($request->surveytypeid) ? $request->surveytypeid : 0;
        
        if(!empty($surveytypeid))
        {
            $insertData = DB::connection('mongodb')->collection('surveyType')->where('_id', $surveytypeid)->update($insert_data, ['upsert' => true]);
            
            if(!empty($insertData))
                return redirect('/surveytypelist')->with('message', 'Data Update Successfully ...');
            else
                return redirect('/surveytypeedit/'.$surveytypeid)->with('message', 'Error occured during data process !!!');                    
        }
        else {
            $insertData = DB::connection('mongodb')->collection('surveyType')->insert($insert_data);
            if(!empty($insertData))
                return redirect('/surveytypelist')->with('message', 'Data Inserted Successfully ...');
            else
                return redirect('/surveytypeedit')->with('message', 'Error occured during data process !!!');                                 }
    }
    else {
        
    }
    //dd($data['surveyType_det']);
    return view('surveytypeadd', $data);
}
## ---------------- End of the code ------------------- ##


public function surveyTypeList($search_string = '')
{
    $surveyTypeList_array       = DB::connection('mongodb')->collection('surveyType')->get();
    $data['surveyList_array']   = $surveyTypeList_array;
    
    return view('surveytypelist', $data);
}

public function surveyTypeListDelete(Request $request)
{
    $mode           = $request->mode;
    $surveytypeid   = $request->surveytypeid;
    
    $deleteTypeList_array = DB::connection('mongodb')->collection('surveyType')->where('_id', $surveytypeid)->delete();
    
    if(!empty($deleteTypeList_array))
        return redirect('/surveytypelist')->with('message', 'Data deleted Successfully ...');
    else
        return redirect('/surveytypelist')->with('message', 'Error occured during data process !!!');     
    
} 

## -------------------------- End of survey type related operations ----------------------- ##
   
    
/**
 * Methods to add or edit survery questtion types and show list view
 * Methods name : surveyQsTypeDataUpdate, surveyQsTypeList
 */    
public function surveyQsTypeDataUpdate($id = NULL, Request $request)
{
    $surveyqstypeid = $request->route('surveyqstypeid');
    
    if(!empty($surveyqstypeid)) {
        
        $data['surveyqsType_det'] = DB::connection('mongodb')->collection('dimensionMaster')->where('_id', $surveyqstypeid)->get()->first();
    }
    else {
        $data['surveyqsType_det'] = '';
    }        

    if($request->frmSubmit) 
    { 
        $insert_data['dimension_name']      = $request->dimension_name;
        $insert_data['dimension_details']   = $request->dimension_details;
        $insert_data['dimension_label1']    = $request->label1;
        $insert_data['dimension_label2']    = $request->label2;
        
        $surveyqstypeid                     = !empty($request->surveyqstypeid) ? $request->surveyqstypeid : 0;
        
        if(!empty($surveyqstypeid))
        {
            $insertData = DB::connection('mongodb')->collection('dimensionMaster')->where('_id', $surveyqstypeid)->update($insert_data, ['upsert' => true]);
            
            if(!empty($insertData))
                return redirect('/surveyqstypelist')->with('message', 'Data Update Successfully ...');
            else
                return redirect('/surveyqstypeedit/'.$surveytypeid)->with('message', 'Error occured during data process !!!');                    
        }
        else {
            $insertData = DB::connection('mongodb')->collection('dimensionMaster')->insert($insert_data);
            if(!empty($insertData))
                return redirect('/surveyqstypelist')->with('message', 'Data Inserted Successfully ...');
            else
                return redirect('/surveyqstypeedit')->with('message', 'Error occured during data process !!!');                                 }
    }
    else {
        
    }
    //dd($data['surveyType_det']);
    return view('surveyqstypeadd', $data);    
}


public function surveyQsTypeList($search_string = '')
{
    $surveyQsTypeList_array             = DB::connection('mongodb')->collection('dimensionMaster')->get();
    $data['surveyQsTypeList_array']     = $surveyQsTypeList_array;
    
    return view('surveyqstypelist', $data);       
} 

public function surveyQsTypeListDelete(Request $request)
{
    $mode           = $request->mode;
    $surveyqstypeid   = $request->surveyqstypeid;
    
    $deleteTypeList_array = DB::connection('mongodb')->collection('dimensionMaster')->where('_id', $surveyqstypeid)->delete();
    
    if(!empty($deleteTypeList_array))
        return redirect('/surveyqstypelist')->with('message', 'Data deleted Successfully ...');
    else
        return redirect('/surveyqstypelist')->with('message', 'Error occured during data process !!!'); 
} 
    
    
## -------------------------- End of survey question type related operations ----------------------- ##


        
## -------------------------- Start of survey question related operations ----------------------- ##    
/**
 * Methods to add or edit survery questtion types and show list view
 * Methods name : surveyQsDataUpdate, surveyQsListttp\Response
*/    
public function surveyQsDataUpdate(Request $request)
{
    $surveyqsid = $request->route('surveyqsid');
    
    $surveyQsTypeList_array             = DB::connection('mongodb')->collection('dimensionMaster')->get();
    $data['surveyQsTypeList_array']     = $surveyQsTypeList_array; 
    
    //dd($data['surveyQsTypeList_array']);   
    
    if(!empty($surveyqsid)) {
        
        $data['surveyqs_det'] = DB::connection('mongodb')->collection('surveyQuestions')->where('_id', $surveyqsid)->get()->first();
    }
    else {
        $data['surveyqs_det'] = '';
    }        

    if($request->frmSubmit) 
    { 
        $insert_data['survey_qs_parent']    = 0;
        $insert_data['survey_type']         = '';
        $insert_data['survey_question']     = $request->survey_question;
        $insert_data['question_type']       = $request->question_type;
        $surveyqsid                         = !empty($request->surveyqsid) ? $request->surveyqsid : 0;
        
        if(!empty($surveyqsid))
        {
            $insertData = DB::connection('mongodb')->collection('surveyQuestions')->where('_id', $surveyqsid)->update($insert_data, ['upsert' => true]);
            
            if(!empty($insertData))
                return redirect('/surveyqslist')->with('message', 'Data Update Successfully ...');
            else
                return redirect('/surveyqsedit/'.$surveytypeid)->with('message', 'Error occured during data process !!!');                    
        }
        else {
            $insertData = DB::connection('mongodb')->collection('surveyQuestions')->insert($insert_data);
            if(!empty($insertData))
                return redirect('/surveyqslist')->with('message', 'Data Inserted Successfully ...');
            else
                return redirect('/surveyqsedit')->with('message', 'Error occured during data process !!!');                                 }
    }
    else {
        
    }
    //dd($data['surveyType_det']);
    return view('surveyqsadd', $data);      
}


public function surveyQsList()
{
        $surveyQuestion_array   = DB::connection('mongodb')->collection('surveyQuestions')->get();
        $surveyFinalQs_array    = array();
       
        $counter = 0;
        foreach($surveyQuestion_array as $value)
        {
            foreach($value as $key=>$inner_values)
            {
                $surveyFinalQs_array[$counter][$key] = $inner_values;
            }
            
            $question_type_arr = DB::connection('mongodb')->collection('dimensionMaster')->where('_id', $value['question_type'])->get()->first();
            $surveyFinalQs_array[$counter][$key] = $question_type_arr['dimension_name'];
            $counter++;
        }
        
        $data['surveyQsTypeList_array']  = $surveyFinalQs_array; 
        return view('surveyqslist', $data); 
}

//--- API creation for survey question answer list ---//
public function surveyQsAnsListApi()
{
        $surveyQuestion_array   = DB::connection('mongodb')->collection('surveyQuestions')->get();
        $surveyFinalQs_array    = array();
       
        $counter = 0;
        foreach($surveyQuestion_array as $value)
        {
            foreach($value as $key=>$inner_values)
            {
                $surveyFinalQs_array[$counter][$key] = $inner_values;
            }
            
            $question_id       = (string)$value['_id']; 
            $answers_details   = DB::connection('mongodb')->collection('surveyAnswers')->where('survey_qs_id', $question_id)->orderBy('answer_score','DESC')->get(); 
            $question_type_arr = DB::connection('mongodb')->collection('dimensionMaster')->where('_id', $value['question_type'])->get()->first();
            
            $surveyFinalQs_array[$counter]['dimension_name']    = $question_type_arr['dimension_name'];
            $surveyFinalQs_array[$counter]['dimension_id']      = $question_type_arr['_id'];
            $surveyFinalQs_array[$counter]['answers_details']   = $answers_details;
            $counter++;
        }
        
        $data['surveyQsTypeList_array']  = $surveyFinalQs_array;
        
        return response()->json($surveyFinalQs_array, 200);  

} 
//--- API creation for survey question answer list ---//


 public function surveyQsListDelete(Request $request)
{
    $mode               = $request->mode;
    $surveyqsid         = $request->surveyqsid;
    
    $deleteTypeList_array = DB::connection('mongodb')->collection('surveyQuestions')->where('_id', $surveyqsid)->delete();
    
    if(!empty($deleteTypeList_array))
        return redirect('/surveyqslist')->with('message', 'Data deleted Successfully ...');
    else
        return redirect('/surveyqslist')->with('message', 'Error occured during data process !!!');     
} 

public function surveyQsAnswerUpdate(Request $request)
{
    $surveyqsid         = $request->surveyqsid;
    $data['surveyqsid'] = $surveyqsid;

    if(!empty($surveyqsid)) {
        
        $data['surveyqs_det'] = DB::connection('mongodb')->collection('surveyQuestions')->where('_id', $surveyqsid)->get()->first();
    }
    else {
        $data['surveyqs_det'] = '';
    }  
    
    $data['answers_details'] = DB::connection('mongodb')->collection('surveyAnswers')->where('survey_qs_id', $surveyqsid)->orderBy('answer_score','ASC')->get();     

    if($request->frmSubmit) 
    { 
        $insert_data['survey_qs_id']    = $surveyqsid;
        $insert_data['survey_answer']   = $request->survey_answer;
        $insert_data['answer_score']    = $request->answer_score;

        $insertData = DB::connection('mongodb')->collection('surveyAnswers')->insert($insert_data);
        if(!empty($insertData))
            return redirect('/surveyqsansadd/'.$surveyqsid)->with('message', 'Data Inserted Successfully ...');
        else
            return redirect('/surveyqsansadd/'.$surveyqsid)->with('message', 'Error occured during data process !!!');                                 
    }
    else {
        
    }
    //dd($data['surveyType_det']);
    return view('surveyqsans', $data);      
} 

 public function surveyQsAnsListDelete(Request $request)
{
    $mode               = $request->mode;
    $surveyqsansid      = $request->surveyqsansid;
    $surveyqsid         = $request->surveyqsid;    
    
    $deleteTypeList_array = DB::connection('mongodb')->collection('surveyAnswers')->where('_id', $surveyqsansid)->delete();
    
    if(!empty($deleteTypeList_array))
        return redirect('/surveyqsansadd/'.$surveyqsid)->with('message', 'Data deleted Successfully ...');
    else
        return redirect('/surveyqsansadd/'.$surveyqsid)->with('message', 'Error occured during data process !!!');     
} 

## -------------------------- End of survey question related operations ----------------------- ##


/**
 * API Call for survey 
 * answer and points for the 
 * answers
 */

public function putAnsForQuestions(Request $request)
{
    $insert_data['question_id']     = $request->question_id;
    $insert_data['question_type']   = $request->question_type_id;
    $insert_data['answer_id']       = $request->answer_id;
    $insert_data['user_id']         = $request->user_id;
    
    $data['answers_details']        = DB::connection('mongodb')->collection('surveyAnswers')->where('_id', $request->answer_id)->get();
    
    $data['question_details']      = DB::connection('mongodb')->collection('surveyQuestions')->where('_id', $request->question_id)->get()->first();
    
    if(!empty($data['question_details']['question_type']))
        $question_type_id = $data['question_details']['question_type'];
    else
        $question_type_id = $request->question_type_id;
    
    
    /* Code to update total score after a survey  */
    if(!empty($data['answers_details'][0]))
    {
        $user_score                 = $data['answers_details'][0]['answer_score'];
        $insertData                 = 1; 
        $insert_res_data            = 1;
        
        /* Code to update categorywise score after a survey  */
        $get_categorywise_score = DB::connection('mongodb')->collection('surveyCatScore')->where('user_id', $request->user_id)->where('cat_id', $question_type_id)->get()->first();

        $cat_insert['user_id']      = $request->user_id;
        $cat_insert['cat_id']       = $question_type_id;

        if(!empty($get_categorywise_score))
        {
            $user_catwise_score         = $get_categorywise_score['cat_score'];
            $user_current_catsc         = $user_score + $get_categorywise_score['cat_score'];

            $cat_insert['ques_cont']    = $get_categorywise_score['ques_cont'] + 1;
            $cat_insert['cat_score']    = $user_current_catsc; 

            $total_cat_max_score        = $cat_insert['ques_cont'] * 5;
            $percentage_of_cate_score   = (($user_current_catsc / $total_cat_max_score) * 100) ;        

            $cat_insert['cat_percent']  = $percentage_of_cate_score;

            $insertDataCategoryRes      = DB::connection('mongodb')->collection('surveyCatScore')->where('user_id', $request->user_id)->where('cat_id', $question_type_id)->update($cat_insert, ['upsert' => true]);       
        }
        else
        {
            $user_current_catsc         = $user_score;
            $cat_insert['ques_cont']    = 1;
            $cat_insert['cat_score']    = $user_current_catsc;

            $total_cat_max_score        = $cat_insert['ques_cont'] * 5;
            $percentage_of_cate_score   = (($user_current_catsc / $total_cat_max_score) * 100) ;        

            $cat_insert['cat_percent']  = $percentage_of_cate_score;        

            $insertDataCategoryRes      = DB::connection('mongodb')->collection('surveyCatScore')->insertGetId($cat_insert);        
        }
        /* Code to update categorywise score after a survey  */        
        
        $insertData                 = DB::connection('mongodb')->collection('surveyQsAns')->insertGetId($insert_data);
        $data['user_score']         = DB::connection('mongodb')->collection('surveyResults')->where('user_id', $request->user_id)->get();

        if(!empty($data['user_score'][0]))
        {
            $getUserScore                   = $data['user_score'][0]['total_score'];
            $get_current_score              = $getUserScore + $user_score; 

            $insert_result_data['user_id']     = $insert_data['user_id'];
            $insert_result_data['total_score'] = $get_current_score;        

            $insertDataRes = DB::connection('mongodb')->collection('surveyResults')->where('user_id', $request->user_id)->update($insert_result_data, ['upsert' => true]);
            
        }
        else {
            $get_current_score                  = $user_score;

            $insert_result_data['user_id']     = $insert_data['user_id'];
            $insert_result_data['total_score'] = $get_current_score;   

            $insertDataRes                  = DB::connection('mongodb')->collection('surveyResults')->insertGetId($insert_result_data);

        }  
        
        $get_total_questions = DB::connection('mongodb')->collection('surveyQsAns')->where('user_id', $request->user_id)->get();
        $total_num_questions = count($get_total_questions);
        $total_max_score     = $total_num_questions * 5;
        $percentage_of_score = (($get_current_score / $total_max_score) * 100) ;
        
        ################################################################################

        $get_current_score_array = DB::connection('mongodb')->collection('surveyResults')->where('user_id', $request->user_id)->get();
        
        $get_categorywise_score  = DB::connection('mongodb')->collection('surveyCatScore')->where('user_id', $request->user_id)->get();
        
        if(!empty($get_categorywise_score[0]))
            $getCatResult = $get_categorywise_score;
        else
            $getCatResult = 0;
        
        $max        = -99.99; //will hold max val
        $found_item = null; //will hold item with max val;
        
        foreach($getCatResult as $k=>$v)
        {
            $cat_percentage = $v['cat_percent'];
            
            if($cat_percentage > $max)
            {
               $max = $cat_percentage;
               $found_item  = $v;
               $found_index = $k;
            }
        }

        $hight_category     = $getCatResult[$found_index]['cat_id'];
        $hight_percentage   = (string)round($getCatResult[$found_index]['cat_percent']);
        
        $dimention_nameget  = DB::connection('mongodb')->collection('dimensionMaster')->where('_id', $hight_category)->get()->first();
        $dimention_name     = $dimention_nameget['dimension_name'];
        
        $survey_team_type_arr = DB::connection('mongodb')->collection('surveyTeam')->where('personality', $hight_category)->get()->first();
        $survey_team_image    = $survey_team_type_arr['team_logo'];
        
        $team_image_with_path = url('/')."/teamimages/".$survey_team_image;

        if(!empty($get_current_score_array[0]))
        {
            $get_current_score_sub   = $get_current_score_array[0]['total_score'];                        

            $get_total_questions_sub = DB::connection('mongodb')->collection('surveyQsAns')->where('user_id', $request->user_id)->get();
            $total_num_questions_sub = count($get_total_questions_sub);
            $total_max_score_sub     = $total_num_questions_sub * 5;
            $percentage_of_score_sub = (($get_current_score_sub / $total_max_score_sub) * 100) ;             
        }
        else {
            $get_current_score_sub      = 0;
            $percentage_of_score_sub    = 0;
        }        
        
        ################################################################################
        
		
        $data['badge_array']  	= DB::connection('mongodb')->collection('badgemaster')->where('min_performance_avg', $hight_percentage)->get()->first();
		
        if(!empty($data['badge_array'])) 
        {
            $pathwithbadgeimage		= "badgeimages/".$data['badge_array']['badge_logo'];
            $basic_url			= url('/');
            $badge_path			= $basic_url."/".$pathwithbadgeimage;		
        }
        else
        {
            $pathwithbadgeimage		= "badgeimages/noimage.png";
            $basic_url			= url('/');
            $badge_path			= $basic_url."/".$pathwithbadgeimage;		
        }
        
        //-----------------------------------------------//

        //----------------------------------//
        
        $user_details_array = DB::connection('mongodb')->collection('userMaster')->where('_id', $request->user_id)->get()->first();
        $data['user_details_list'] = $user_details_array;
        
        $user_score_array = DB::connection('mongodb')->collection('surveyCatScore')->where('user_id', $request->user_id)->get();
        
        $user_score_details_array = array();
        $array_loop_counter       = 0;
        
        foreach($user_score_array as $key=>$scorevalues)
        {
            foreach($scorevalues as $innerKey=>$innervalue)
            {
                $user_score_details_array[$key][$innerKey] = $innervalue;
            }
            
            $survey_team_type_arr = DB::connection('mongodb')->collection('surveyTeam')->where('personality', $user_score_details_array[$key]['cat_id'])->get()->first();
            $survey_team_image    = $survey_team_type_arr['team_logo'];
            $team_image_with_path = url('/')."/teamimages/".$survey_team_image; 
            
            $surveyqsType_det = DB::connection('mongodb')->collection('dimensionMaster')->where('_id', $user_score_details_array[$key]['cat_id'])->get()->first();  
            $category_name      = $surveyqsType_det['dimension_name'];
            
            if(!empty($surveyqsType_det['dimension_label1']))
                $category_label1    = $surveyqsType_det['dimension_label1'];
            else
                $category_label1    = '';
            
            if(!empty($surveyqsType_det['dimension_label2']))
                $category_label2    = $surveyqsType_det['dimension_label2'];
            else
                $category_label2    = '';
            
            $user_score_details_array[$key]['team_logo']        = $team_image_with_path;
            $user_score_details_array[$key]['personality_name'] = $category_name;
            $user_score_details_array[$key]['question_label1']  = $category_label1;
            $user_score_details_array[$key]['question_label2']  = $category_label2;
            $user_score_details_array[$key]['team_name']        = $survey_team_type_arr['name'];
            $user_score_details_array[$key]['team_description'] = $survey_team_type_arr['description'];
            
            unset($user_score_details_array[$key]['user_id']);
            unset($user_score_details_array[$key]['_id']);
        }
        
        $data['userscore_with_otherdetails'] = $user_score_details_array;        
        
        
        //---------------------------------//        
        
        //----------------------------------------------//
        
        if(!empty($insertData) && !empty($insertDataRes)) {
            /*
            $response_data = array( 'error_code'=>0, 
                                    'success_msg'=>'Score created Successfully', 
                                    'user_score'=>$get_current_score, 
				    'badge_image'=>$badge_path,
                                    'user_score_precentage'=>$percentage_of_score, 
                                    'badge_image_sub'=>$team_image_with_path,
                                    'user_score_percentage_sub'=>$hight_percentage,
                                    'badge_path_sub'=>$badge_path,
                                    'team_name_sub'=>$dimention_name,
                                    'userscore_with_otherdetails'=>$user_score_details_array
                                    );*/
            
            $response_data = array( 'error_code'=>0, 
                                    'success_msg'=>'Score created Successfully', 
                                    'user_score'=>$get_current_score, 
				    'badge_image'=>$badge_path,
                                    'user_score_precentage'=>$percentage_of_score, 
                                    'userscore_with_otherdetails'=>$user_score_details_array
                                    );            
            
            
           /* $response_data = array( 'error_code'=>0, 
                                    'success_msg'=>'Score created Successfully', 
                                    'user_score'=>$get_current_score, 
				    'badge_image'=>$badge_path,
                                    'user_score_precentage'=>$percentage_of_score); */           
            
            
            return response()->json($response_data, 200);
        }
        else {
            $errors = 'Error occurs during score process';
            $response_data = array('error_code'=>1, 'msg'=>$errors);
            return response()->json($response_data, 200);
        }

        
    }
    else {
        $errors = 'Given answer is not valied';
        $response_data = array('error_code'=>1, 'msg'=>$errors);
        return response()->json($response_data, 200);       
    }
    /* Code to update total score after a survey  */
}

/**
 * Methods to add or edit team and show list view
 * Methods name : teamDataUpdate, teamList
 */
     
## Add / Update procedure ......         
public function teamDataUpdate($id = NULL, Request $request)
{
    $teamid = $request->route('teamid');
    
    $surveyQsTypeList_array             = DB::connection('mongodb')->collection('dimensionMaster')->get();
    $data['surveyQsTypeList_array']     = $surveyQsTypeList_array;     
    
    if(!empty($teamid)) {
         $data['team_det'] = DB::connection('mongodb')->collection('surveyTeam')->where('_id', $teamid)->get()->first();
    }
    else {
        $data['team_det'] = '';
    }
    
    if($request->frmSubmit) 
    { 
        $insert_data['personality']  = $request->question_type;
        $insert_data['name']         = $request->name;
        $insert_data['description']  = $request->description;
        $insert_data['shape']        = $request->shape;        
        $insert_data['color']        = $request->color;
        $insert_data['requirement']  = $request->requirement;        
        $insert_data['logo']         = '';
        
        $teamid                      = !empty($request->teamid) ? $request->teamid : 0;
        
        if(!empty($teamid))
        {
            $insertData = DB::connection('mongodb')->collection('surveyTeam')->where('_id', $teamid)->update($insert_data, ['upsert' => true]);

            if(Input::hasFile('team_logo'))
            {
                $file = Input::file('team_logo');
                $file_original = $file->getClientOriginalName();
                $fret = $file->move('teamimages', $file_original);
                
                $image_data['team_logo'] = $file_original;
                $insertImgData = DB::connection('mongodb')->collection('surveyTeam')->where('_id', $teamid)->update($image_data, ['upsert' => true]);                
                
            }            
            
            if(!empty($insertData) || !empty($insertImgData))
                return redirect('/teammgt')->with('message', 'Data Update Successfully ...');
            else
                return redirect('/teamedit/'.$teamid)->with('message', 'Error occured during data process !!!');                    
        }
        else {
            $insertData = DB::connection('mongodb')->collection('surveyTeam')->insertGetId($insert_data);
            $teamid     = $insertData;
           
            if(Input::hasFile('team_logo'))
            {
                $file = Input::file('team_logo');
                $file_original = $file->getClientOriginalName();
                $fret = $file->move('teamimages', $file_original);
                
                $image_data['team_logo'] = $file_original;
                $insertImgData = DB::connection('mongodb')->collection('surveyTeam')->where('_id', $teamid)->update($image_data, ['upsert' => true]);                
                
            }
            
            if(!empty($insertData) || !empty($insertImgData))
                return redirect('/teammgt')->with('message', 'Data Inserted Successfully ...');
            else
                return redirect('/teamedit')->with('message', 'Error occured during data process !!!');                                 }
    }
    else {
        
    }
    //dd($data['surveyType_det']);
    return view('teamadd', $data);
}
## ---------------- End of the code ------------------- ##


public function teamList($search_string = '')
{
    $teamList_array       = DB::connection('mongodb')->collection('surveyTeam')->get();
    $teamFinalQs_array    = array();
   
    $counter = 0;
    foreach($teamList_array as $value)
    {
        foreach($value as $key=>$inner_values)
        {
            $teamFinalQs_array[$counter][$key] = $inner_values;
        }
        
        $question_type_arr = DB::connection('mongodb')->collection('dimensionMaster')->where('_id', $value['personality'])->get()->first();
        $teamFinalQs_array[$counter]['dimension_name'] = $question_type_arr['dimension_name'];
        $counter++;
    }
    
    $data['teamFinalQs_array']  = $teamFinalQs_array;     
    return view('teamlist', $data);
}

/*
 * API to show 
 * list of teams
 */
public function getTeamListAPI()
{
    $teamList_array       = DB::connection('mongodb')->collection('surveyTeam')->get();
    $teamFinalQs_array    = array();
   
    $counter = 0;
    foreach($teamList_array as $value)
    {
        foreach($value as $key=>$inner_values)
        {
            $teamFinalQs_array[$counter][$key] = $inner_values;
        }
        
        $question_type_arr = DB::connection('mongodb')->collection('dimensionMaster')->where('_id', $value['personality'])->get()->first();
        $teamFinalQs_array[$counter]['dimension_name'] = $question_type_arr['dimension_name'];
        $counter++;
    }
    
    $data['teamFinalQs_array']  = $teamFinalQs_array;
    $no_of_team_element         = count($teamFinalQs_array);
    
    if($no_of_team_element > 0)
    {
        $response_data = array('error_code'=>0, 
                               'team_details'=>$teamFinalQs_array
                              );
        return response()->json($response_data, 200);
    }
    else
    {
        $response_data = array('error_code'=>1, 
                               'team_details'=>''
                              );
        return response()->json($response_data, 200);        
    }
    
}


public function teamListDelete(Request $request)
{
    $mode     = $request->mode;
    $teamid   = $request->teamid;
    
    $deleteTypeList_array = DB::connection('mongodb')->collection('surveyTeam')->where('_id', $teamid)->delete();
    
    if(!empty($deleteTypeList_array))
        return redirect('/teammgt')->with('message', 'Data deleted Successfully ...');
    else
        return redirect('/teammgt')->with('message', 'Error occured during data process !!!');     
    
} 

## -------------------------- End of team related operations ----------------------- ##



/**
 * Methods to add or edit locations and show list view
 * Methods name : locationDataUpdate, locationList
 */
     
## Add / Update procedure ......         
public function locationDataUpdate($id = NULL, Request $request)
{
    $locationid = $request->route('locationid');
    
    if(!empty($locationid)) {
        
        $data['location_det'] = DB::connection('mongodb')->collection('locations')->where('_id', $locationid)->get()->first();
    }
    else {
        $data['location_det'] = '';
    }        

    if($request->frmSubmit) 
    { 
        $insert_data['location_name']  = $request->location_name;
        $insert_data['location_code']  = $request->location_code;
        
        $locationid                = !empty($request->locationid) ? $request->locationid : 0;
        
        if(!empty($locationid))
        {
            $insertData = DB::connection('mongodb')->collection('locations')->where('_id', $locationid)->update($insert_data, ['upsert' => true]);
            
            if(!empty($insertData))
                return redirect('/locationlist')->with('message', 'Data Update Successfully ...');
            else
                return redirect('/locationadd/'.$locationid)->with('message', 'Error occured during data process !!!');                    
        }
        else {
            $insertData = DB::connection('mongodb')->collection('locations')->insert($insert_data);
            if(!empty($insertData))
                return redirect('/locationlist')->with('message', 'Data Inserted Successfully ...');
            else
                return redirect('/locationadd')->with('message', 'Error occured during data process !!!');                                 }
    }
    else {
        
    }
    //dd($data['surveyType_det']);
    return view('locationadd', $data);
}
## ---------------- End of the code ------------------- ##


public function locationList($search_string = '')
{
    $locationList_array       = DB::connection('mongodb')->collection('locations')->get();
    $data['location_array']   = $locationList_array;
    
    return view('locationlist', $data);
}

public function locationListApi()
{
    $locationList_array       = DB::connection('mongodb')->collection('locations')->get();
    $data['location_array']   = $locationList_array; 
    $no_of_location_element    = count($locationList_array);
    
    if($no_of_location_element > 0)
    {
        $response_data = array('error_code'=>0, 
                               'locationlist'=>$locationList_array
                              );
        return response()->json($response_data, 200);
    }
    else
    {
        $response_data = array('error_code'=>1, 
                               'locationlist'=>''
                              );
        return response()->json($response_data, 200);        
    }    
    
}

public function locationListDelete(Request $request)
{
    //$mode           = $request->mode;
    
    $locationid   = $request->locationid;
    
    $deleteTypeList_array = DB::connection('mongodb')->collection('locations')->where('_id', $locationid)->delete();
    
    if(!empty($deleteTypeList_array))
        return redirect('/locationlist')->with('message', 'Data deleted Successfully ...');
    else
        return redirect('/locationlist')->with('message', 'Error occured during data process !!!');     
    
} 

## -------------------------- End of location related operations ----------------------- ##

    
    
## ------------------------ Default sectins ----------------------- ##
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
## ------------------------ Default sectins ----------------------- ##
           
    
}
