<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homepagecontroller extends Controller
{
    // show bookshelf or student experience
    public function bookshelf(Request $request)
    {
        $sql = 'select * from se_samples';
        $bookperrow = 5;
        $sql = $sql . ' order by id desc';
        $allBooks = DB::select($sql);
        $bookCount = count($allBooks);
        $rowCount = ceil($bookCount / $bookperrow);
        $i = 0;
        while ($i < $rowCount) {
            $startBookNum = $i * $bookperrow;
            $bookInRow[$i] = array_slice($allBooks, $startBookNum, $bookperrow);
            $i++;
        }
        //$allBooksJson = json_encode($allBooks, JSON_UNESCAPED_UNICODE);
        // return view('homepage.bookshelf', ['allBooks' => $allBooks]);
        return view('homepage.bookshelf', ['bookInRow' => $bookInRow, 'rowCount' => $rowCount]);
    }
}
