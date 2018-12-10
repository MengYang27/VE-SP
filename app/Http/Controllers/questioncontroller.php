<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
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

    public function questionDeletion(Request $request)
    {
        $data['adminuser'] = 'admin';
        $data['has_student_css'] = 0;
        $data['session'] = $request->session();
        $data['updates'] = Input::get('updates', 0);

        return view('questionmgt/question_deletion', $data);
    }

    // public function getSong($songPath) {
    //     $path = $songPath;

    //     $user = \Auth::user();
    //     if($user->activated_at) {
    //         $response = new BinaryFileResponse($path);
    //         return File::get($songPath);
    //         // BinaryFileResponse::trustXSendfileTypeHeader();

    //         // return $response;
    //     }
    //     \App::abort(400);
    // }

    public function test(Request $request)
    {
        $data['adminuser'] = 'admin';
        $data['has_student_css'] = 0;
        $data['session'] = $request->session();

        return view('test', $data);
    }
}
