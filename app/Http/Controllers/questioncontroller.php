<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\adminuser;
use Input;

class questioncontroller extends Controller
{
    public function show(Request $request)
    {
        $data['adminuser'] = 'admin';
        $data['has_student_css'] = 0;
        $data['session'] = $request->session();

        return view('questionmgt', $data);
    }

    public function questionData(Request $request)
    {
        $data['adminuser'] = 'admin';
        $data['has_student_css'] = 0;
        $data['session'] = $request->session();
        $data['mainTableName'] = $request->input('mainTableName');

        return view('questionmgt/prac_table_data', $data);
    }

    public function newRa(Request $request)
    {
        $data['adminuser'] = 'admin';
        $data['has_student_css'] = 0;
        $data['session'] = $request->session();

        return view('questionmgt/ra', $data);
    }

    public function raUpdate(Request $request)
    {
        $data['adminuser'] = 'admin';
        $data['has_student_css'] = 0;
        $data['session'] = $request->session();

        return view('questionmgt/ra_update', $data);
    }

    public function newRs(Request $request)
    {
        $data['adminuser'] = 'admin';
        $data['has_student_css'] = 0;
        $data['session'] = $request->session();

        return view('questionmgt/rs', $data);
    }

    public function rsUpdate(Request $request)
    {
        $data['adminuser'] = 'admin';
        $data['has_student_css'] = 0;
        $data['session'] = $request->session();

        return view('questionmgt/rs_update', $data);
    }

    public function questionDeletion(Request $request)
    {
        $data['adminuser'] = 'admin';
        $data['has_student_css'] = 0;
        $data['session'] = $request->session();
        $data['updates'] = Input::get('updates', 0);

        return view('questionmgt/question_deletion', $data);
    }

    public function test(Request $request)
    {
        $data['adminuser'] = 'admin';
        $data['has_student_css'] = 0;
        $data['session'] = $request->session();

        return view('test', $data);
    }
}
