<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class practisecontroller extends Controller
{
    // for student portal practise

    // Speaking
    // read aloud
    function s_ra()
    {
        $adminuser = 'student';
        $result = array(
            'ID' => 1,
            'Title' => 'THIS SHOULD BE A TITLE',
            'Subtitle' => 'THIS SHOULD BE A SUBTITLE',
            'Tags' => [
                'High Frequency' => 'label label-danger',
                'Hard' => 'label label-warning',
                'Completed' => 'label label-success',
            ],
            'Audio' => [
                'Src' => '/temp/Rowan_Atkinson_BBC_Radio4_Front_Row_8_Jan_2012.ogg',
                'Format' => 'audio/ogg',
            ],
            'Content' => "Domestication is an evolutionary, rather than a political, development. It is certainly not a regime humans imposed on animals some 10,000 years ago. Rather, domestication happened when a small handful of especially opportunistic species discovered through Darwinian trial and error that they were more likely to survive and prosper in an alliance with humans than on their own. ",
            
        );
        return view('practise.s_ra', ['question' => $result, 'adminuser'=>$adminuser]);
    }

}
