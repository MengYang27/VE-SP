<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PortalBaseController extends Controller
{
    protected function broadcastSharedDataToAllViews(Request $request, $category=null, $subclass=null){
        $top_level = explode('/', $request->path())[0];
        $side_bar_tops = json_decode($request->Side_Bar_Tops_Object, true);

        if($subclass){
            $title = $side_bar_tops[$top_level]['subsidiaries'][$category]['subsidiaries'][$subclass]['name'];
        } else if($category) {
            $title = $category;
        } else {
            $title = $top_level;
        }

        $path_levels[] = [$top_level, '/'.$top_level];
        if($category) { View::share('category', $category); $path_levels[] = [$category, '/'.$category]; }
        if($subclass) { View::share('Subclass', $subclass); $path_levels[] = [$title, '/'.$subclass]; }

        View::share('Path_Levels_Object', json_encode($path_levels));
        View::share('Side_Bar_Tops_Object', $request->Side_Bar_Tops_Object);
        View::share('Page_Title', ucfirst($title));
    }
}
