<?php

namespace ARJUN\ADMIN\CONTROLLERS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use ARJUN\ADMIN\MODELS\LOGS\LOGGER;

class LOGSCONTROLLER extends Controller {

    protected $package;

    public function __construct() {
        $this->package = 'admin';
    }

    public function index() {
        $data['logs'] = LOGGER::all();
        return view($this->package . '::logs/index')->with($data);
    }

}
