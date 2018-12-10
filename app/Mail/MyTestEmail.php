<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyTestEmail extends Mailable
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
    	 
        return $this->view('email.myTestMail', $this->getemailData)                
        		->from($address, 'admin@velocityenglish.com.au.com')
        		->subject($this->getemailData['subject'])
        		->with(['title' => $this->getemailData['subject'], 'customer_name'=>$this->getemailData['customername']]); 
        		
    }
}
