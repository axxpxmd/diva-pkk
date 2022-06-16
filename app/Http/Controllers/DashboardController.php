<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';

    public function index()
    {
        $title = $this->title;

        return view('dashboard.index', compact('title'));
    }
}
