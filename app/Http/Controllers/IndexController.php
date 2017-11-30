<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use App\Models\Directory;
use App\Models\Hexagon;

class IndexController extends Controller
{
    public function index()
    {
        $cms = Cms::find(1);
        $directories = Directory::get();
        $hexagons = Hexagon::get();

        $params = [
            'cms' => $cms,
            'directories' => $directories,
            'hexagons' => $hexagons
        ];

        return view('index.index',$params);
    }
}