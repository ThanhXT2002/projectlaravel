<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $config = $this->config();
        return view('backend.dashboard.index', compact('config'));
    }

    private function config(){
        return [
            'js'=> [
                'backend/plugins/chart.js/Chart.min.js',
                'backend/plugins/sparklines/sparkline.js',
                'backend/plugins/jqvmap/jquery.vmap.min.js',
                'backend/plugins/jqvmap/maps/jquery.vmap.usa.js',
                'backend/plugins/jquery-knob/jquery.knob.min.js',
                'backend/plugins/moment/moment.min.js',
                'backend/plugins/daterangepicker/daterangepicker.js',
                'backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                'backend/plugins/summernote/summernote-bs4.min.js',
                'backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
                'backend/js/pages/dashboard.js',
            ],
            'css'=>[
                'backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
                'backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
                'backend/plugins/jqvmap/jqvmap.min.css',
                'backend/plugins/summernote/summernote-bs4.min.css',
            ]
        ];
    }
}
