<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class LandingPageController extends Controller
{
    //
    public function index()
    {
        // Get all active forms
        $forms = Form::where('status', 'active')->where('is_public', true)->get();

        return view('welcome', compact('forms'));
    }
}
