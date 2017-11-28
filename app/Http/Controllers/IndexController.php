<?php

namespace App\Http\Controllers;

use App\Models\Cms;

class IndexController extends Controller
{
    public function index()
    {
        $cms = Cms::find(1);

        $params = [
            'cms' => $cms
        ];

        return view('index.index',$params);
    }
}