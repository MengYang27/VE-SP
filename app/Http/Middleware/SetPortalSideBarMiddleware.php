<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetPortalSideBarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    private $_category;
    private $_subclass;

    private function _getDashboard(){
        $dashboard = array(
            'name' => 'Dashboard',
            'name_short' => '',
            'href' => 'index.html',
            'class' => 'fa fa-dashboard',
            'subsidiaries' => []
        );

        return $dashboard;
    }

    private function _getCalendar(){
        $calendar = array(
            'name' => 'Calendar',
            'name_short' => '',
            'href' => 'calendar.html',
            'class' => 'fa fa-calendar',
            'subsidiaries' => []
        );

        return $calendar;
    }

    private function _getCourse(){
        $course = array(
            'name' => 'Course',
            'name_short' => '',
            'href' => 'form.html',
            'class' => 'fa fa-mortar-board',
            'subsidiaries' => []
        );

        return $course;
    }

    private function _getMaterials(){
        $materials = array(
            'name' => 'Materials',
            'name_short' => '',
            'href' => 'material.html',
            'class' => 'fa fa-archive',
            'subsidiaries' => []
        );

        return $materials;
    }

    private function _getPersonalProfile(){
        $personalProfile = array(
            'name' => 'Personal Profile',
            'name_short' => '',
            'href' => 'profile.html',
            'class' => 'fa fa-child',
            'subsidiaries' => []
        );

        return $personalProfile;
    }

    private function _getPractises(){
        $listenings = array(
            'name' => 'Listening',
            'name_short' => '',
            'href' => '/practise/listening',
            'class' => 'fa fa-archive',
            'subsidiaries' => [
                'l-fib' => [
                    'name' => 'Fill in the blanks',
                    'name_short' => 'Fill in the blank(l)',
                    'href' => '/practise/listening/l-fib',
                    'class' => 'fa fa-child',
                    'category' => 'Listening',
                ],
                'l-hcs' => [
                    'name' => 'Highlight Correct Summary',
                    'name_short' => 'Highlight Correct Summary',
                    'href' => '/practise/listening/l-hcs',
                    'class' => 'fa fa-child',
                    'category' => 'Listening',
                ],
                'l-hiw' => [
                    'name' => 'Highlight Incorrect Words',
                    'name_short' => 'Highlight Incorrect Words',
                    'href' => '/practise/listening/l-hiw',
                    'class' => 'fa fa-child',
                    'category' => 'Listening',
                ],
                'l-mcma' => [
                    'name' => 'Multiple Choice Multiple Answer',
                    'name_short' => 'Multiple Choice - MA (l)',
                    'href' => '/practise/listening/l-mcma',
                    'class' => 'fa fa-child',
                    'category' => 'Listening',
                ],
                'l-mcsa' => [
                    'name' => 'Multiple Choice Single Answer',
                    'name_short' => 'Multiple Choice - SA (l)',
                    'href' => '/practise/listening/l-mcsa',
                    'class' => 'fa fa-child',
                    'category' => 'Listening',
                ],
                'l-smw' => [
                    'name' => 'Select Missing Word',
                    'name_short' => 'Select Missing Word',
                    'href' => '/practise/listening/l-smw',
                    'class' => 'fa fa-child',
                    'category' => 'Listening',
                ],
                'l-sst' => [
                    'name' => 'Summarize Spoken Text',
                    'name_short' => 'Summarize Spoken Text',
                    'href' => '/practise/listening/l-sst',
                    'class' => 'fa fa-child',
                    'category' => 'Listening',
                ],
                'l-wfd' => [
                    'name' => 'Write From Dictation',
                    'name_short' => 'Write From Dictation',
                    'href' => '/practise/listening/l-wfd',
                    'class' => 'fa fa-child',
                    'category' => 'Listening',
                ],
            ]
        );
        
        $readings = array(
            'name' => 'Reading',
            'name_short' => '',
            'href' => '/practise/reading',
            'class' => 'fa fa-archive',
            'subsidiaries' => [
                'read_aloud' => [
                    'name' => 'Read Aloud',
                    'name_short' => 'Read Aloud',
                    'href' => '/practise/reading/read_aloud',
                    'class' => 'fa fa-child',
                    'category' => 'Reading',
                ],
                'r-fib' => [
                    'name' => 'Fill in the Blank(R)',
                    'name_short' => 'Fill in the blank(r)',
                    'href' => '/practise/reading/r-fib',
                    'class' => 'fa fa-child',
                    'category' => 'Reading',
                ],
                'r-mcma' => [
                    'name' => 'Multiple Choice Multiple Answer',
                    'name_short' => 'Multiple Choice - MA (r)',
                    'href' => '/practise/reading/r-mcma',
                    'class' => 'fa fa-child',
                    'category' => 'Reading',
                ],
                'r-mcsa' => [
                    'name' => 'Multiple Choice Single Answer',
                    'name_short' => 'Multiple Choice - SA (r)',
                    'href' => '/practise/reading/r-mcsa',
                    'class' => 'fa fa-child',
                    'category' => 'Reading',
                ],
                'r-rp' => [
                    'name' => 'Reorder Pragraph',
                    'name_short' => 'Reorder Paragraph',
                    'href' => '/practise/reading/r-rp',
                    'class' => 'fa fa-child',
                    'category' => 'Reading',
                ],
                'rw-fib' => [
                    'name' => 'Fill in the Blank(RW)',
                    'name_short' => 'Fill in the blank(rw)',
                    'href' => '/practise/reading/rw-fib',
                    'class' => 'fa fa-child',
                    'category' => 'Reading'
                ],
            ]
        );
        
        $speakings = array(
            'name' => 'Speaking',
            'name_short' => '',
            'href' => '/practise/speaking',
            'class' => 'fa fa-archive',
            'subsidiaries' => [
                'answer_sq' => [
                    'name' => 'Answer Short Question',
                    'name_short' => 'Answer Short Question',
                    'href' => '/practise/speaking/answer_sq',
                    'class' => 'fa fa-child',
                    'category' => 'Speaking',
                ],
                'describe_image' => [
                    'name' => 'Describe Image',
                    'name_short' => 'Describe Image',
                    'href' => '/practise/speaking/describe_image',
                    'class' => 'fa fa-child',
                    'category' => 'Speaking',
                ],
                'repeat_sentence' => [
                    'name' => 'Repeat Sentence',
                    'name_short' => 'Repeat Sentence',
                    'href' => '/practise/speaking/repeat_sentence',
                    'class' => 'fa fa-child',
                    'category' => 'Speaking',
                ],
                'retell_lecture' => [
                    'name' => 'Retell Lecture',
                    'name_short' => 'Retell Lecture',
                    'href' => '/practise/speaking/retell_lecture',
                    'class' => 'fa fa-child',
                    'category' => 'Speaking',
                ],
            ]
        );
        
        $writings = array(
            'name' => 'Writing',
            'name_short' => '',
            'href' => '/practise/writing',
            'class' => 'fa fa-archive',
            'subsidiaries' => [
                'summarize_wt' => [
                    'name' => 'Summarize Written Text',
                    'name_short' => 'Summarize Written Text',
                    'href' => '/practise/writing/summarize_wt',
                    'class' => 'fa fa-child',
                    'category' => 'Writing'
                ],
                'write_essay' => [
                    'name' => 'Write Essay',
                    'name_short' => 'Write Essay',
                    'href' => '/practise/writing/write_essay',
                    'class' => 'fa fa-child',
                    'category' => 'Writing',
                ],    
            ]
        );

        $practises = array(
            'name' => 'Practise',
            'name_short' => '',
            'href' => '/parctise',
            'class' => 'fa fa-gamepad',
            'subsidiaries' => [
                'listening' => $listenings,
                'reading' => $readings,
                'speaking' => $speakings,
                'writing' => $writings
            ]
        );

        return $practises;
    }

    private function _getSideBarTops(){
        $side_bar_tops = array(
            'dashboard' => $this->_getDashboard(),
            'calendar' => $this->_getCalendar(),
            'course' => $this->_getCourse(),
            'materials' => $this->_getMaterials(),
            'personalProfile' => $this->_getPersonalProfile(),
            'practise' => $this->_getPractises()
        );

        return json_encode($side_bar_tops);
    }


    public function handle($request, Closure $next)
    {
        $Side_Bar_Tops_Object = $this->_getSideBarTops();
        $request->merge(compact('Side_Bar_Tops_Object'));
        return $next($request);
    }   
}