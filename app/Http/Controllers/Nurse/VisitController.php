<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
    public function index() {
        return view('nurse_pages.visit_pages.index');
    }
}
