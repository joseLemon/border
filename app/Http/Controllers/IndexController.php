<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use App\Models\Directory;

class IndexController extends Controller
{
    public function index()
    {
        $cms = Cms::find(1);
        $directories = Directory::get();

        $params = [
            'cms' => $cms,
            'directories' => $directories
        ];

        return view('index.index',$params);
    }
}