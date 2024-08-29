<?php

namespace App\Http\Controllers\Dashboard;

use Exception;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utilities\RandomGenerator;

class TestimonialsController extends Controller
{
    public function __construct()
    {
        $this->model = new Testimonial();
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $testimonials = $this->model->all();
        return view('admin.dashboard.testimonials.index')->with('testimonials', $testimonials);
    }

    public function add(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required|string|max:225',
            'image'=>'required|image|mimes:jpg,png|max:2000',
            'message' => 'required|string'
        ]);

        try{
            $name = str_slug($request->name).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/testimonials/'), $name);

            $this->model->create([
                'name' => $request->name,
                'image' => 'uploads/testimonials/'.$name,
                'message' => $request->message,
                'code' => RandomGenerator::generate_unique_uuid()
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success', $request->name .' has been created successfully');
        return redirect()->back();

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'testimonial' => 'required|string',
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png|max:2000',
            'message' => 'required|string',
            'visible' => 'nullable|string'
        ]);

        try{
            $testimonial = $this->model->where('code', $request->testimonial)->first();
            if(!$testimonial){
                session()->flash('warning', 'The selected testimonial does not exist');
                return redirect()->back()->withInput($request->all());
            }

            $unique = $this->model->where('name', $request->name)->first();
            if($unique && ($unique->id != $testimonial->id)){
                session()->flash('warning', 'The selected testimonial name is already in use');
                return redirect()->back()->withInput($request->all());
            }

            if($request->image){

                @unlink(public_path($testimonial->image));

                $name = str_slug($request->name).'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/testimonials/'), $name);
            }

            $testimonial->update([
                'name' => $request->name,
                'image' => $request->image ? 'uploads/testimonials/'.$name : $testimonial->image,
                'message'=> $request->message,
                'visible' => $request->visible == 'on'
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('info', $testimonial->name .' has been updated successfully');
        return redirect()->back();
    }

    /**
     * @param $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view($code)
    {
        try{
            $testimonial = $this->model->where('code', $request->testimonial)->first();
            if(!$testimonial){
                session()->flash('warning', 'The selected testimonial does not exist');
                return redirect()->route('admin.testimonials.manage');
            }
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        return view('admin.dashboard.testimonials.view');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
        public function delete(Request $request)
    {
        $request->validate([
            'testimonial' => 'required|string'
        ]);

        try{
            $testimonial = $this->model->where('code', $request->testimonial)->first();
            if(!$testimonial){
                session()->flash('warning', 'The selected testimonial does not exist');
                return redirect()->back();
            }

            if (file_exists(public_path($testimonial->image))) {
                @unlink(public_path($testimonial->image));
            }

            $testimonial->forceDelete();
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        session()->flash('danger', $testimonial->name .' has been deleted successfully');
        return redirect()->route('admin.testimonials.manage');
    }
}
