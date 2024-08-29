<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new About();
    }

    /**
     * I dont usually comment code but I think i will start, really helps with remembering stuff
     * Display the form for adding or updating the About page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $about = $this->model->first();
        return view('admin.dashboard.about.index')->with('about', $about);
    }

    /**
     * Handle the form submission for adding the About page.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $request->validate([
            'header' => 'required|string',
            'text' => 'required|string'
        ]);

        try {
            $existingAbout = $this->model->first();
            if ($existingAbout) {
                session()->flash('warning', 'An about page already exists. You can only edit it.');
                return redirect()->back();
            }

            $this->model->create([
                'header' => $request->header,
                'text' => $request->text,
            ]);
        } catch (Exception $exception) {
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success', 'About information has been added successfully');
        return redirect()->back();
    }

    /**
     * Handle the form submission for updating the About page.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'header' => 'nullable|string|max:225',
            'text' => 'nullable|string'
        ]);

        try {
            $about = $this->model->first();
            if (!$about) {
                session()->flash('warning', 'The about page does not exist');
                return redirect()->back()->withInput($request->all());
            }

            $about->update([
                'header' => $request->filled('header') ? $request->header : $about->header,
                'text' => $request->filled('text') ? $request->text : $about->text,
            ]);
        } catch (Exception $exception) {
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('info', 'About page has been updated successfully');
        return redirect()->back();
    }
}