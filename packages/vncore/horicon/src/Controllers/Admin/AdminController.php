<?php

namespace VNCore\Horicon\Controllers\Admin;

use Illuminate\Http\Request;
use VNCore\Horicon\Controllers\HoriconController;

class AdminController extends HoriconController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('horicon::dashboard.index');
    }
}
