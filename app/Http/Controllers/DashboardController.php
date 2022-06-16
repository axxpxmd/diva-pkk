<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';
    protected $active_dashboard = true;

    public function index()
    {
        $title = $this->title;
        $active_dashboard = $this->active_dashboard;

        return view('dashboard.index', compact(
            'title',
            'active_dashboard'
        ));
    }
}
