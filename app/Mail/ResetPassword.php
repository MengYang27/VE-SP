<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $getemailData;
     
    public function __construct($emailData)
    {
        //
       $this->getemailData = $emailData;
  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    	$address = 'admin@velocityenglish.com.au.com';
    	global $getemailData;
    	 
        return $this->view('email.resetPassword', $this->getemailData)                
        		->from($address, 'admin@velocityenglish.com.au.com')
        		->subject($this->getemailData['subject'])
        		->with(['title' => $this->getemailData['subject'], 'customer_name'=>$this->getemailData['customername'], 'password'=>$this->getemailData['cust_password']]); 
        		
    }
}
