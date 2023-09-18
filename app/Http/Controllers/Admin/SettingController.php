<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }
}
