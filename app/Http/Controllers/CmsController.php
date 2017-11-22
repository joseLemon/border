<?php

namespace App\Http\Controllers;

class CmsController extends Controller
{
    public function index() {
        return view('cms.index');
    }
}