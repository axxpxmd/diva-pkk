<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Kecamatan;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';
    protected $active_dashboard = true;

    public function index()
    {
        $title = $this->title;
        $active_dashboard = $this->active_dashboard;

        $kecamatans = Kecamatan::select('id', 'n_kecamatan')->where('kabupaten_id', 40)->get();

        return view('pages.dashboard.index', compact(
            'title',
            'active_dashboard',
            'kecamatans'
        ));
    }
}
