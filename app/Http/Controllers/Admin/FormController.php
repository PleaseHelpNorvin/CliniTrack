<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;


class FormController extends Controller
{
    // Show form creation page
    public function create()
    {
        return view('admin_pages.forms_pages.create');
    }

    // Store new form
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:50',
            'link' => 'required|url',
            'status' => 'required|in:active,inactive',
        ]);

        Form::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Form added successfully!');
    }

    public function edit(Form $form) {
        return  view ('admin_pages.forms_pages.edit');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Form deleted successfully!');
    }
}
