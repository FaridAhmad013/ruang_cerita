<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private $module, $module_name, $service, $help_key, $folder, $allow;

    function __construct()
    {
        $this->module = '';
        $this->module_name = 'Halaman Beranda';
    }

    public function index()
    {

        $allow = json_encode($this->allow);

        $module = $this->module;
        $module_name = $this->module_name;
        return view('pages.main', compact('allow', 'module', 'module_name'));
    }
}
